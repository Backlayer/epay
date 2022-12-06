<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SingleCharge;
use Auth;
use Illuminate\Http\Request;

class SingleChargeController extends Controller
{
    public function index(Request $request)
    {
        $charges = SingleCharge::whereUserId(Auth::id())
            ->with('currency')
            ->latest()
            ->paginate();

        return view('user.single-charges.index', compact('charges'));
    }

    public function create()
    {
        $charge = get_option('charges')['single_payment_charge'] ?? ['rate' => 0, 'type' => 'percentage'];
        return view('user.single-charges.create', compact('charge'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'description' => ['required', 'string'],
            'redirect_url' => ['nullable', 'string']
        ]);

        $singleCharge = SingleCharge::create([
            'uuid' => \Str::uuid(),
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'user_id' => Auth::id(),
            'currency_id' => Auth::user()->currency_id,
            'status' => 1,
            'meta' => [
                'description' => $validated['description'],
                'redirect_url' => $validated['redirect_url']
            ]
        ]);

        return response()->json([
            'message' => __('Payment Link Created Successfully'),
            'redirect' => route('user.single-charges.index')
        ]);
    }

    public function show(SingleCharge $singleCharge)
    {
        abort_if($singleCharge->user_id !== Auth::id(), 404);
        $orders = $singleCharge->orders()->with('currency')->latest()->paginate();
        return view('user.single-charges.show', compact('singleCharge', 'orders'));
    }

    public function edit(SingleCharge $singleCharge)
    {
        abort_if($singleCharge->user_id !== Auth::id(), 404);
        $charge = get_option('charges')['single_payment_charge'] ?? ['rate' => 4, 'type' => 'percentage'];
        return view('user.single-charges.edit', compact('singleCharge', 'charge'));
    }

    public function update(Request $request, SingleCharge $singleCharge)
    {
        abort_if($singleCharge->user_id !== Auth::id(), 404);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'description' => ['required', 'string'],
            'redirect_url' => ['nullable', 'string']
        ]);

        $singleCharge->update([
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'status' => 1,
            'meta' => [
                'description' => $validated['description'],
                'redirect_url' => $validated['redirect_url']
            ]
        ]);

        return response()->json([
            'message' => __('Payment Link Update Successfully'),
            'redirect' => route('user.single-charges.index')
        ]);
    }

    public function destroy(SingleCharge $singleCharge)
    {
        abort_if($singleCharge->user_id !== Auth::id(), 404);
        if ($singleCharge->orders()->count() > 0){
            return response()->json([
                'message' => __('You are not allowed to delete. Because it has :number orders', ['number' => $singleCharge->orders()->count()])
            ], 403);
        }

        $singleCharge->delete();

        return response()->json([
            'message' => __('Single Charge Deleted Successfully'),
            'redirect' => route('user.single-charges.index')
        ]);
    }

    public function disable(SingleCharge $charge)
    {
        abort_if(Auth::id() !== $charge->user_id, 404);

        $charge->update([
            'status' => !$charge->status
        ]);

        $message = $charge->status ?
            __('Single Charge Link Has Been Activated') :
            __('Single Charge Link Has Been Disabled');

        return response()->json([
            'message' => $message,
            'redirect' => route('user.single-charges.index')
        ]);
    }

    public function getSingleCharge()
    {
        $data['total'] = SingleCharge::whereUserId(auth()->id())->count();
        $data['active'] = SingleCharge::whereUserId(auth()->id())->whereStatus(1)->count();
        $data['paused'] = SingleCharge::whereUserId(auth()->id())->whereStatus(0)->count();
        return response()->json($data);
    }
}
