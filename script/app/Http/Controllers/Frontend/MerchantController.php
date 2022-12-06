<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\HasPayment;
use App\Http\Controllers\Controller;
use App\Models\Gateway;
use App\Models\WebOrder;
use App\Models\Website;
use App\Models\WebTestOrder;
use Auth;
use Illuminate\Http\Request;
use Session;

class MerchantController extends Controller
{
    use HasPayment;

    public function index(Website $website, $uuid)
    {
        if ($website->mode){
            $order = WebOrder::whereUuid($uuid)->firstOrFail();
        }else{
            $order = WebTestOrder::whereUuid($uuid)->firstOrFail();
        }
        $this->clearSessions();
        abort_if($website->id !== $order->website_id, 404);
        $gateways = Gateway::whereStatus(1)->where('is_auto',1)
            ->when(!Auth::check(), function ($builder){
                $builder->whereNotIn("namespace", ["App\\Lib\\Credit"]);
            })
            ->orderBy('name')
            ->get();

        return view('frontend.merchant.index', compact( 'gateways', 'website','order'));
    }

    public function gateway(Request $request, Website $website,  $uuid)
    {
        $request->validate([
            'gateway' => ['required', 'exists:gateways,id'],
        ]);

        if ($website->mode){
            $order = WebOrder::whereUuid($uuid)->firstOrFail();
        }else{
            $order = WebTestOrder::whereUuid($uuid)->firstOrFail();
        }
        abort_if($website->id !== $order->website_id, 404);

        $this->clearSessions();
        $gateway = Gateway::findOrFail($request->input('gateway'));
        $amount = $order->amount * $order->quantity;

        return view('frontend.merchant.gateway', compact('website','order', 'gateway', 'amount'));
    }

    public function payment(Request $request, Website $website, $uuid, Gateway $gateway)
    {
        $this->validateRequest($request, $gateway);

        if ($website->mode){
            $order = WebOrder::whereUuid($uuid)->firstOrFail();
        }else{
            $order = WebTestOrder::whereUuid($uuid)->firstOrFail();
            Session::put('charge_wallet', false);
        }
        abort_if($website->id !== $order->website_id, 404);
        abort_if($order->is_paid, 403, __('Transaction Already Paid'));


        //Store Data For Save to DB
        Session::put('merchantPaymentData', [
            'order' => $order,
            'gateway' => $gateway
        ]);

        if (Auth::check()){
            $info = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ];
        }else{
            $info = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];
        }

        $convertedAmount = convert_money_direct($order->amount * $order->quantity, $order->currency, $gateway->currency);

        $data = [
            'currency' => $gateway->currency->code,
            'name' => $info['name'],
            'email' => $info['email'],
            'phone' => $request->input('phone'),
            'billName' => __("Merchant Payment"),
            'amount' => $convertedAmount,
            'test_mode' => (!$website->mode) || $gateway->test_mode,
            'charge' => $gateway->charge,
            'pay_amount' => round($convertedAmount + $gateway->charge, 2, PHP_ROUND_HALF_ODD),
            'gateway_id' => $gateway->id,
            'payment_type' => 'merchant',
            'request_from' => 'merchant'
        ];

        Session::put('userInfo', $info);
        Session::put('without_tax', true);
        Session::put('fund_callback.success_url', '/payment/success');
        Session::put('fund_callback.cancel_url', '/payment/failed');
        if (!Auth::check()){
            Session::put('without_auth', true);
        }else{
            Session::put('without_auth', false);
        }

        if ($website->mode){
            return $this->proceedToPayment($request, $gateway, $data);
        }else{
            $order = WebTestOrder::whereUuid($uuid)->firstOrFail();
            $amount = $order->amount * $order->quantity;
            Session::put('testData', $data);
            return view('frontend.merchant.test', compact('gateway', 'order', 'amount', 'website'));
        }
    }
}
