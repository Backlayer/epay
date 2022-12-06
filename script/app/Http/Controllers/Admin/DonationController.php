<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reports-read|transactions-read')->only('index', 'show');
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $donationLinks = Donation::with('user')
            ->when(!is_null($search), function (Builder $builder)use($search){
                $builder->where('title',  'LIKE', '%'.$search.'%')
                    ->orWhereHas('user', function (Builder $builder) use ($search){
                        $builder->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orWhereJsonContains('meta', $search);
                    });
            })
            ->withCount('orders')
            ->latest()
            ->paginate();
        return view('admin.payments.donations.index', compact('donationLinks'));
    }

    public function show(Request $request, Donation $donation)
    {
        $search = $request->get('search');
        $orders = $donation->orders()->with('gateway', 'currency', 'donation')
            ->when(!is_null($search), function (Builder $builder) use($search){
                $builder->where('trx', 'LIKE', '%'.$search.'%')
                    ->orWhere('invoice_no', 'LIKE', '%'.$search.'%')
                    ->orWhere('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');
            })
            ->latest()
            ->paginate();

        return view('admin.payments.donations.show', compact('donation', 'orders'));
    }

    public function getDonations()
    {
        $data['total'] = Donation::count();
        $data['active'] = Donation::whereStatus(1)->count();
        $data['paused'] = Donation::whereStatus(0)->count();
        return response()->json($data);
    }
}
