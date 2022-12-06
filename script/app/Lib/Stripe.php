<?php

namespace App\Lib;

use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use Stripe\StripeClient;
use Throwable;

class Stripe
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

    public function view()
    {
        if (Session::has('stripe_credentials')) {
            $Info = Session::get('stripe_credentials');
            $gateway = Gateway::where('status', 1)->findOrFail($Info['gateway_id']);
            $promotion = Session::get('promotion');
            $product = Session::get('product');

            if (Session::get('without_auth')){
                if (session('order_infos')) {
                    return view('payment.stripe', compact('Info', 'gateway', 'product', 'promotion'));
                } else {
                    return view('payment.stripe', compact('Info', 'gateway', 'product', 'promotion'));
                }
            }else{
                if (session('order_infos')) {
                    return view('user.payment.stripe', compact('Info', 'gateway'));
                } else {
                    return view('user.payment.stripe', compact('Info', 'gateway'));
                }
            }
        }
        abort(404);
    }

    public static function fallback()
    {
        if (Session::get('without_auth')){
            if (Session::has('fund_callback')) {
                return url(Session::get('fund_callback')['cancel_url']);
            } else {
                return url('payment/failed');
            }
        }else{
            if (Session::has('fund_callback')) {
                return url(Session::get('fund_callback')['cancel_url']);
            } else {
                return url('user/payment/failed');
            }
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

        $publishable_key = $array['publishable_key'];
        $secret_key = $array['secret_key'];
        $currency = $array['currency'];
        $email = $array['email'];
        $amount = $array['amount'];
        $totalAmount = $array['pay_amount'];
        $name = $array['name'];
        $billName = $array['billName'];
        $test_mode = $array['test_mode'];
        $data['publishable_key'] = $publishable_key;
        $data['secret_key'] = $secret_key;
        $data['payment_mode'] = 'stripe';
        $data['amount'] = $totalAmount;
        $data['test_mode'] = $test_mode;

        $data['charge'] = $array['charge'];
        $data['main_amount'] = $array['amount'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['is_fallback'] = $array['is_fallback'] ?? 0;
        $data['payment_type'] = $array['payment_type'] ?? '';
        $data['currency'] = $array['currency'];

        Session::put('stripe_credentials', $data);

        if (Session::get('without_auth')) {
            if (session('order_infos')) {
                return request()->expectsJson() ?
                    url('/stripe') :
                    redirect('/stripe');
            } else {
                return redirect()->route('stripe.view');
            }
        } else{
            if (session('order_infos')) {
                return request()->expectsJson() ?
                    url('/user/stripe') :
                    redirect('/user/stripe');
            } else {
                return redirect()->route('user.stripe.view');
            }
        }
    }

    public function status(Request $request)
    {
        abort_if(!Session::has('stripe_credentials'), 404);
        $credentials = Session::get('stripe_credentials');

        $stripe = Omnipay::create('Stripe');
        $token = $request->stripeToken;
        $gateway = $credentials['publishable_key'];
        $secret_key = $credentials['secret_key'];
        $main_amount = $credentials['amount'];

        $stripe->setApiKey($secret_key);

        $response = '';
        if ($token) {
            $response = $stripe->purchase([
                'amount' => $main_amount,
                'currency' => $credentials['currency'],
                'token' => $token,
            ])->send();
        }

        if ($response->isSuccessful()) {
            $arr_body = $response->getData();
            $data['payment_id'] = $arr_body['id'];
            $data['payment_method'] = "stripe";
            $data['gateway_id'] = $credentials['gateway_id'];
            $data['payment_type'] = $credentials['payment_type'];

            $data['amount'] = $credentials['main_amount'];
            $data['charge'] = $credentials['charge'];
            $data['status'] = 1;
            $data['payment_status'] = 1;
            $data['is_fallback'] = $credentials['is_fallback'];
            Session::put('payment_info', $data);
            Session::forget('stripe_credentials');

            return request()->expectsJson() ?
                Stripe::redirect_if_payment_success() :
                redirect(Stripe::redirect_if_payment_success());
        } else {
            $data['payment_status'] = 0;
            Session::put('payment_info', $data);
            Session::forget('stripe_credentials');

            return request()->expectsJson() ?
                Stripe::redirect_if_payment_faild() :
                redirect(Stripe::redirect_if_payment_faild());
        }
    }

    public static function isfraud($creds)
    {
        $payment_id = $creds['payment_id'];
        $secret_key = $creds['secret_key'];

        try {
            $stripe = new StripeClient($secret_key);

            $response = $stripe->charges->retrieve(
                $payment_id,
                [],
            );
            return $response->status === "succeeded" ? 1 : 0;
        } catch (Throwable$th) {
            return 0;
        }
    }
}
