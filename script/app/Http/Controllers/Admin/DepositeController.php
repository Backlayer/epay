<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DepositeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deposits-read')->only('index', 'show');
    }

    public function index()
    {
        $deposits = Deposit::latest()->with('gateway')
                    ->when(request()->search, function($q) {
                        $q->where('trx', 'like', '%' . request('search') . '%');
                        $q->orWhere('amount', 'like', '%' . request('search') . '%');
                    })
                    ->paginate();
        return view('admin.deposits.index', compact('deposits'));
    }

    public function show(Deposit $deposit)
    {
        return view('admin.deposits.show', compact('deposit'));
    }

    public function approve($id)
    {
        \DB::beginTransaction();
        try {

            $deposit = Deposit::findOrFail($id);
            $deposit->status = 1;
            $deposit->save();

            $user = User::findOrFail($deposit->user_id);
            $user->update([
                'wallet' => $user->wallet + $deposit->amount
            ]);

            \DB::commit();

            return response()->json([
                'message' => __('Deposit has been approved.'),
                'redirect' => route('admin.deposits.index')
            ]);
        } catch (\Throwable $th) {
            \DB::rollback();
            return response()->json([
                'message' => __('Something was wrong.'),
            ]);
        }
    }

    public function reject($id)
    {
        \DB::beginTransaction();
        try {
            $deposit = Deposit::findOrFail($id);
            if ($deposit->status == 1) {
                $user = User::findOrFail($deposit->user_id);
                if ($user->wallet < $deposit->amount) {
                    return response()->json([
                        'message' => __('Insufficient balance.'),
                    ], 404);
                }
                $user->update([
                    'wallet' => $user->wallet - $deposit->amount
                ]);
            }
            $deposit->status = 0;
            $deposit->save();

            \DB::commit();

            return response()->json([
                'message' => __('Deposit has been cancled.'),
                'redirect' => route('admin.deposits.index')
            ]);

        } catch (\Throwable $th) {
            \DB::rollback();
            return response()->json([
                'message' => __('Something was wrong.'),
            ]);
        }
    }

    public function destroy(Deposit $deposit)
    {
        if (file_exists($deposit->meta['image'] ?? false)) {
            Storage::delete($deposit->meta['image']);
        }
        $deposit->delete();

        return response()->json([
            'message' => __('Deposit has been destroy.'),
            'redirect' => route('admin.deposits.index')
        ]);
    }

    public function getDeposits()
    {
        $data['total'] = Deposit::count();
        $data['completed'] = Deposit::whereStatus(1)->count();
        $data['pending'] = Deposit::whereStatus(2)->count();
        $data['rejected'] = Deposit::whereStatus(0)->count();
        return response()->json($data);
    }
}
