<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::whereSellerId(auth()->id())->with('storefront')
                    ->when(request()->search, function($q) {
                        $q->where('invoice_no', 'like', '%' . request('search') . '%')
                        ->orWhere('email', 'like', '%' . request('search') . '%')
                        ->orWhere('name', 'like', '%' . request('search') . '%')
                        ->orWhere('amount', 'like', '%' . request('search') . '%');
                    })
                    ->when(request()->store, function($q) {
                        $q->where('storefront_id', 'like', '%' . request('store') . '%');
                    })
                    ->latest()
                    ->paginate();
        return view('user.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::whereSellerId(auth()->id())->with(['storefront', 'orderitems', 'shipping'])->findOrFail($id);
        return view('user.orders.view', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($request->type == 'cancle') {
            $order->status = 0;
        } else {
            $order->status = 2;
        }
        $order->save();
        $status = $order->status == 0 ? 'cancled':'approved';
        return response()->json([
            'message' => __('Order has been '. $status),
            'redirect' => route('user.orders.index'),
        ]);
    }

    public function getOrders()
    {
        $data['total'] = Order::whereSellerId(auth()->id())->count();
        $data['completed'] = Order::whereSellerId(auth()->id())->whereStatus(2)->count();
        $data['pending'] = Order::whereSellerId(auth()->id())->whereStatus(1)->count();
        $data['cancled'] = Order::whereSellerId(auth()->id())->whereStatus(0)->count();
        return response()->json($data);
    }

}
