<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transactions-read')->only('index', 'show');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $transactions = Transaction::with('currency', 'user')
            ->when(!is_null($search), function (Builder $builder) use ($search) {
                $builder->WhereHas('user', function (Builder $builder) use ($search) {
                    $builder->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    public function getTransaction()
    {
        $total = Transaction::whereUserId(auth()->id())->selectRaw('COUNT(*) AS count, SUM(amount) AS sum')->first();
        $credit = Transaction::whereUserId(auth()->id())->whereType('credit')->selectRaw('COUNT(*) AS count, SUM(amount) AS sum')->first();
        $debit = Transaction::whereUserId(auth()->id())->whereType('debit')->selectRaw('COUNT(*) AS count, SUM(amount) AS sum')->first();

        $data['total'] = [
            'count' => $total['count'],
            'sum' => currency_format($total['sum'], currency: user_currency())
        ];
        $data['credit'] = [
            'count' => $credit['count'],
            'sum' => currency_format($credit['sum'], currency: user_currency())
        ];
        $data['debit'] = [
            'count' => $debit['count'],
            'sum' => currency_format($debit['sum'] * -1, currency: user_currency())
        ];

        return response()->json($data);
    }
}
