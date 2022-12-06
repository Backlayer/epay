<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->only('update');
    }

    public function index()
    {
        $about = get_option('about_us', true);
        $about = optional($about);
        return view('admin.settings.website.about', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'exists:media,url']
        ]);

        Option::updateOrCreate([
            'key' => 'about_us',
            'lang' => $request->input('lang') ?? 'en'
        ], [
            'value' => $validated
        ]);

        \Cache::forget('about_us');

        return response()->json([
            'message' => __('About Page Updated Successfully')
        ]);
    }
}
