<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Withdraw;
use App\Mail\WithdrawMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['total_withdraws'] = Withdraw::count();
        $data['total_approved'] = Withdraw::where('status', 'approved')->count();
        $data['total_rejected'] = Withdraw::where('status', 'rejected')->count();
        $data['total_pending'] = Withdraw::where('status', 'pending')->count();
        $data['withdraws'] = Withdraw::latest()->with('withdraw_method.currency')
                    ->when(request('status') == 'approved', function($q) {
                        $q->where('status', 'approved');
                    })
                    ->when(request('status') == 'rejected', function($q) {
                        $q->where('status', 'rejected');
                    })
                    ->when(request('status') == 'pending', function($q) {
                        $q->where('status', 'pending');
                    })
                    ->paginate(10);

        return view('admin.withdraws.index', $data);
    }

    public function approved(Request $request)
    {
        $withdraw = Withdraw::find($request->withdraw);
        if ($withdraw->status == 'rejected') {
            $user = User::find($withdraw->user_id);
            $user->update([
                'wallet' => $user->wallet - $withdraw->amount
            ]);
        }

        // Send Email to admin
        if (env('QUEUE_MAIL')) {
            Mail::to(env('MAIL_TO'))->queue(new WithdrawMail($withdraw));
        } else {
            Mail::to(env('MAIL_TO'))->send(new WithdrawMail($withdraw));
        }

        $withdraw->update([
            'status' => 'approved'
        ]);

        return back()->with('success', __('Withdraw approved successfully.'));
    }

    public function reject(Request $request)
    {
        $withdraw = Withdraw::find($request->withdraw);
        $user = User::find($withdraw->user_id);
        $user->update([
            'wallet' => $user->wallet + $withdraw->amount
        ]);
        $withdraw->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', __('Withdraw rejected successfully.'));
    }

    public function deleteAll(Request $request)
    {
        foreach ($request->ids as $id) {
            $withdraw = Withdraw::find($id);
            $withdraw->delete();
        }
        return response()->json(__('Withdraw deleted successfully'));
    }
}
