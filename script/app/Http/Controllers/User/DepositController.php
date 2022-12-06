<?php

namespace App\Http\Controllers\User;

use Throwable;
use App\Models\Tax;
use App\Models\User;
use App\Rules\Phone;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::whereUserId(Auth::id())
                    ->with('gateway')
                    ->when(request()->has('search'), function($q) {
                        $q->where('trx', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate();

        return view('user.deposits.index', compact('deposits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Session::put('deposit_amount', $request->input('amount'));
        return response()->json([
            'message' => __('Great! You are trying to deposits. Please follow the next step'),
            'redirect' => route('user.deposits.create'),
        ]);
    }

    public function create()
    {
        $amount = Session::get('deposit_amount');

        if (empty($amount) && $amount == null && $amount == 0) {
            return to_route('user.deposits.index', ['trigger' => 'deposit_modal']);
        }

        $gateways = Gateway::whereStatus(1)
            ->with('currency')
            ->whereNotIn('name', ['From Wallet'])
            ->get();

        return view('user.deposits.create', compact('gateways', 'amount'));
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        $request->validate([
            'phone' => [
                Rule::requiredIf(fn() => $gateway->phone_required),
                new Phone,
            ],
            'comment' => ['nullable', 'string', 'max:255'],
            'screenshot' => ['nullable', 'image', 'max:2048'], // 2MB
        ]);

        $amount = convert_money(Session::get('deposit_amount'), user_currency()) * $gateway->currency->rate;
        Session::put('fund_callback.success_url', '/user/deposit/payment/success');
        Session::put('fund_callback.cancel_url', '/user/deposit/payment/failed');

        if ($gateway->is_auto == 0) {
            $request->validate([
                'comment' => ['required', 'string', 'max:255'],
                'screenshot' => ['required', 'image', 'max:2048'], // 2MB
            ]);

            $payment_data['comment'] = $request->input('comment');
            if ($request->hasFile('screenshot')) {
                $path = 'uploads' . '/payments' . date('/y/m/');
                $name = uniqid() . date('dmy') . time() . "." . $request->file('screenshot')->getClientOriginalExtension();
                Storage::disk(config('filesystems.default'))->put($path . $name, file_get_contents(Request()->file('screenshot')));
                Storage::disk(config('filesystems.default'))->url($path . $name);
                $payment_data['screenshot'] = $path . $name;
            }
        }

        $payment_data['currency'] = $gateway->currency->code ?? 'USD';
        $payment_data['email'] = auth()->user()->email;
        $payment_data['name'] = auth()->user()->name;
        $payment_data['phone'] = $request->input('phone');
        $payment_data['billName'] = __('Make Deposit');
        $payment_data['amount'] = $amount;
        $payment_data['test_mode'] = $gateway->test_mode;
        $payment_data['charge'] = $gateway->charge ?? 0;
        $payment_data['pay_amount'] = round($amount + $gateway->charge, 2);
        $payment_data['gateway_id'] = $gateway->id;
        $payment_data['payment_type'] = 'deposit';
        $payment_data['request_from'] = 'merchant';

        $gateway_info = json_decode($gateway->data, true);
        if (!empty($gateway_info)) {
            foreach ($gateway_info as $key => $info) {
                $payment_data[$key] = $info;
            }
        }

        Session::put('payment_type', 'deposit');
        Session::put('without_tax', true);

        $redirect = $gateway->namespace::make_payment($payment_data);

        return $request->expectsJson() ? response()->json(['message' => __('Hurrah! You are redirect to next step.'), 'redirect' => $redirect]) : $redirect;
    }

    public function failed()
    {
        Session::flash('error', __('Oops! Payment Failed.'));
        Session::forget('payment_info');
        Session::forget('payment_type');

        return to_route('user.deposits.create');
    }

    public function success()
    {
        abort_if(!Session::has('payment_info') && !Session::has('payment_type'), 404);
        $amount = Session::get('deposit_amount');
        $gateway_id = Session::get('payment_info')['gateway_id'];
        $gateway = Gateway::findOrFail($gateway_id);
        $trx = Session::get('payment_info')['payment_id'];
        $payment_status = session('payment_info')['payment_status'] ?? 0;
        $status = Session::get('payment_info')['status'] ?? 1;

        $total_paid = (round($amount, 2) * $gateway->rate) + $gateway->charge;

        // Insert transaction data into deposit table
        \DB::beginTransaction();
        try {
            $meta = Session::get('payment_info')['meta'] ?? null;

            $deposit = new Deposit();
            $deposit->user_id = auth()->id();
            $deposit->gateway_id = $gateway->id;
            $deposit->trx = $trx;
            $deposit->total_amount = $total_paid;
            $deposit->amount = $amount;
            $deposit->status = $status;
            $deposit->payment_status = $payment_status;
            $deposit->currency_id = $gateway->currency->id;
            $deposit->charge = $gateway->charge;
            $deposit->rate = $gateway->currency->rate;
            $deposit->meta = $gateway->is_auto == 0 ? $meta : null;
            $deposit->save();

            if ($payment_status == 1) {
                $user = User::findOrFail(auth()->id());
                $user->wallet = $user->wallet + $amount;
                $user->save();
            }

            Transaction::create([
                'rate' => user_currency()->rate,
                'user_id' => auth()->id(),
                'amount' => $amount,
                'name' => auth()->user()->name,
                'email' => auth()->user()->name,
                'type' => 'credit',
                'reason' => 'Deposite.',
                'currency_id' => auth()->user()->currency_id
            ]);

            \DB::commit();

            Session::forget('payment_info');
            Session::forget('fund_callback');
            Session::forget('deposit_amount');
            Session::forget('without_tax');
            Session::forget('payment_type');

            Session::flash('success', 'Transaction Successfully Complete!');

            if ($status != 0) {
                return to_route('user.deposits.index');
            } else {
                return to_route('user.deposits.create');
            }

        } catch (Throwable $th) {
            \DB::rollback();
            Session::forget('payment_info');
            Session::forget('fund_callback');
            Session::forget('deposit_amount');
            Session::forget('without_tax');
            Session::forget('payment_type');
            Session::flash('error', 'Something wrong please contact with support..!');
            return redirect()->route('user.deposits.index');
        }
    }

    public function getDeposits()
    {
        $data['total'] = Deposit::whereUserId(auth()->id())->count();
        $data['completed'] = Deposit::whereUserId(auth()->id())->whereStatus(1)->count();
        $data['pending'] = Deposit::whereUserId(auth()->id())->whereStatus(2)->count();
        $data['rejected'] = Deposit::whereUserId(auth()->id())->whereStatus(0)->count();
        return response()->json($data);
    }
}
