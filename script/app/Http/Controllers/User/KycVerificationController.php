<?php

namespace App\Http\Controllers\User;

use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\KycRequest;
use App\Models\KycMethod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KycVerificationController extends Controller
{
    use HasUploader;
    public function index()
    {
        $documents = KycRequest::whereUserId(\Auth::id())->with('method')->latest()->paginate();

        return view('user.kyc-verifications.index', compact('documents'));
    }

    public function create()
    {
        abort_if(Auth::user()->kyc_verified_at, 403);
        $kyc_methods = KycMethod::whereDoesntHave('users', function (Builder $query){
            $query->where('user_id', '=', Auth::id());
        })
            ->whereStatus(1)
            ->get();

        return view('user.kyc-verifications.create', compact('kyc_methods'));
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->kyc_verified_at, 403);
        $request->validate([
            'note' => ['nullable', 'string'],
            'fields' => ['required', 'array'],
            'method' => ['required' ,'exists:kyc_methods,id']
        ]);

        $method = KycMethod::findOrFail($request->input('method'));

        $exits = KycRequest::where([
            'id' => $method->id,
            'user_id' => Auth::id(),
            'status' => 2
        ])->exists();

        if ($exits){
            return response()->json([
                'message' => __("You're already submitted")
            ], 403);
        }

        foreach ($method->fields ?? [] as $index => $item) {
            if ($item['type'] == 'file'){
                $request->validate([
                    'fields.'.$item['label'] => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // 2MB
                ]);
            }
        }

        $data = [];
        foreach ($request->fields as $key => $value) {
            $field = $request->fields[$key];
            if(is_file($field)){
                $data[$key] = $this->upload($request, 'fields.'.$key);
            }else {
                $data[$key] = $field;
            }
        }

        $kyc_request = KycRequest::create([
            'user_id' => \Auth::id(),
            'kyc_method_id' => $request->input('method'),
            'status' => 0,
            'note' => $request->input('note'),
            'data' => $data,
            'fields' => $method->fields
        ]);

        $method->users()->attach(Auth::id(), ['kyc_request_id' => $kyc_request->id]);

        return response()->json([
            'message' => __("KYC Document Submitted Successfully"),
            'redirect' => route('user.kyc-verifications.index')
        ]);
    }

    public function show($id)
    {
        $kycRequest = KycRequest::findOrFail($id);
        abort_if($kycRequest->user_id !== Auth::id(), 404);
        return view('user.kyc-verifications.show', compact('kycRequest'));
    }

    public function resubmit(KycRequest $kycRequest)
    {
        abort_if(Auth::user()->kyc_verified_at, 403);
        abort_if($kycRequest->status !== 2, 403);
        return view('user.kyc-verifications.resubmit', compact('kycRequest'));
    }

    public function resubmitUpdate(Request $request, KycRequest $kycRequest)
    {
        abort_if(Auth::user()->kyc_verified_at, 403);
        if ($request->ajax() && $kycRequest->status !== 2){
            return response()->json(__("You're already submitted"), 403);
        }
        abort_if($kycRequest->status !== 2, 403);

        $request->validate([
            'note' => ['nullable', 'string'],
            'fields' => ['required', 'array'],
        ]);

        foreach ($kycRequest->fields ?? [] as $index => $item) {
            if ($item['type'] == 'file'){
                $request->validate([
                    'fields.'.$item['label'] => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // 2MB
                ]);
            }
        }

        $data = [];
        foreach ($request->fields as $key => $value) {
            $field = $request->fields[$key];

            if(is_file($field)){
                $data[$key] = $this->upload($request, $field);

                if (Storage::disk(config('filesystems.default'))->exists($kycRequest->data[$key])){
                    Storage::disk(config('filesystems.default'))->delete($kycRequest->data[$key]);
                }
            }else {
                $data[$key] = $field;
            }
        }

        $kycRequest->update([
            'status' =>3,
            'note' => $request->input('note'),
            'data' => $data,
        ]);

        return response()->json([
            'message' => __("KYC Document Re-Submitted Successfully"),
            'redirect' => route('user.kyc-verifications.index')
        ]);
    }
}
