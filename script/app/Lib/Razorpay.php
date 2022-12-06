<?php
namespace App\Lib;

use App\Models\Gateway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Throwable;

class Razorpay
{
    protected static $payment_id;

    public static function redirect_if_payment_success()
    {
        if (Session::has('fund_callback')) {
            return url(Session::get('fund_callback')['success_url']);
        } else {
            return url('user/payment/success');
        }
    }

    public static function redirect_if_payment_faild()
    {
        if (Session::has('fund_callback')) {
            return url(Session::get('fund_callback')['cancel_url']);
        } else {
            return url('user/payment/failed');
        }
    }

    public function view()
    {
        if (Session::has('razorpay_credentials')) {
            $Info = Session::get('razorpay_credentials');
            $gateway = Gateway::where('status', 1)->findOrFail($Info['gateway_id']);
            $response = Session::get('razorpay_response');
            $promotion = Session::get('promotion');
            $product = Session::get('product');

            if (Session::get('without_auth')){
                return view('payment.razorpay', compact('response', 'Info', 'gateway', 'promotion', 'product'));
            }else{
                return view('user.payment.razorpay', compact('response', 'Info', 'gateway'));
            }
        }
        abort(404);
    }

    public static function make_payment($array)
    {
        //Checking Minimum/Maximum amount
        $gateway = Gateway::findOrFail($array['gateway_id']);
        $amount = $array['pay_amount'];

        if ($gateway->min_amount > $amount ){
            return redirect()->back()->with('error', __('The minimum transaction amount is :amount', ['amount' => currency_format($gateway->min_amount, currency: $gateway->currency)]));
        }elseif($gateway->max_amount < $amount){
            return redirect()->back()->with('error', __('The maximum transaction amount is :amount', ['amount' => currency_format($gateway->max_amount, currency: $gateway->currency)]));
        }

        $currency = $array['currency'];

        $email = $array['email'];
        $amount = $array['pay_amount'];
        $name = $array['name'];
        $billName = $array['billName'];
        $data['key_id'] = $array['key_id'];
        $data['key_secret'] = $array['key_secret'];
        $data['payment_mode'] = 'razorpay';
        $data['payment_type'] = $array['payment_type'];
        $data['amount'] = $amount;
        $data['charge'] = $array['charge'];
        $data['phone'] = $array['phone'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['is_fallback'] = $array['is_fallback'] ?? 0;
        $data['main_amount'] = $array['amount'];
        $test_mode = $array['test_mode'];
        $data['test_mode'] = $test_mode;


        $data['billName'] = $billName;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['currency'] = $currency;


        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
        } else {
            $data['env'] = true;
            $test_mode = true;
        }


        Session::put('razorpay_credentials', $data);

        $response = Razorpay::get_response();

        Session::put('razorpay_response', $response);

        if (Session::get('without_auth')){
            return request()->expectsJson() ?
                route('razorpay.view') :
                redirect()->route('razorpay.view');
        }else{
            return request()->expectsJson() ?
                route('user.razorpay.view') :
                redirect()->route('user.razorpay.view');
        }

    }

    public static function get_response()
    {
        $array = Session::get('razorpay_credentials');
        $amount = $array['amount'];

        $phone = $array['phone'];
        $email = $array['email'];
        $amount = $array['amount'];
        $gateway_id = $array['gateway_id'];
        $name = $array['name'];
        $billName = $array['billName'];

        $razorpay_credentials = Session::get('razorpay_credentials');


        $api = new Api($razorpay_credentials['key_id'], $razorpay_credentials['key_secret']);
        $referance_id = Str::random(12);
        $order = $api->order->create(array(
                'receipt' => $referance_id,
                'amount' => $amount * 100,
                'currency' => $razorpay_credentials['currency'],
            )
        );

        // Return response on payment page
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $razorpay_credentials['key_id'],
            'amount' => $amount * 100,
            'name' => $name,
            'currency' => $razorpay_credentials['currency'],
            'email' => $email,
            'contactNumber' => $phone,
            'address' => "",
            'description' => $billName,
        ];

        return $response;
    }

    public function status(Request $request)
    {
        if (Session::has('razorpay_credentials')) {
            $order_info = Session::get('razorpay_credentials');

            // Now verify the signature is correct . We create the private function for verify the signature
            $signatureStatus = Razorpay::SignatureVerify(
                $request->all()['rzp_signature'],
                $request->all()['rzp_paymentid'],
                $request->all()['rzp_orderid']
            );

            // If Signature status is true We will save the payment response in our database
            // In this tutorial we send the response to Success page if payment successfully made
            if ($signatureStatus == true) {
                //for success
                $data['payment_id'] = Razorpay::$payment_id;
                $data['payment_method'] = "razorpay";
                $data['payment_type'] = $order_info['payment_type'];
                $data['gateway_id'] = $order_info['gateway_id'];
                $data['amount'] = $order_info['amount'];
                $data['billName'] = $order_info['billName'];
                $data['charge'] = $order_info['charge'];
                $data['status'] = 1;
                $data['payment_status'] = 1;
                $data['is_fallback'] = $order_info['is_fallback'];

                Session::put('payment_info', $data);
                Session::forget('razorpay_credentials');
                return request()->expectsJson() ?
                    Razorpay::redirect_if_payment_success() :
                    redirect(Razorpay::redirect_if_payment_success());
            } else {
                $data['payment_status'] = 0;
                Session::put('payment_info', $data);
                Session::forget('razorpay_credentials');

                return request()->expectsJson() ?
                    Razorpay::redirect_if_payment_faild() :
                    redirect(Razorpay::redirect_if_payment_faild());
            }
        }
    }

    // In this function we return boolean if signature is correct
    private static function SignatureVerify($_signature, $_paymentId, $_orderId)
    {
        try {
            $razorpay_credentials = Session::get('razorpay_credentials');
            // Create an object of razorpay class
            $api = new Api($razorpay_credentials['key_id'], $razorpay_credentials['key_secret']);
            $attributes = array('razorpay_signature' => $_signature, 'razorpay_payment_id' => $_paymentId, 'razorpay_order_id' => $_orderId);
            $order = $api->utility->verifyPaymentSignature($attributes);
            Razorpay::$payment_id = $_paymentId;
            return true;
        } catch (Exception $e) {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

    public static function isfraud($creds)
    {
        $payment_id = $creds['payment_id'];
        $key = $creds['key_id'];
        $secret = $creds['key_secret'];
        try {
            $api = new Api($key, $secret);
            $payment = $api->payment->fetch($payment_id);
            if ($payment) {
                return $payment['status'] === "captured" ? 1 : 0;
            }
        } catch (Throwable $th) {
            return 0;
        }
    }
}
