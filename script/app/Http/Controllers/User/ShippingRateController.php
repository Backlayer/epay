<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingRateController extends Controller
{
    public function index()
    {
        $shippings = Shipping::whereUserId(auth()->id())
                    ->when(request()->search, function($q) {
                        $q->where('region', 'like', '%' . request('search') . '%');
                        $q->orWhere('amount', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate();
        return view('user.shipping-rate.index', compact('shippings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'region' => 'required|string|max:1000',
            'amount' => 'required|integer',
        ]);

        Shipping::create($request->all() + [
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'redirect' => route('user.shipping-rate.index'),
            'message' => __('Shipping fee created successfully.')
        ]);
    }

    public function show(Shipping $shipping)
    {
        //
    }

    public function edit(Shipping $shipping)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'region' => 'required|string|max:1000',
            'amount' => 'required|integer',
        ]);

        $shipping = Shipping::whereUserId(auth()->id())->findOrFail($id);
        $shipping->update($request->all());

        return response()->json([
            'redirect' => route('user.shipping-rate.index'),
            'message' => __('Shipping updated successfully.')
        ]);
    }

    public function destroy($id)
    {
        $shipping = Shipping::whereUserId(auth()->id())->findOrFail($id);
        $shipping->delete();
        return response()->json([
            'redirect' => route('user.shipping-rate.index'),
            'message' => __('Shipping fee deleted successfully.')
        ]);
    }
}
