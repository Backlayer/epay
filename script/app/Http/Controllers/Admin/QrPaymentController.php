<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qrpayment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QrPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payments-read')->only('index', 'show');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $qrPayments = Qrpayment::with('currency', 'seller')
            ->when(!is_null($search), function (Builder $builder) use ($search) {
                $builder->whereHas('seller', function (Builder $builder) use ($search) {
                    $builder->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('username', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate();

        return view('admin.payments.qrPayment.index', compact('qrPayments'));
    }

    public function show(Request $request, Qrpayment $qrPayment)
    {
        return view('admin.payments.qrPayment.show', compact('qrPayment'));
    }

    public function getQrPayments()
    {
        $data['total'] = Qrpayment::count();
        $data['paid'] = Qrpayment::whereStatusPaid('1')->count();
        $data['confirmed'] = Qrpayment::whereStatusPaid('2')->count();

        return response()->json($data);
    }

    public function confirm(Qrpayment $qrPayment)
    {
        abort_if($qrPayment->status_paid !== '1', 403, __('Qr has not been paid'));

        $qrPayment->status_paid = '2';
        $qrPayment->save();

        return response()->json([
            'message' => __('Qr Payment Confirmed Successfully'),
            'redirect' => route('admin.payments.qr-payment.index')
        ]);
    }
}
