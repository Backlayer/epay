<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\HasPayment;
use App\Http\Controllers\Controller;
use App\Models\DonationOrder;
use App\Models\Gateway;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class DonationController extends Controller
{
    use HasPayment;

    public function index(Donation $donation)
    {
        $this->clearSessions();
        $gateways = Gateway::whereStatus(1)->where('is_auto',1)
            ->when(!Auth::check(), function (Builder $builder){
                $builder->whereNotIn('namespace', ['App\\Lib\\Credit']);
            })
            ->orderBy('name')
            ->get();

        $donation->loadCount('orders');
        $donation->load('orders.currency', 'orders.donor');
        $orders = $donation->orders()->with('currency')->latest()->paginate(10);

        $raisedAmount = $donation->orders()->sum('amount');
        $raisedAmountCharge = $donation->orders()->sum('charge');
        $goalCompleted = round((($raisedAmount + $raisedAmountCharge) / $donation->amount) * 100, 2, PHP_ROUND_HALF_ODD);

        return view('frontend.donation.index', compact('donation', 'gateways', 'orders', 'goalCompleted', 'raisedAmount', 'raisedAmountCharge'));
    }

    public function gateway(Request $request, Donation $donation)
    {
        $request->validate([
            'gateway' => ['required', 'exists:gateways,id'],
            'amount' => ['required', 'numeric']
        ]);

        $this->clearSessions();
        Session::put('amount', $request->input('amount'));

        $gateway = Gateway::where('is_auto',1)->findOrFail($request->input('gateway'));
        $amount = $request->input('amount');
        if (!Auth::check() && $gateway->namespace =="App\\Lib\\Credit"){
            return redirect()->route('login', ['redirect' => route('frontend.donation.index', $donation->uuid)]);
        }

        return view('frontend.donation.gateway', compact('donation', 'gateway', 'amount'));
    }

    public function payment(Request $request, Donation $donation, Gateway $gateway)
    {
        $this->validateRequest($request, $gateway);
        $request->validate([
            'donate_as' => ['required', Rule::in(['anonymous', 'publicly'])]
        ]);

        //Store Data For Save to DB
        Session::put('donationPaymentData', [
            'donation' => $donation,
            'gateway' => $gateway
        ]);

        if (Auth::check()){
            $info = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'donate_as' => $request->input('donate_as')
            ];
        }else{
            $info = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'donate_as' => $request->input('donate_as')
            ];
        }

        $amount = Session::get('amount');
        $convertToGatewayAmount = convert_money_direct($amount, $donation->currency, $gateway->currency);
        $data = [
            'currency' => $gateway->currency->code,
            'name' => $info['name'],
            'email' => $info['email'],
            'phone' => $request->input('phone'),
            'billName' => __("Donation"),
            'amount' => $convertToGatewayAmount,
            'test_mode' => $gateway->test_mode,
            'charge' => $gateway->charge,
            'pay_amount' => round($convertToGatewayAmount + $gateway->charge, 2, PHP_ROUND_HALF_ODD),
            'gateway_id' => $gateway->id,
            'payment_type' => 'donation',
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
        return $this->proceedToPayment($request, $gateway, $data);
    }
}
