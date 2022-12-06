<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Storefront;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products-read')->only('index');
    }

    public function index()
    {
        $stores = Storefront::latest()->with('products')
                    ->when(request()->search, function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    })
                    ->paginate();
        return view('admin.products.index', compact('stores'));
    }

    public function getProducts()
    {
        $data['total'] = Product::count();
        $data['physical'] = Product::whereType(0)->count();
        $data['digital'] = Product::whereType(1)->count();
        return response()->json($data);
    }
}
