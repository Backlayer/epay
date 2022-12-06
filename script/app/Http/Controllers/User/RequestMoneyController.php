<?php

namespace App\Http\Controllers\User;

use Throwable;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\Moneyrequest;
use Illuminate\Http\Request;
use App\Mail\MoneyRequestMail;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class RequestMoneyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $requests = Moneyrequest::with(['receiver', 'sender_currency', 'sender'])
                    ->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id())
                    ->when(!is_null($search), function (Builder $builder) use($search) {
                        $builder->whereHas('sender', function (Builder $builder) use ($search){
                            $builder->where('name', 'LIKE', '%'.$search.'%')
                                ->orWhere('email', 'LIKE', '%'.$search.'%');
                            })
                            ->orWhereHas('receiver', function (Builder $builder) use ($search){
                                $builder->where('name', 'LIKE', '%'.$search.'%')
                                    ->orWhere('email', 'LIKE', '%'.$search.'%');
                            });
                    })
                    ->latest()
                    ->paginate();

        return view('user.request-money.index', compact('requests'));
    }

    public function receivedRequest(Request $request)
    {
        $search = $request->get('search');
        $requests = Moneyrequest::with(['sender_currency', 'sender'])
                    ->where('receiver_id', auth()->id())
                    ->when(!is_null($search), function (Builder $builder) use($search) {
                        $builder->whereHas('sender', function (Builder $builder) use ($search){
                            $builder->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%');
                        });
                    })
                    ->latest()
                    ->paginate();

        return view('user.request-money.received-request', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => __('User not found.')
            ], 404);
        }

        if ($user->id == auth()->id()) {
            return response()->json([
                'message' => __("You can't send request yourself.")
            ], 403);
        }

        if (!$user->currency_id) {
            return response()->json([
                'message' => __("Currency not found.")
            ], 403);
        }

        $total_charge = get_charge('request_money_charge', $request->amount) + get_charge('transaction_charge', $request->amount);
        $moneyRequest = Moneyrequest::create([
            'charge' => $total_charge,
            'receiver_id' => $user->id,
            'sender_id' => auth()->id(),
            'amount' => $request->amount,
            'approved_currency_id' => $user->currency_id,
            'request_currency_id' => auth()->user()->currency_id,
        ]);

        $sender_currency = Currency::findOrFail($moneyRequest->request_currency_id);
        $receiver_currency = Currency::findOrFail($moneyRequest->approved_currency_id);

        $options = [
            'receiver_name' => $user->name,
            'sender_name' => auth()->user()->name,
            'sender_email' => auth()->user()->email,
            'request_at' => $moneyRequest->created_at,
            'link' => route('user.request-money.index'),
            'amount' => $receiver_currency->symbol.number_format(convert_money($request->amount, $sender_currency) * $receiver_currency->rate, 2),
        ];

        if (config('system.queue.mail')){
            \Mail::to($request->email)->queue(new MoneyRequestMail($options));
        }else{
            \Mail::to($request->email)->send(new MoneyRequestMail($options));
        }

        return response()->json([
            'redirect' => route('user.request-money.index'),
            'message' => __('Request send successfully.')
        ]);
    }

    public function cancle($id)
    {
        $request = Moneyrequest::where('receiver_id', auth()->id())->findOrFail($id);
        $request->status = 0;
        $request->save();
        return response()->json([
            'message' => __('Money request has been canceled.'),
            'redirect' => route('user.request-money.index'),
        ]);
    }

    public function approved($id)
    {
        $request = Moneyrequest::where('receiver_id', auth()->id())->findOrFail($id);
        $money_sender = User::findOrFail($request->receiver_id);
        $rq_sender_currency = Currency::findOrFail($request->request_currency_id);
        $rq_receiver_currency = Currency::findOrFail($request->approved_currency_id);
        $money_sender_amount = number_format(convert_money($request->amount, $rq_sender_currency) * $rq_receiver_currency->rate, 2);
        $money_sender_charge = number_format(convert_money($request->charge, $rq_sender_currency) * $rq_receiver_currency->rate, 2);

        if ($money_sender->wallet < $money_sender_amount) {
            return response()->json([
                'message' => __('Insufficient balance. Please deposit now.'),
                'redirect' => route('user.request-money.index'),
            ], 404);
        }

        \DB::beginTransaction();
        try {

            $request->status = 1;
            $request->save();

            $money_sender->wallet = $money_sender->wallet - $money_sender_amount;
            $money_sender->save();

            Transaction::create([
                'rate' => $rq_receiver_currency->rate,
                'user_id' => $money_sender->id,
                'amount' => '-'.$money_sender_amount,
                'charge' => $money_sender_charge,
                'name' => $money_sender->name,
                'email' => $money_sender->email,
                'type' => 'debit',
                'reason' => 'Send money request',
                'currency_id' => $money_sender->currency_id,
            ]);

            $money_receiver = User::findOrFail($request->sender_id);
            $money_receiver->wallet = ($money_receiver->wallet + $request->amount) - $request->charge;
            $money_receiver->save();

            Transaction::create([
                'rate' => $rq_sender_currency->rate,
                'amount' => $request->amount - $request->charge,
                'user_id' => $money_receiver->id,
                'name' => $money_receiver->name,
                'email' => $money_receiver->email,
                'type' => 'credit',
                'reason' => 'Received money request',
                'currency_id' => $money_receiver->currency_id,
            ]);

            \DB::commit();

            return response()->json([
                'message' => __('Money send successfully.'),
                'redirect' => route('user.request-money.index'),
            ]);
        } catch (Throwable $th) {
            \DB::rollback();
            return back()->with('error', __('Something was wrong, Please contact with author.'));
        }
    }

    public function getRequestMoney()
    {
        $data['total'] = Moneyrequest::whereSenderId(auth()->id())->orWhere('receiver_id', auth()->id())->count();
        $data['completed'] = Moneyrequest::whereSenderId(auth()->id())->orWhere('receiver_id', auth()->id())->whereStatus(1)->count();
        $data['pending'] = Moneyrequest::whereSenderId(auth()->id())->orWhere('receiver_id', auth()->id())->whereStatus(2)->count();
        $data['rejected'] = Moneyrequest::whereSenderId(auth()->id())->orWhere('receiver_id', auth()->id())->whereStatus(0)->count();
        return response()->json($data);
    }
}
