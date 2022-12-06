<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FAQController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->except('index');
    }
    public function index(){
        $faqs = Category::where([
                'key' => 'faq',
            ])
            ->get();

        return view('admin.settings.website.faq.index', compact('faqs'));
    }

    public function create(){
        return view('admin.settings.website.faq.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        Category::create([
            'key' => 'faq',
            'value' => $validated
        ]);

        Cache::forget('website.home.'.current_locale());

        return response()->json([
            'message' => __('FAQ Created Successfully'),
            'redirect' => route('admin.settings.website.faq.index')
        ]);
    }

    public function edit(Category $faq)
    {
        return view('admin.settings.website.faq.edit', compact('faq'));
    }

    public function update(Request $request, Category $faq)
    {
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        $faq->update([
            'value' => $validated
        ]);

        Cache::forget('website.home.'.current_locale());

        return response()->json([
            'message' => __('FAQ Updated Successfully'),
            'redirect' => route('admin.settings.website.faq.index')
        ]);
    }

    public function destroy(Category $faq)
    {
        $faq->delete();

        Cache::forget('website.home.'.current_locale());

        return response()->json([
            'message' => __('FAQ Deleted Successfully'),
            'redirect' => route('admin.settings.website.faq.index')
        ]);

    }
}
