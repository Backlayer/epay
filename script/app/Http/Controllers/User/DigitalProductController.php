<?php

namespace App\Http\Controllers\User;

use App\Helpers\HasUploader;
use App\Models\Product;
use App\Models\Storefront;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\ProductStorefront;
use Illuminate\Support\Facades\Storage;

class DigitalProductController extends Controller
{
    use HasUploader;

    public function index()
    {
        $products = Product::where('user_id', auth()->id())->whereType(1)
                    ->when(request()->search, function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                        $q->orWhere('price', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate();
        return view('user.digital-products.index', compact('products'));
    }

    public function create()
    {
        $stores = Storefront::where('user_id', auth()->id())->where('product_type', 1)->latest()->get();
        $categories = ProductCategory::where('user_id', auth()->id())->latest()->get();
        return view('user.digital-products.create', compact('categories', 'stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'link' => 'required|string',
            'image' => 'required|image|max:1024',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'confirmation_message' => 'nullable|string|max:1000',
        ]);

        $product = Product::create([
            'type' => 1,
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->input('name')),
            'image' => $this->upload($request, 'image'),
        ] + $validated);

        $product->stores()->sync($request->input('store_ids'));

        return response()->json([
            'redirect' => route('user.digital-products.index', ['action' => 'products']),
            'message' => __('Digital product created successfully.')
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
        $stores = Storefront::where('user_id', auth()->id())->where('product_type', 1)->latest()->get();
        return view('user.digital-products.edit', compact('categories', 'product', 'storeids', 'stores'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'link' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
            'quantity' => 'required|integer',
            'confirmation_message' => 'nullable|string|max:1000',
        ]);


        $product->update([
            'image' => $request->image ? $this->upload($request, 'image', $product->image) : $product->image,
        ] + $validated);


        $product->stores()->sync($request->input('store_ids'));

        return response()->json([
            'redirect' => route('user.digital-products.index', ['action' => 'products']),
            'message' => __('Digital product updated successfully.')
        ]);
    }

    public function destroy($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        abort_if($product->user_id != auth()->id(), 404);
        $product->delete();
        return response()->json([
            'redirect' => route('user.digital-products.index', ['action' => 'products']),
            'message' => __('Digital product deleted successfully.')
        ]);
    }

    public function getProducts()
    {
        $data['total'] = Product::whereUserId(auth()->id())->whereType(1)->count();
        $data['quantity'] = Product::whereUserId(auth()->id())->whereType(1)->sum('quantity');
        return response()->json($data);
    }
}
