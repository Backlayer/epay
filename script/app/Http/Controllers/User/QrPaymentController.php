<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Qrpayment;
use Illuminate\Http\Request;

class QrPaymentController extends Controller
{
    public function index()
    {
        $qrPayments = Qrpayment::when(request()->search, function($q) {
                $q->where('invoice_no', 'like', '%' . request('search') . '%');
                $q->orWhere('trx', 'like', '%' . request('search') . '%');
                $q->orWhere('email', 'like', '%' . request('search') . '%');
                $q->orWhere('name', 'like', '%' . request('search') . '%');
                $q->orWhere('amount', 'like', '%' . request('search') . '%');
            })
            ->latest()->paginate();
        return view('user.qrpayments.index', compact('qrPayments'));
    }

    public function getQrPayments()
    {
        $data['total'] = Qrpayment::whereSellerId(auth()->id())->count();
        $data['quantity'] = Qrpayment::whereSellerId(auth()->id())->sum('amount');
        return response()->json($data);
    }

}
