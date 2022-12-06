<?php

namespace App\Lib;

use App\Models\Gateway;
use Carbon\Carbon;
use MercadoPago;
use Session;
use Throwable;

class Mercado
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

        $data['secret_key'] = $array['secret_key'];
        $data['public_key'] = $array['public_key'];
        $data['payment_mode'] = 'mercadopago';
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


        if ($test_mode == 0) {
            $data['env'] = false;
            $test_mode = false;
        } else {
            $data['env'] = true;
            $test_mode = true;
        }



        try {
            //Payment
            MercadoPago\SDK::setAccessToken($data['secret_key']);
            $payment = new MercadoPago\Payment();
            $preference = new MercadoPago\Preference();
            $payer = new MercadoPago\Payer();
            $payer->name = $name;
            $payer->email = $email;
            $payer->date_created = Carbon::now();

            if (Session::get('without_auth')){
                $url = route('mercadopago.status');
            }else{
                $url = route('user.mercadopago.status');
            }

            $preference->back_urls = array(
                "success" => $url,
                "failure" => Mercado::redirect_if_payment_faild(),
                "pending" => $url,
            );

            $preference->auto_return = "approved";

            // Create a preference item
            $item = new MercadoPago\Item();
            $item->title = $billName;
            $item->quantity = 1;
            $item->unit_price = $amount;
            $preference->items = array($item);
            $preference->payer = $payer;
            $preference->save();
            $data['preference_id'] = $preference->id;
            $redirectUrl = $test_mode == 1 ? $preference->sandbox_init_point : $preference->init_point;

            Session::put('mercadopago_credentials', $data);

            return request()->expectsJson() ?
                $redirectUrl :
                redirect($redirectUrl);

        } catch (Throwable $th) {
            Session::flash('error', $th->getMessage());
            return request()->expectsJson() ?
                Mercado::redirect_if_payment_faild() :
                redirect(Mercado::redirect_if_payment_faild());
        }
    }

    public function status()
    {
        if (!Session::has('mercadopago_credentials')) {
            return abort(404);
        }

        $response = Request()->all();

        $info = Session::get('mercadopago_credentials');

        if ($response['status'] == 'approved' || $response['status'] == 'pending') {
            $data['payment_id'] = $response['payment_id'];
            $data['payment_method'] = "mercadopago";
            $data['gateway_id'] = $info['gateway_id'];

            $data['amount'] = $info['main_amount'];
            $data['charge'] = $info['charge'];
            $data['status'] = $response['status'] == 'pending' ? 2 : 1;
            $data['payment_status'] = $response['status'] == 'pending' ? 2 : 1;


            Session::forget('mercadopago_credentials');
            Session::put('payment_info', $data);
            return request()->expectsJson() ?
                Mercado::redirect_if_payment_success() :
                redirect(Mercado::redirect_if_payment_success());
        } else {
            $data['payment_status'] = 0;
            Session::put('payment_info', $data);
            Session::forget('flutterwave_credentials');

            return request()->expectsJson() ?
                Mercado::redirect_if_payment_faild() :
                redirect(Mercado::redirect_if_payment_faild());
        }
    }
}
