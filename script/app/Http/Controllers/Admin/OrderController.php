<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExtraOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Order;
use Throwable;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders-create')->only('create', 'store');
        $this->middleware('permission:orders-read')->only('index', 'show', 'print', 'orderPdf');
        $this->middleware('permission:orders-update')->only('edit', 'update', 'paymentStatusUpdate');
        $this->middleware('permission:orders-delete')->only('edit', 'destroy', 'massDestroy');
    }
    public function index(Request $request)
    {
        $orders = Order::latest()->with('storefront', 'currency')
                    ->when(request()->search, function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('email', 'like', '%' . request('search') . '%')
                        ->orWhere('amount', 'like', '%' . request('search') . '%');
                    })
                    ->when($request->status == 'approved', function($q) {
                        return $q->where('status', 2);
                    })
                    ->when($request->status == 'cancled', function($q) {
                        return $q->where('status', 0);
                    })
                    ->when($request->status == 'pending', function($q) {
                        return $q->where('status', 1);
                    })
                    ->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderitems', 'storefront', 'currency', 'seller');
        return view('admin.orders.show', compact('order'));
    }

    public function massDestroy(Request $request)
    {
        if ($request->input('ids') < 1){
            return response()->json([
                'message' => __("Please select at least one item")
            ], 422);
        }
        foreach ($request->ids as $id) {
            $order = Order::find($id);
            $order->delete();
        }
        return response()->json([
            'message' => __('Orders deleted successfully'),
            'redirect' => route('admin.orders.index')
        ]);
    }

    public function getOrders()
    {
        $data['total'] = Order::count();
        $data['completed'] = Order::whereStatus(2)->count();
        $data['pending'] = Order::whereStatus(1)->count();
        $data['cancled'] = Order::whereStatus(0)->count();
        return response()->json($data);
    }
}
