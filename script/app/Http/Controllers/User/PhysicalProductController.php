<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Storefront;
use Illuminate\Support\Str;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\ProductStorefront;
use Illuminate\Support\Facades\Storage;

class PhysicalProductController extends Controller
{
    use HasUploader;

    public function index()
    {
        $products = Product::where('user_id', auth()->id())->whereType(0)
                    ->when(request()->search, function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                        $q->orWhere('price', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate();

        return view('user.physical-products.index', compact('products'));
    }

    public function create()
    {
        $stores = Storefront::where('user_id', auth()->id())->where('product_type', 0)->latest()->get();
        $categories = ProductCategory::where('user_id', auth()->id())->latest()->get();
        return view('user.physical-products.create', compact('categories', 'stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'image' => 'required|image|max:1024',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $product = Product::create([
            'type' => 0,
            'user_id' => auth()->id(),
            'image' => $this->upload($request, 'image'),
        ] + $validated);

        $product->stores()->sync($request->input('store_ids'));

        return response()->json([
            'redirect' => route('user.physical-products.index'),
            'message' => __('Physical product created successfully.')
        ]);
    }

    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        $categories = ProductCategory::where('user_id', auth()->id())->latest()->get();
        $storeids = ProductStorefront::where('product_id', $product->id)->pluck('storefront_id');
        $stores = Storefront::where('user_id', auth()->id())->where('product_type', 0)->latest()->get();
        return view('user.physical-products.edit', compact('categories', 'product', 'storeids', 'stores'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:1024',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'image' => $request->image ? $this->upload($request, 'image', $product->image) : $product->image,
        ] + $validated);

        $product->stores()->sync($request->input('store_ids'));

        return response()->json([
            'redirect' => route('user.physical-products.index'),
            'message' => __('Physical product updated successfully.')
        ]);
    }

    public function destroy($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        abort_if($product->user_id != auth()->id(), 404);
        $product->delete();
        return response()->json([
            'redirect' => route('user.physical-products.index'),
            'message' => __('Physical product deleted successfully.')
        ]);
    }

    public function storeProducts($store_id)
    {
        $store = Storefront::where('user_id', auth()->id())->findOrFail($store_id);
        $products = $store->products()->paginate();
        if ($store->product_type) {
            return view('user.digital-products.index', compact('products'));
        } else {
            return view('user.physical-products.index', compact('products'));
        }
    }

    public function getProducts()
    {
        $data['total'] = Product::whereUserId(auth()->id())->whereType(0)->count();
        $data['quantity'] = Product::whereUserId(auth()->id())->whereType(0)->sum('quantity');
        return response()->json($data);
    }
}
