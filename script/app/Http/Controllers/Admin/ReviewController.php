<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reviews-create')->only('create', 'store');
        $this->middleware('permission:reviews-read')->only('index', 'show');
        $this->middleware('permission:reviews-update')->only('edit', 'update');
        $this->middleware('permission:reviews-delete')->only('edit', 'destroy');
    }

    public function index(Request $request)
    {
        $reviews = Category::where('key', '=', 'reviews')
            ->when($request->get('src') !== null, function (Builder $query) use ($request) {
                $query->whereJsonContains('value->name', $request->get('src'));
            })
            ->latest()
            ->paginate();

        return view("admin.reviews.index", compact('reviews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'string'],
            'name' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'numeric', 'before_or_equal:0,5'],
            'comment' => ['required', 'string', 'max:500'],
        ]);

        Category::create([
            'key' => 'reviews',
            'value' => $validated,
            'status' => $request->input('status')
        ]);

        Cache::forget('website.home.' . current_locale());

        return response()->json([
            'message' => __('Review Created Successfully'),
            'redirect' => route('admin.reviews.index')
        ]);
    }

    public function create()
    {
        return view("admin.reviews.create");
    }

    public function edit(Category $review)
    {
        return view("admin.reviews.edit", compact('review'));
    }

    public function update(Request $request, Category $review)
    {
        $validated = $request->validate([
            'image' => ['required', 'string'],
            'name' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'numeric', 'before_or_equal:0,5'],
            'comment' => ['required', 'string', 'max:500'],
        ]);

        $review->update([
            'value' => $validated,
            'status' => $request->input('status')
        ]);

        Cache::forget('website.home.' . current_locale());

        return response()->json([
            'message' => __('Review Updated Successfully'),
            'redirect' => route('admin.reviews.index')
        ]);
    }

    public function destroy(Category $review)
    {
        $review->delete();

        Cache::forget('website.home.' . current_locale());

        return response()->json([
            'message' => __('Review Deleted Successfully'),
            'redirect' => route('admin.reviews.index')
        ]);
    }
}
