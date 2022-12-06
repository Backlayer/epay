<?php
namespace App\Lib;

use App\Models\Gateway;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Session;

class Paypal
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
        if (Session::get('without_auth')){
            return url('payment/paypal');
        }
        return url('user/payment/paypal');
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

        $client_id = $array['client_id'];
        $client_secret = $array['client_secret'];
        $currency = $array['currency'];
        $email = $array['email'];
        $amount = round($array['pay_amount']);
        $name = $array['name'];
        $test_mode = $array['test_mode'];
        $billName = $array['billName'];
        $data['client_id'] = $client_id;
        $data['client_secret'] = $client_secret;
        $data['payment_mode'] = 'paypal';

        $data['amount'] = $amount;
        $data['test_mode'] = $test_mode;
        $data['charge'] = $array['charge'];
        $data['main_amount'] = $array['amount'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['payment_type'] = $array['payment_type'] ?? '';

        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
            $final = str_replace(',', '', number_format($amount, 3));
        } else {
            $data['env'] = true;
            $test_mode = true;
            $final = str_replace(',', '', number_format($amount / 100, 3));
        }

        Session::put('paypal_credentials', $data);
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($client_id);
        $gateway->setSecret($client_secret);
        $gateway->setTestMode($test_mode);

        $response = $gateway->purchase(array(
            'amount' => $final,
            'currency' => strtoupper($currency),
            'returnUrl' => Paypal::fallback(),
            'cancelUrl' => Paypal::redirect_if_payment_faild(),
        ))->send();

        if ($response->isRedirect()) {
            if (request()->expectsJson()){
                return $response->getRedirectUrl();
            }
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful

            return request()->expectsJson() ?
                Paypal::redirect_if_payment_faild() :
                redirect(Paypal::redirect_if_payment_faild());
        }
    }

    public function status(Request $request)
    {
        abort_if(!Session::has('paypal_credentials'), 404);

        $credentials = Session::get('paypal_credentials');
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($credentials['client_id']);
        $gateway->setSecret($credentials['client_secret']);
        $gateway->setTestMode($credentials['env']);

        $request = $request->all();

        $transaction = $gateway->completePurchase(array(
            'payer_id' => $request['PayerID'],
            'transactionReference' => $request['paymentId'],
        ));

        $response = $transaction->send();
        if ($response->isSuccessful()) {
            $arr_body = $response->getData();
            $data['payment_id'] = $arr_body['id'];
            $data['payment_method'] = "paypal";
            $data['gateway_id'] = $credentials['gateway_id'];

            $data['amount'] = $credentials['main_amount'];
            $data['charge'] = $credentials['charge'];
            $data['status'] = 1;
            $data['payment_status'] = 1;

            Session::put('payment_info', $data);
            Session::forget('paypal_credentials');

            return request()->expectsJson() ?
                Paypal::redirect_if_payment_success() :
                redirect(Paypal::redirect_if_payment_faild());
        } else {
            $data['payment_status'] = 0;
            Session::put('payment_info', $data);
            Session::forget('paypal_credentials');

            return request()->expectsJson() ?
                Paypal::redirect_if_payment_faild() :
                redirect(Paypal::redirect_if_payment_faild());
        }
    }
}
