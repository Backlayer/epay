<?php

namespace App\Http\Controllers\User;

use App\Models\Storefront;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StoreFrontController extends Controller
{

    use HasUploader;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Storefront::where('user_id', auth()->id())
                    ->when(request()->has('search'), function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    })
                    ->latest()->paginate();
        return view('user.storefronts.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.storefronts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'note_status' => 'required|integer',
            'product_type' => 'required|boolean',
            'image' => 'required|image|max:1024',
            'shipping_status' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ]);

        Storefront::create([
            'user_id' => auth()->id(),
            'image' => $this->upload($request, 'image'),
        ] + $validated);

        return response()->json([
            'redirect' => route('user.storefronts.index'),
            'message' => __('Store front created successfully.')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storefront  $storefront
     * @return \Illuminate\Http\Response
     */
    public function show(Storefront $storefront)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storefront  $storefront
     * @return \Illuminate\Http\Response
     */
    public function edit(Storefront $storefront)
    {
        abort_if($storefront->user_id != auth()->id(), 404);
        return view('user.storefronts.edit', compact('storefront'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storefront  $storefront
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storefront $storefront)
    {
        abort_if($storefront->user_id != auth()->id(), 404);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'note_status' => 'required|integer',
            'product_type' => 'required|boolean',
            'image' => 'nullable|image|max:1024',
            'shipping_status' => 'required|integer',
            'status' => 'required|boolean',
            'description' => 'nullable|string|max:1000',
        ]);

        $storefront->update([
            'currency_id' => user_currency()->id,
            'image' => $request->image ? $this->upload($request, 'image', $storefront->image) :$storefront->image,
        ] + $validated);

        return response()->json([
            'redirect' => route('user.storefronts.index'),
            'message' => __('Store front updated successfully.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storefront  $storefront
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storefront $storefront)
    {
        abort_if($storefront->user_id != auth()->id(), 404);
        if (file_exists($storefront)) {
            Storage::delete($storefront);
        }
        $storefront->delete();
        return response()->json([
            'redirect' => route('user.storefronts.index'),
            'message' => __('Store front deleted successfully.')
        ]);
    }

    public function getStores()
    {
        $data['total'] = Storefront::whereUserId(auth()->id())->count();
        $data['physical'] = Storefront::whereUserId(auth()->id())->whereProductType(0)->count();
        $data['digital'] = Storefront::whereUserId(auth()->id())->whereProductType(1)->count();
        return response()->json($data);
    }
}
