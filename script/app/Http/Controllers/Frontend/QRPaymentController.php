<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\HasPayment;
use App\Http\Controllers\Controller;
use App\Models\Gateway;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class QRPaymentController extends Controller
{
    use HasPayment;

    public function index(User $user)
    {
        $this->clearSessions();

        $gateways = Gateway::whereStatus(1)
            ->when(!Auth::check(), function ($builder) {
                $builder->whereNotIn("namespace", ["App\\Lib\\Credit"]);
            })
            ->orderBy('name')
            ->get();


        return view('frontend.qrpayment.index', compact('gateways', 'user'));
    }

    public function gateway(Request $request, User $user)
    {
        $request->validate([
            'gateway' => ['required', 'exists:gateways,id'],
            'amount' => ['required', 'numeric']
        ]);

        $amount = $request->input('amount');

        $gateway = Gateway::findOrFail($request->input('gateway'));

        Session::put('amount', $amount);

        return view('frontend.qrpayment.gateway', compact('gateway', 'amount', 'user'));
    }

    public function payment(Request $request, User $user, Gateway $gateway)
    {
        $this->validateRequest($request, $gateway);

        //Store Data For Save to DB
        Session::put('qrPaymentData', [
            'user' => $user,
            'gateway' => $gateway
        ]);

        if (Auth::check()) {
            $info = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ];
        } else {
            $info = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];
        }

        $amount = Session::get('amount');

        $convertedAmount = convert_money_direct($amount, $user->currency, $gateway->currency);

        $dataFields = $this->getFields($gateway, $request);

        $data = [
            'currency' => $gateway->currency->code,
            'name' => $info['name'],
            'email' => $info['email'],
            'phone' => $request->input('phone'),
            'billName' => 'QR Payment',
            'amount' => $convertedAmount,
            'test_mode' => $gateway->test_mode,
            'charge' => $gateway->charge,
            'pay_amount' => round($convertedAmount + $gateway->charge, 2, PHP_ROUND_HALF_ODD),
            'gateway_id' => $gateway->id,
            'payment_type' => 'qr_payment',
            'request_from' => 'merchant',
            'data' => $dataFields,
            'fields' => $gateway->fields
        ];

        Session::put('userInfo', $info);
        Session::put('without_tax', true);
        Session::put('fund_callback.success_url', '/payment/success');
        Session::put('fund_callback.cancel_url', '/payment/failed');

        if (!Auth::check()) {
            Session::put('without_auth', true);
        } else {
            Session::put('without_auth', false);
        }

        return $this->proceedToPayment($request, $gateway, $data);
    }
}
