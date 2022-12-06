<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = Transfer::with('user', 'currency')
                    ->when(request()->search, function($q) {
                        $q->where('amount', 'like', '%' . request('search') . '%')
                        ->orWhere('trx', 'like', '%' . request('search') . '%')
                        ->orWhere('email', 'like', '%' . request('search') . '%');
                    })
                    ->latest()->paginate();
        return view('admin.transfers.index', compact('transfers'));
    }

    public function getTransfers()
    {
        $data['total'] = Transfer::count();
        $data['completed'] = Transfer::whereStatus(2)->count();
        $data['pending'] = Transfer::whereStatus(1)->count();
        $data['refund'] = Transfer::whereStatus(3)->count();
        $data['cancled'] = Transfer::whereStatus(0)->count();
        return response()->json($data);
    }
}
