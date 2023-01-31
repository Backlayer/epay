<?php

namespace App\Http\Controllers\User;

use Session;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Payout;
use App\Mail\PayoutMail;
use App\Models\UserBank;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\returnSelf;

class PayoutController extends Controller
{
    public function index()
    {
        $userbanks = UserBank::with('bank')->whereUserId(auth()->id())->get();
        $payouts = Payout::latest()->whereUserId(auth()->id())
                    ->when(request()->has('search'), function ($q) {
                        $q->where('trx', 'like', '%' . request('search') . '%');
                    })
                    ->paginate();

        return view('user.payouts.index', compact('payouts', 'userbanks'));
    }

    public function create()
    {
        return view('user.payouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_id' => 'required|integer',
        ]);

        $user = auth()->user();

        if ($user->wallet >= $request->amount) {
            $otp = rand();

            session()->put('payout_otp', $otp);
            session()->put('bank_id', $request->bank_id);
            session()->put('payout_amount', $request->amount);

            $total_charge = get_charge('withdraw_charge', $request->amount) + get_charge('transaction_charge', $request->amount);

            session()->put('payout_charge', $total_charge);

            $options = [
                'otp' => $otp,
                'amount' => $request->amount,
                'currency' => user_currency()->symbol,
            ];

            if (config('system.queue.mail')) {
                Mail::to(auth()->user()->email)->queue(new OtpMail($options));
            } else {
                Mail::to(auth()->user()->email)->send(new OtpMail($options));
            }

            return response()->json([
                'redirect' => route('user.payouts.create'),
                'message' => "An OTP has been sent to your mail. Please check and confirm.",
            ], 200);
        } else {
            return response()->json([
                'message' => 'Insufficient wallet. Your current balance is ' . currency_format(auth()->user()->wallet, user_currency())
            ], 404);
        }
    }

    public function show(Payout $payout)
    {
        abort_if($payout->user_id != auth()->id(), 404);
        $payout->load('userbank.bank');
        return view('user.payouts.show', compact('payout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $bank_id = session()->get('bank_id');
        $payout_otp = session()->get('payout_otp');
        $payout_amount = session()->get('payout_amount');

        if (!$payout_otp || !$payout_amount || !$bank_id) {
            return response()->json([
                'message' => __('Not found.')
            ], 404);
        }

        if ($payout_otp == $request->otp) {
            $total_charge = session('payout_charge');
            $payout = Payout::create([
                'trx' => time().rand(1,100),
                'charge' => $total_charge,
                'user_id' => auth()->id(),
                'user_bank_id' => $bank_id,
                'amount' => $payout_amount,
                'currency_id' => user_currency()->id,
                'rate' => user_currency()->rate,
            ]);
            $user = User::findOrFail(auth()->id());
            $user->update([
                'wallet' => $user->wallet - $payout_amount
            ]);

            $options = [
                'name' => $user->name,
                'email' => $user->email,
                'amount' => $payout->amount,
                'charge' => $payout->charge,
            ];

            // Send Email to admin
            if (env('QUEUE_MAIL')) {
                Mail::to(env('MAIL_TO'))->queue(new PayoutMail($payout));
            } else {
                Mail::to(env('MAIL_TO'))->send(new PayoutMail($options));
            }

            session()->forget('method');
            session()->forget('bank_id');
            session()->forget('payout_otp');
            session()->forget('payout_amount');
            session()->forget('method_charge');

            return response()->json([
                'redirect' => route('user.payouts.index'),
                'message' => __('Payout request successfully.'),
            ]);
        } else {
            return response()->json([
                'message' => __('Your OTP is incorrect please check your mail and confirm.')
            ], 404);
        }
    }

    public function getPayouts()
    {
        $data['withdraws'] = Payout::whereUserId(auth()->id())->count();
        $data['approved'] = Payout::whereUserId(auth()->id())->where('status', 'approved')->count();
        $data['rejected'] = Payout::whereUserId(auth()->id())->where('status', 'rejected')->count();
        $data['pending'] = Payout::whereUserId(auth()->id())->where('status', 'pending')->count();

        return response()->json($data);
    }
}
