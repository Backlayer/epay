<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Str;
use Stripe\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::where('user_id', auth()->id())
                    ->when(request()->has('search'), function($q) {
                        $q->where('title', 'like', '%' . request('search') . '%');
                    })
                    ->latest()->paginate();
        return view('user.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100'
        ]);

        ProductCategory::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);

        return response()->json([
            'redirect' => route('user.categories.index'),
            'message' => __('Category created successfully.')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100'
        ]);
        $category = ProductCategory::findOrFail($id);
        abort_if($category->user_id != auth()->id(), 404);
        $category->update([
            'title' => $request->title,
        ]);

        return response()->json([
            'redirect' => route('user.categories.index'),
            'message' => __('Category updated successfully.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        abort_if($category->user_id != auth()->id(), 404);
        $category->delete();
        return response()->json([
            'redirect' => route('user.categories.index'),
            'message' => __('Category deleted successfully.')
        ]);
    }
}
