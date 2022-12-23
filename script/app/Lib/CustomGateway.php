<?php

namespace App\Lib;

use App\Models\Gateway;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CustomGateway
{
    public static function redirect_if_payment_faild()
    {
        return url('user/payment/failed');
    }

    public static function make_payment($array)
    {
        //Checking Minimum/Maximum amount
        $gateway = Gateway::findOrFail($array['gateway_id']);
        $amount = $array['pay_amount'];

        if ($gateway->min_amount > $amount) {
            return redirect()->back()->with('error', __('The minimum transaction amount is :amount', ['amount' => currency_format($gateway->min_amount, currency: $gateway->currency)]));
        } elseif ($gateway->max_amount < $amount) {
            return redirect()->back()->with('error', __('The maximum transaction amount is :amount', ['amount' => currency_format($gateway->max_amount, currency: $gateway->currency)]));
        }

        $currency = $array['currency'];
        $email = $array['email'];
        $amount = $array['pay_amount'];
        $name = $array['name'];
        $billName = $array['billName'];

        $data['payment_mode'] = 'manual';
        $test_mode = $array['test_mode'];
        $data['test_mode'] = $test_mode;

        $data['amount'] = $amount;
        $data['charge'] = $array['charge'];
        $data['phone'] = $array['phone'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['main_amount'] = $array['amount'];

        $data['billName'] = $billName;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['currency'] = $currency;
        $data['image'] = $array['screenshot'] ?? '';
        $data['comment'] = $array['comment'] ?? '';
        $data['payment_type'] = $array['payment_type'];
        $data['fields'] = $array['fields'];
        $data['data'] = $array['data'];

        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
        } else {
            $data['env'] = true;
            $test_mode = true;
        }

        Session::put('manual_credentials', $data);

        return request()->expectsJson() ?
            url('user/manual/payment') :
            redirect('user/manual/payment');
    }

    public function status()
    {
        if (!Session::has('manual_credentials')) {
            return abort(404);
        }

        $info = Session::get('manual_credentials');

        $data['payment_id'] = $this->generateString();
        $data['payment_method'] = "manual";
        $data['gateway_id'] = $info['gateway_id'];
        $data['payment_type'] = $info['payment_type'];

        $data['amount'] = $info['main_amount'];
        $data['charge'] = $info['charge'];
        $data['status'] = 2;
        $data['payment_status'] = 2;
        $data['meta'] = array('image' => $info['image'] ?? '', 'comment' => $info['comment'] ?? '');
        $data['fields'] = $info['fields'];
        $data['data'] = $info['data'];

        Session::forget('manual_credentials');
        Session::put('payment_info', $data);

        return request()->expectsJson() ?
            CustomGateway::redirect_if_payment_success() :
            redirect(CustomGateway::redirect_if_payment_success());
    }

    public function generateString()
    {
        return Str::random(15) . rand(100, 200);
    }

    public static function redirect_if_payment_success()
    {
        if (Session::has('fund_callback')) {
            return url(Session::get('fund_callback')['success_url']);
        } else {
            return url('user/payment/success');
        }
    }
}
