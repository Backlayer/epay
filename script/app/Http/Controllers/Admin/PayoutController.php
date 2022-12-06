<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PayoutMail;
use Illuminate\Support\Facades\Mail;

class PayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payouts-read')->only('index');
    }

    public function index()
    {
        $data['withdraws'] = Payout::latest()->with('currency')
                    ->when(request('status') == 'approved', function($q) {
                        $q->where('status', 'approved');
                    })
                    ->when(request()->search, function($q) {
                        $q->where('trx', 'like', '%' . request('search') . '%');
                        $q->orWhere('amount', 'like', '%' . request('search') . '%');
                    })
                    ->when(request('status') == 'rejected', function($q) {
                        $q->where('status', 'rejected');
                    })
                    ->when(request('status') == 'pending', function($q) {
                        $q->where('status', 'pending');
                    })
                    ->paginate(10);

        return view('admin.payouts.index', $data);
    }

    public function show(Payout $payout)
    {
        $payout->load('userbank.bank', 'currency');
        return view('admin.payouts.show', compact('payout'));
    }

    public function approved(Request $request)
    {
        $withdraw = Payout::find($request->withdraw);
        if ($withdraw->status == 'rejected') {
            $user = User::find($withdraw->user_id);
            if ($user->wallet >= $withdraw->amount) {
                $user->update([
                    'wallet' => $user->wallet - $withdraw->amount
                ]);
            } else {
                return back()->with('error', __('Insufficient balance.'));
            }
        }
        // Send Email to admin
        if (env('QUEUE_MAIL')) {
            Mail::to(env('MAIL_TO'))->queue(new PayoutMail($withdraw));
        } else {
            Mail::to(env('MAIL_TO'))->send(new PayoutMail($withdraw));
        }
        $withdraw->update([
            'status' => 'approved'
        ]);

        return response()->json([
            'message' => __('Payout approved successfully.'),
            'redirect' => route('admin.payouts.index')
        ]);
    }

    public function reject(Request $request)
    {
        $withdraw = Payout::find($request->withdraw);
        $user = User::find($withdraw->user_id);
        $user->update([
            'wallet' => $user->wallet + $withdraw->amount
        ]);
        $withdraw->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'message' => __('Payout rejected successfully.'),
            'redirect' => route('admin.payouts.index')
        ]);
    }

    public function deleteAll(Request $request)
    {
        if ($request->input('ids') < 1){
            return response()->json([
                'message' => __("Please select at least one item")
            ], 422);
        }
        foreach ($request->ids as $id) {
            $withdraw = Payout::find($id);
            $withdraw->delete();
        }
        return response()->json([
            'message' => __('Payout deleted successfully'),
            'redirect' => route('admin.payouts.index')
        ]);
    }

    public function getPayouts()
    {
        $data['withdraws'] = Payout::count();
        $data['approved'] = Payout::where('status', 'approved')->count();
        $data['rejected'] = Payout::where('status', 'rejected')->count();
        $data['pending'] = Payout::where('status', 'pending')->count();
        return response()->json($data);
    }
}
