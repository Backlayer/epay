<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;

class ManageDataController extends Controller
{
    public function index(Request $request)
    {
        $languages = Option::where('key', '=', 'languages')->firstOrFail();

        $categoriesCollection = Category::whereStatus(1)
            ->whereIn('key', [
                'subscription_titles'
            ])
            ->get();

        $categories = [];
        foreach ($categoriesCollection as $index => $item) {
            $categories[$item->lang][$item->key] = $item->value;
        }

        return view('admin.managedata.index', compact('languages', 'categories'));
    }

    public function updateSubscriptionTitles(Request $request)
    {
        $lang = $request->input('lang');
        $request->validate([
            'titles_'.$lang => ['required', 'array'],
            'titles_'.$lang.'.*.title' => ['required', 'string'],
        ], [
            'titles_'.$lang.'.*.required' => __("validation.required", ['attribute' => __('Title')]),
            'titles_'.$lang.'.*.title.required' => __("validation.required", ['attribute' => __('Title')])
        ]);

        Category::updateOrCreate([
            'key' => 'subscription_titles',
            'lang' => $request->input('lang'),
        ], [
            'value' => $request->input('titles_'.$lang)
        ]);

        return response()->json(__('Subscription Titles Updated Successfully'));
    }
}
