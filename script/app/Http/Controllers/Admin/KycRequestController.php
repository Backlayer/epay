<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class KycRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kyc-requests-create')->only('create', 'store');
        $this->middleware('permission:kyc-requests-read')->only('index', 'show');
        $this->middleware('permission:kyc-requests-update')->only('edit', 'update');
        $this->middleware('permission:kyc-requests-delete')->only('edit', 'destroy', 'destroyMass');
    }
    public function index(Request $request)
    {
        $all        = KycRequest::count();
        $approved   = KycRequest::where('status', '1')->count();
        $pending    = KycRequest::where('status', '0')->count();
        $rejected   = KycRequest::where('status', '2')->count();
        $reSubmitted   = KycRequest::where('status', '3')->count();

        $requests = KycRequest::with('user', 'method')
            ->when($request->get('status') !== null, function (Builder $query) use ($request){
                $type = $request->get('status');
                $query->where('status', '=', $type);
            })
            ->when($request->has('user'), function (Builder $query) use($request){
                $query->where('user_id', '=', $request->user);
            })
            ->when($request->get('src') !== null, function (Builder $query) use($request){
                $query->whereHas('user', function (Builder $query) use($request){
                    $query->where('name', 'LIKE', '%'.$request->get('src').'%')
                        ->orWhere('username', 'LIKE', '%'.$request->get('src').'%')
                        ->orWhere('phone' , 'LIKE', '%'.$request->get('src').'%')
                        ->orWhere('email' , 'LIKE', '%'.$request->get('src').'%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.kycrequests.index', compact('requests', 'all', 'approved', 'pending', 'rejected', 'reSubmitted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'request' => ['required', 'exists:kyc_requests,id'],
            'status' => ['required', Rule::in('approve', 'reject', 'pending')],
        ]);

        if ($request->get('status') == 'approve'){
            $status = 1;
        }elseif ($request->get('status') == 'reject'){
            $status = 2;
        }else{
            $status = 0;
        }

        $kycRequest = KycRequest::findOrFail($request->get('request'));
        $kycRequest->update([
            'status' => $status,
            'rejected_at' => $status == 2 ? today() : null
        ]);
        $kycRequest->user->update([
            'kyc_verified_at' => now()
        ]);

//        $kycRequest->user->notify(new KycRequestNotification($kycRequest));

        return response()->json([
            'message' => __('KYC Verification Successfully :status', ['status' => str($request->get('status'))->ucfirst()]),
            'redirect' => url()->previous()
        ]);
    }

    public function show(KycRequest $kycRequest)
    {
        return view('admin.kycrequests.show', compact('kycRequest'));
    }

    public function destroy(KycRequest $kycRequest)
    {
        $kycRequest->delete();

        return response()->json([
            'message' => __('KYC Request Deleted Successfully'),
            'redirect' => route('admin.kyc-requests.index')
        ]);
    }

    public function destroyMass(Request $request){
        foreach ($request->input('id') as $id) {
            $plan = KycRequest::findOrFail($id);
            $plan->delete();
        }

        return response()->json([
            'message' => __('KYC Requests Deleted Successfully'),
            'redirect' => route('admin.kyc-requests.index')
        ]);
    }
}
