<?php

namespace App\Lib;

use App\Models\Gateway;
use Illuminate\Support\Facades\Session;

class Payu
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
            return route('user.payu.status');
        }else{
            return route('payu.status');
        }
    }

    public function view()
    {
        if (Session::has('payu_credentials')) {
            $Info = Session::get('payu_credentials');
            $gateway = Gateway::where('status', 1)->findOrFail($Info['gateway_id']);
            $promotion = Session::get('promotion');
            $product = Session::get('product');

            return view('payment.payu', compact('Info', 'gateway', 'promotion', 'product'));
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
        $data['txnid'] = $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $billName = $array['billName'];
        $data['merchant_key'] = $array['merchant_key'];
        $data['hash'] = $array['merchant_salt'];
        $data['payment_mode'] = 'payu';
        $data['amount'] = $amount;
        $data['charge'] = $array['charge'];
        $data['phone'] = $array['phone'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['main_amount'] = $array['amount'];
        $data['billName'] = $billName;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['currency'] = $currency;

        $test_mode = $array['test_mode'];
        $data['test_mode'] = $test_mode;

        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
        } else {
            $data['env'] = true;
            $test_mode = true;
        }

        if ($test_mode == false) {
            $url = 'https://secure.payu.in/_payment';
        } else {
            $url = 'https://sandboxsecure.payu.in/_payment';
        }

        $info = array(
            'key' => $array['merchant_key'],
            'test_mode ' => $test_mode,
            'txnid' => $txnid,
            'amount' => $amount,
            'firstname' => $name,
            'lastname' => "",
            'email' => $email,
            'salt' => $array['merchant_salt'],
            'productinfo' => $billName,
            'phone' => $array['phone'],
            'service_provider' => 'payu_paisa',
            'surl' => Payu::fallback(),
            'udf5' => 'BOLT_KIT_PHP7',
            'furl' => Payu::redirect_if_payment_faild(),
        );

        $hash = hash('sha512', $info['key'] . '|' . $info['txnid'] . '|' . $info['amount'] . '|' . $info['productinfo'] . '|' . $info['firstname'] . '|' . $info['email'] . '|||||' . $info['udf5'] . '||||||' . $info['salt']);

        $info['hash'] = $hash;

        $data = array_merge($data, $info);
        Session::put('payu_credentials', $data);

        if ($data) {
            return request()->expectsJson() ?
                route('user.payu.view') :
                redirect()->route('user.payu.view');
        }
    }

    public function status()
    {
        if (!Session::has('payu_credentials')) {
            return abort(404);
        }
        $info = Session::get('payu_credentials');

        if (Request()->status == 'success') {
            $data['payment_id'] = Request()->payuMoneyId;
            $data['payment_method'] = "payu";
            $data['gateway_id'] = $info['gateway_id'];

            $data['amount'] = $info['amount'];
            $data['charge'] = $info['charge'];
            $data['status'] = 1;
            $data['payment_status'] = 1;

            Session::forget('payu_credentials');
            Session::put('payment_info', $data);

            return request()->expectsJson() ?
                Payu::redirect_if_payment_success() :
                redirect(Payu::redirect_if_payment_success());
        } else {
            $data['payment_status'] = 0;
            Session::put('payment_info', $data);
            Session::forget('payu_credentials');
            return request()->expectsJson() ?
                Payu::redirect_if_payment_faild() :
                redirect(Payu::redirect_if_payment_faild());
        }
    }
}

