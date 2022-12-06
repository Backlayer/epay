<?php

namespace App\Http\Controllers\Admin;

use App\Models\Storefront;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:stores-read')->only('index', 'show');
    }
    public function index()
    {
        $stores = Storefront::latest()
                    ->when(request()->search, function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    })
                    ->paginate();
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storefront  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Storefront $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storefront $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'note_status' => 'required|integer',
            'product_type' => 'required|boolean',
            'image' => 'nullable|image|max:1024',
            'shipping_status' => 'required|integer',
            'status' => 'required|boolean',
            'description' => 'nullable|string|max:1000',
        ]);

        $store->update([
            'currency_id' => user_currency()->id,
            'image' => $request->image ? $this->upload($request, 'image', $store->image) :$store->image,
        ] + $validated);

        return response()->json([
            'redirect' => route('admin.stores.index'),
            'message' => __('Store has been updated successfully.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storefront  $storefront
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storefront $store)
    {
        if (file_exists($store)) {
            Storage::delete($store);
        }
        $store->delete();
        return response()->json([
            'redirect' => route('admin.stores.index'),
            'message' => __('Store has been deleted successfully.')
        ]);
    }

    public function getStores()
    {
        $data['total'] = Storefront::count();
        $data['physical'] = Storefront::whereProductType(0)->count();
        $data['digital'] = Storefront::whereProductType(1)->count();
        return response()->json($data);
    }
}
