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
use App\Models\Moneyrequest;
use App\Helpers\HasUploader;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    use HasUploader;

    public function index(Request $request, $type = null)
    {
        $search = $request->get('search');

        if (is_null($type)) {
            $transactions = Transaction::with('currency')->whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                })
                ->latest()
                ->paginate();
        } elseif ($type == 'single-charge') {
            $transactions =  SingleChargeOrder::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('trx', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                })
                ->with('currency', 'singleCharge')
                ->latest()
                ->paginate();
        } elseif ($type == 'donation') {
            $transactions =  DonationOrder::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('trx', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('donor', function (Builder $builder) use ($search) {
                            $builder->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%');
                        });
                })
                ->with('currency', 'donation')
                ->latest()
                ->paginate();
        } elseif ($type == 'qr-code') {
            $transactions =  Qrpayment::whereSellerId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('trx', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                })
                ->with('seller')
                ->latest()
                ->paginate();
        } elseif ($type == 'request-money') {
            $transactions =  Moneyrequest::whereReceiverId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->whereHas('sender', function (Builder $builder) use ($search) {
                        $builder->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%');
                    });
                })
                ->with('sender')
                ->latest()
                ->paginate();
        } elseif ($type == 'invoice') {
            $transactions =  Invoice::whereOwnerId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('trx', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                })
                ->with('currency')
                ->latest()
                ->paginate();
        } elseif ($type == 'deposit') {
            $transactions = Deposit::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('trx', 'LIKE', '%' . $search . '%');
                })
                ->with('currency')
                ->latest()
                ->paginate();
        } elseif ($type == 'website') {
            $transactions = WebOrder::whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->where('trx', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('website', function (Builder $builder) use ($search) {
                            $builder->where('merchant_name', 'LIKE', '%' . $search . '%');
                        });
                })
                ->with('website', 'currency')
                ->latest()
                ->paginate();
        } elseif ($type == 'plan') {
            $transactions = UserPlanSubscriber::whereSubscriberId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search) {
                    $builder->whereHas('owner', function (Builder $builder) use ($search) {
                        $builder->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%')
                            ->orWhere('username', 'LIKE', '%' . $search . '%')
                            ->orWhere('phone', 'LIKE', '%' . $search . '%');
                    });
                })
                ->with('plan', 'owner', 'currency')
                ->latest()
                ->paginate();
        } else {
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

    private function sourceRelations($type, $id)
    {
        $source = [
            'Invoice' => "App\Models\Invoice",
            'Qrpayment' => "App\Models\Qrpayment",
            'SingleChargeOrder' => "App\Models\SingleChargeOrder",
        ][$type];

        $record = $source::whereId($id)->first();

        if ($record) {
            return $record;
        }

        return redirect()->back()->with('error', __('Record Not Found'));
    }

    public function uploadFile(Request $request)
    {
        $record = $this->sourceRelations($request->type, $request->id);

        $oldFile = $record->invoice_file ?? null;
        
        $record->invoice_file = $this->upload($request, 'invoice_file', $oldFile);
        $record->save();

        return redirect()->back()->with('success', __('Invoice Uploaded'));
    }

    public function updateInvoiceNum(Request $request)
    {
        $saved = false;
        $record = $this->sourceRelations($request->type, $request->id);

        $record->invoice_no = $request->invoice_num;

        if ($record->save()) {
            $transaction = Transaction::whereSourceData($request->type)
                ->whereSourceId($request->id)->first();

            if ($transaction) {
                $transaction->invoice_no = $request->invoice_num;
                $transaction->save();
            }

            $saved = true;
        }

        if ($saved) {
            return redirect()->back()->with('success', __('Successfully Updated'));
        }

        return redirect()->back()->with('error', __('Changes Not Saved'));
    }
}
