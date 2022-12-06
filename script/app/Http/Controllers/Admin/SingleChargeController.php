<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SingleCharge;
use App\Models\SingleChargeOrder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SingleChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payments-read')->only('index', 'show');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $singleCharges = SingleCharge::with('currency','user')
            ->when(!is_null($search), function (Builder $builder) use ($search){
                $builder->whereHas('user', function (Builder $builder) use ($search){
                    $builder->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('username', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                });
            })
            ->withCount('orders')
            ->latest()
            ->paginate();
        return view('admin.payments.singleCharge.index', compact('singleCharges'));
    }

    public function show(Request $request, SingleCharge $singleCharge)
    {
        $search = $request->get('search');

        $orders = $singleCharge->orders()
            ->when(!is_null($search), function (Builder $builder) use($search){
                $builder->where('trx', 'LIKE', '%'.$search.'%')
                    ->orWhere('invoice_no', 'LIKE', '%'.$search.'%')
                    ->orWhere('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');
            })
            ->latest()
            ->paginate();

        return view('admin.payments.singleCharge.show', compact('singleCharge', 'orders'));
    }

    public function getSingleCharge()
    {
        $data['total'] = SingleCharge::count();
        $data['active'] = SingleCharge::whereStatus(1)->count();
        $data['paused'] = SingleCharge::whereStatus(0)->count();
        return response()->json($data);
    }
}
