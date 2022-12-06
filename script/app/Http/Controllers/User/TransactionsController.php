<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DonationOrder;
use App\Models\Invoice;
use App\Models\Qrpayment;
use App\Models\SingleChargeOrder;
use App\Models\Transaction;
use App\Models\UserPlanSubscriber;
use App\Models\WebOrder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $search = $request->get('search');

        if(is_null($type)){
            $transactions = Transaction::with('currency')->whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                })
                ->latest()
                ->paginate();
        }elseif ($type == 'single-charge'){
            $transactions =  SingleChargeOrder::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('trx', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('invoice_no', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                })
                ->with('currency', 'singleCharge')
                ->latest()
                ->paginate();
        }elseif ($type == 'donation'){
            $transactions =  DonationOrder::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('trx', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('invoice_no', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%')
                        ->orWhereHas('donor', function (Builder $builder) use ($search){
                            $builder->where('name', 'LIKE', '%'.$search.'%')
                                ->orWhere('email', 'LIKE', '%'.$search.'%');
                        });
                })
                ->with('currency', 'donation')
                ->latest()
                ->paginate();
        }elseif ($type == 'qr-code'){
            $transactions =  Qrpayment::whereSellerId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('trx', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('invoice_no', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                })
                ->with('seller')
                ->latest()
                ->paginate();
        }elseif ($type == 'invoice'){
            $transactions =  Invoice::whereOwnerId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('trx', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('invoice_no', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                })
                ->with('currency')
                ->latest()
                ->paginate();
        }elseif ($type == 'deposit'){
            $transactions = Deposit::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('trx', 'LIKE', '%'.$search.'%');
                })
                ->with('currency')
                ->latest()
                ->paginate();
        }elseif ($type == 'website'){
            $transactions = WebOrder::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('trx', 'LIKE', '%'.$search.'%')
                        ->orWhereHas('website', function (Builder $builder) use ($search){
                            $builder->where('merchant_name','LIKE', '%'.$search.'%');
                        });
                })
                ->with('website', 'currency')
                ->latest()
                ->paginate();
        }elseif ($type == 'plan'){
            $transactions = UserPlanSubscriber::whereSubscriberId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->whereHas('owner', function (Builder $builder) use ($search){
                        $builder->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orWhere('username', 'LIKE', '%'.$search.'%')
                            ->orWhere('phone', 'LIKE', '%'.$search.'%');
                    });
                })
                ->with('plan', 'owner', 'currency')
                ->latest()
                ->paginate();
        }else{
            abort(404, __("Transaction type didn't match, Please check the transaction type."));
        }

        return view('user.transactions.index', [
            'transactions' => $transactions,
            'type' => $type
        ]);
    }

    public function getTransaction()
    {
        $data['total'] = Transaction::whereUserId(auth()->id())->count();
        $data['credit'] = Transaction::whereUserId(auth()->id())->whereType('credit')->count();
        $data['debit'] = Transaction::whereUserId(auth()->id())->whereType('debit')->count();
        return response()->json($data);
    }
}
