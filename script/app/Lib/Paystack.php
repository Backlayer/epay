<?php
namespace App\Lib;

use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class Paystack
{
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

    public static function fallback()
    {
        if (Session::get('without_auth')) {
            return url('payment/paystack');
        }else{
            return url('user/payment/paystack');
        }
    }

    public function view()
    {
        if (Session::has('paystack_credentials')) {
            $Info = Session::get('paystack_credentials');
            $gateway = Gateway::where('status', 1)->findOrFail($Info['gateway_id']);
            $promotion = Session::get('promotion');
            $product = Session::get('product');
            if (Session::get('without_auth')) {
                return view('payment.paystack', compact('Info', 'gateway', 'promotion', 'product'));
            }else{
                return view('user.payment.paystack', compact('Info', 'gateway'));
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

        $data['public_key'] = $array['public_key'];
        $data['secret_key'] = $array['secret_key'];
        $data['payment_mode'] = 'paystack';
        $data['amount'] = $amount;
        $data['charge'] = $array['charge'];
        $data['phone'] = $array['phone'];
        $data['payment_type'] = $array['payment_type'] ?? '';
        $test_mode = $array['test_mode'];

        $data['gateway_id'] = $array['gateway_id'];
        $data['main_amount'] = $array['amount'];
        $data['billName'] = $billName;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['currency'] = $currency;
        $data['is_fallback'] = $array['is_fallback'] ?? 0;

        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
        } else {
            $data['env'] = true;
            $test_mode = true;
        }

        Session::put('paystack_credentials', $data);

        if (Session::get('without_auth')){
            return request()->expectsJson() ?
                route('paystack.view') :
                redirect()->route('paystack.view');
        }else{
            return request()->expectsJson() ?
                route('user.paystack.view') :
                redirect()->route('user.paystack.view');
        }
    }


    public function status(Request $request)
    {
        if (!Session::has('paystack_credentials')) {
            return abort(404);
        }

        $info = Session::get('paystack_credentials');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $request->ref_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $info['secret_key'] . "",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Session::forget('paystack_credentials');
            $data['payment_status'] = 0;
            Session::put('payment_info', $data);
            return redirect(Paystack::redirect_if_payment_faild());
        } else {
            $data = json_decode($response);
            if ($data->status == true && $data->data->status == 'success') {
                $ref_id = $data->data->reference;
                $amount = $data->data->amount / 100;

                abort_unless($amount == $info['amount'], 404);

                $pay_data['payment_id'] = $ref_id;
                $pay_data['payment_method'] = "paystack";
                $pay_data['gateway_id'] = $info['gateway_id'];
                $pay_data['amount'] = $info['main_amount'];
                $pay_data['charge'] = $info['charge'];
                $pay_data['status'] = 1;
                $pay_data['payment_status'] = 1;
                $pay_data['is_fallback'] = $info['is_fallback'];

                Session::forget('paystack_credentials');
                Session::put('payment_info', $pay_data);

                return request()->expectsJson() ?
                    Paystack::redirect_if_payment_success() :
                    redirect(Paystack::redirect_if_payment_success());
            }
        }
        Session::forget('paystack_credentials');

        return request()->expectsJson() ?
            Paystack::redirect_if_payment_faild() :
            redirect(Paystack::redirect_if_payment_faild());
    }

    public static function isfraud($cred)
    {
        $secret_key = $cred['secret_key'];
        $reference = $cred['payment_id'];
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $secret_key,
                    "Cache-Control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $arr = json_decode($response, true);
            if (array_key_exists('data', $arr)) {
                return $arr['data']['status'] === "success" ? 1 : 0;
            }
        } catch (Throwable $th) {
            return 0;
        }
    }
}
