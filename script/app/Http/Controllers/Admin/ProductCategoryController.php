<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:category-read')->only('index');
    }

    public function index()
    {
        $categories = ProductCategory::with('user')
                    ->when(request()->search, function($q) {
                        $q->where('title', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate();

        return view('admin.categories.index', compact('categories'));
    }
}
