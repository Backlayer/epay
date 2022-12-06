<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use Auth;
use Cache;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:seo-create')->only('create', 'store');
        $this->middleware('permission:seo-read')->only('index', 'show');
        $this->middleware('permission:seo-update')->only('edit', 'update');
        $this->middleware('permission:seo-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $data = Option::where('key', 'LIKE', '%seo_%')->get();
        return view('admin.seo.index', compact('data'));
    }

    public function edit($id)
    {
        $data = Option::where('id', $id)->first();
        return view('admin.seo.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $option = Option::where('id', $id)->first();

        $data = [
            "site_name" => $request->site_name,
            "matatag" => $request->matatag,
            "twitter_site_title" => $request->twitter_site_title,
            "matadescription" => $request->matadescription,
        ];

        $value = $data;
        $option->value = $value;
        $option->save();

        Cache::forget($option->key);
        Cache::forget('website.home.'.current_locale());
        Cache::forget('website.blogs.'.current_locale());

        return response()->json([
            'message' => __('SEO Successfully Updated'),
            'redirect' => route('admin.seo.index')
        ]);
    }
}
