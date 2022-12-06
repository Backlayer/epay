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
            ->when(!is_null($search), function (Builder $builder)use($search){
                $builder->WhereHas('user', function (Builder $builder) use ($search){
                    $builder->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
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
        $data['total'] = Transaction::count();
        $data['credit'] = Transaction::whereType('credit')->count();
        $data['debit'] = Transaction::whereType('debit')->count();
        return response()->json($data);
    }

}
