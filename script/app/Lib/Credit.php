<?php
namespace App\Lib;

use App\Models\Gateway;
use App\Models\Order;
use App\Models\Transaction;
use Session;
use Illuminate\Http\Request;
use Http;
use Str;
use Auth;
use App\Models\User;
class Credit
{

    public static function redirect_if_payment_success()
    {
        return Session::has('fund_callback') ? Session::get('fund_callback')['success_url'] : url('user/payment/success');
    }

    public static function redirect_if_payment_faild()
    {
        return Session::has('fund_callback') ? Session::get('fund_callback')['cancel_url'] : url('user/payment/failed');
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

        $amount = $array['amount'];
        //$totalAmount=$array['pay_amount'];
        $name = $array['name'];
        $billName = $array['billName'];
        $test_mode = $array['test_mode'];
        $data['payment_mode'] = 'credit';
        $data['amount'] = $amount;
        $data['test_mode'] = $test_mode;
        $data['charge'] = $array['charge'];
        $data['main_amount'] = $array['pay_amount'];
        $data['gateway_id'] = $array['gateway_id'];
        $data['payment_type'] = $array['payment_type'];
        return Credit::status($data);
    }

    public static function status($info)
    {
        $user = Auth::user();
        $gateway = Gateway::findOrFail($info['gateway_id']);
        $wallet = convert_money($user->wallet, $user->currency);
        $mainAmount = convert_money($info['main_amount'], $gateway->currency);

        if ($wallet >= $mainAmount) {
            $calculateAmount = $wallet - $mainAmount;

            if (Session::get('charge_wallet', true)){
                $user->wallet = convert_money($calculateAmount, $user->currency, true);
                $user->save();
            }

            $data['payment_id'] = Credit::generateString();
            $data['payment_method'] = "credit";
            $data['gateway_id'] = $info['gateway_id'];
            $data['payment_type'] = $info['payment_type'];
            $data['amount'] = $info['main_amount'];
            $data['charge'] = $info['charge'];
            $data['status'] = 1;
            $data['payment_status'] = 1;
        } else {
            $data['status'] = 0;
            $data['payment_status'] = 0;
            Session::flash('error', __("Insufficient Funds! Please Deposit"));
        }

        Session::put('payment_info', $data);

        if ($data['status'] == 1) {
            return request()->expectsJson() ?
                Credit::redirect_if_payment_success() :
                redirect(Credit::redirect_if_payment_success());
        }

        return request()->expectsJson() ?
            Credit::redirect_if_payment_faild() :
            redirect(Credit::redirect_if_payment_faild());
    }

    public static function generateString()
    {
        return $str = Str::random(10);
    }
}
