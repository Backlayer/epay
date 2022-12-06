<?php

namespace App\Lib;

use App\Models\Gateway;
use Illuminate\Http\Request;
use Session;

class Mollie
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
            return url('payment/mollie');
        }
        return url('user/payment/mollie');
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

        $total_amount = str_replace(',', '', number_format($array['pay_amount'], 2));
        $currency = $array['currency'];
        $email = $array['email'];
        $amount = $total_amount;
        $name = $array['name'];
        $billName = $array['billName'];
        $test_mode = $array['test_mode'];
        $data['api_key'] = $array['api_key'];
        $data['payment_mode'] = 'mollie';
        $data['amount'] = $amount;
        $data['is_fallback'] = $array['is_fallback'] ?? 0;
        $data['charge'] = $array['charge'];
        $data['main_amount'] = $array['amount'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['payment_type'] = $array['payment_type'] ?? '';
        $data['test_mode'] = $test_mode;

        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
        } else {
            $data['env'] = true;
            $test_mode = true;
        }
        Session::put('mollie_credentials', $data);
        try {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey($array['api_key']);
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => strtoupper($currency),
                    "value" => $amount
                ],
                "description" => $billName,
                "redirectUrl" => Mollie::fallback(),
            ]);

            Session::put('pay_id', $payment->id);

            return request()->expectsJson() ?
                $payment->getCheckoutUrl() : redirect($payment->getCheckoutUrl());

        } catch (\Exception $e) {
            throw $e;
            return request()->expectsJson() ? Mollie::redirect_if_payment_faild() :  redirect(Mollie::redirect_if_payment_faild());
        }
    }

    public function status(Request $request)
    {
        if (Session::has('pay_id') && Session::has('mollie_credentials')) {
            $info = Session::get('mollie_credentials');

            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey($info['api_key']);
            $pay_id = Session::get('pay_id');
            $payment = $mollie->payments->get($pay_id);

            if ($payment->isPaid()) {
                $data['payment_id'] = Session::get('pay_id');
                $data['payment_method'] = "mollie";
                $data['gateway_id'] = $info['gateway_id'];
                $data['payment_type'] = $info['payment_type'];
                $data['amount'] = $info['main_amount'];
                $data['charge'] = $info['charge'];
                $data['status'] = 1;
                $data['payment_status'] = 1;
                $data['is_fallback'] = $info['is_fallback'];

                Session::forget('pay_id');
                Session::forget('mollie_credentials');
                Session::put('payment_info', $data);

                return request()->expectsJson() ? Mollie::redirect_if_payment_success() : redirect(Mollie::redirect_if_payment_success());
            }

            Session::forget('pay_id');
            Session::forget('mollie_credentials');
            return request()->expectsJson() ? Mollie::redirect_if_payment_faild() : redirect(Mollie::redirect_if_payment_faild());
        }
        abort(404);
    }
}
