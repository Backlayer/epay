<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->except('index');
    }

    public function index()
    {
        $term = get_option('term_of_service');

        return view('admin.settings.website.term', compact('term'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string']
        ]);

        Option::updateOrCreate([
            'lang' => 'en',
            'key' => 'term_of_service'
        ], [
            'value' => [
                'content' => $request->input('content')
            ]
        ]);

        return response()->json(__('Terms of Service Page Edited'));
    }
}
