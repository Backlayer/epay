<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Cache;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->except('index');
    }

    public function index()
    {
          $option = get_option('logo_setting', true);
          return view('admin.settings.website.logo', compact('option'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'string'],
            'favicon' => ['required', 'string'],
        ], [
            'logo.required' => __('Please Upload Logo Image'),
            'favicon.required' => __('Please Upload Favicon Image'),
        ]);

        $option = Option::firstOrNew([
            'key' => 'logo_setting',
            'lang' => current_locale()
        ]);
        $option->value = [
            'logo' => $request->input('logo'),
            'favicon' => $request->input('favicon'),
        ];
        $option->save();

        Cache::forget('logo_setting');
        Cache::forget('website.home.'.current_locale());

        return response()->json(__('Logo Setting Updated'));
    }
}
