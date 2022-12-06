<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Cache;
use Illuminate\Http\Request;

class HeadingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->except('index');
    }

    public function index()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $headingData = Option::whereIn('key', [
            'heading.welcome',
            'heading.feature',
            'heading.about',
            'heading.payment',
            'heading.integration',
            'heading.capture',
            'heading.security',
            'heading.review',
            'heading.faq',
            'heading.latest-news',
            'heading.contact',
        ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key][$heading->lang] = $heading->value;
        }

        return view('admin.settings.website.heading.index', compact('languages', 'headings'));
    }

    public function updateWelcome(Request $request)
    {
        $validated = $request->validate([
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'button1_text' => ['required', 'string'],
            'button1_url' => ['required', 'string'],
            'button2_text' => ['required', 'string'],
            'button2_url' => ['required', 'string'],
            'image' => ['required', 'string'],
            'lang' => ['required', 'string']
        ]);

        Option::updateOrCreate([
            'key' => 'heading.welcome',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Welcome Section Updated'));
    }

    public function updateFeature(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'feature_1_icon' => ['required', 'string'],
            'feature_1_text' => ['required', 'string'],
            'feature_1_description' => ['required', 'string'],
            'feature_2_icon' => ['required', 'string'],
            'feature_2_text' => ['required', 'string'],
            'feature_2_description' => ['required', 'string'],
            'feature_3_icon' => ['required', 'string'],
            'feature_3_text' => ['required', 'string'],
            'feature_3_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.feature',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);
        \Artisan::call('cache:clear');

        return response()->json(__('Feature Section Updated'));
    }

    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'button_text' => ['required', 'string'],
            'button_url' => ['required', 'url'],
            'image' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.about',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('About Section Updated'));
    }

    public function updatePayment(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'payment_1_icon' => ['required', 'string'],
            'payment_1_text' => ['required', 'string'],
            'payment_1_description' => ['required', 'string'],
            'payment_2_icon' => ['required', 'string'],
            'payment_2_text' => ['required', 'string'],
            'payment_2_description' => ['required', 'string'],
            'payment_3_icon' => ['required', 'string'],
            'payment_3_text' => ['required', 'string'],
            'payment_3_description' => ['required', 'string'],
            'payment_4_icon' => ['required', 'string'],
            'payment_4_text' => ['required', 'string'],
            'payment_4_description' => ['required', 'string'],
            'payment_5_icon' => ['required', 'string'],
            'payment_5_text' => ['required', 'string'],
            'payment_5_description' => ['required', 'string'],
            'payment_6_icon' => ['required', 'string'],
            'payment_6_text' => ['required', 'string'],
            'payment_6_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.payment',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Payment Section Updated'));
    }

    public function updateIntegration(Request $request)
    {
        $validated = $request->validate([
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'button_text' => ['required', 'string'],
            'button_url' => ['required', 'url'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.integration',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('website.heading.'.$request->input('lang'));
        \Artisan::call('cache:clear');

        return response()->json(__('Integration Section Updated'));
    }

    public function updateCapture(Request $request)
    {
        $validated = $request->validate([
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'image' => ['required', 'string', 'exists:media,url'],
            'capture_1_title' => ['required', 'string'],
            'capture_1_description' => ['required', 'string'],
            'capture_2_title' => ['required', 'string'],
            'capture_2_description' => ['required', 'string'],
            'capture_3_title' => ['required', 'string'],
            'capture_3_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.capture',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('website.heading.'.$request->input('lang'));
        \Artisan::call('cache:clear');

        return response()->json(__('Capture Section Updated'));
    }

    public function updateSecurity(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'security_1_icon' => ['required', 'string'],
            'security_1_title' => ['required', 'string'],
            'security_1_description' => ['required', 'string'],
            'security_2_icon' => ['required', 'string'],
            'security_2_title' => ['required', 'string'],
            'security_2_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.security',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('website.heading.'.$request->input('lang'));
        \Artisan::call('cache:clear');

        return response()->json(__('Security Section Updated'));
    }

    public function updateReview(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.review',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('website.heading.'.$request->input('lang'));
        \Artisan::call('cache:clear');

        return response()->json(__('Review Section Updated'));
    }

    public function updateFaq(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.faq',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('website.heading.'.$request->input('lang'));
        \Artisan::call('cache:clear');

        return response()->json(__('Faq Section Updated'));
    }

    public function updateLatestNews(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.latest-news',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('website.heading.'.$request->input('lang'));
        Cache::forget('heading.latest-news');
        \Artisan::call('cache:clear');

        return response()->json(__('Latest News Section Updated'));

    }

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'location' => ['required', 'string'],
            'map_url' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.contact',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        Cache::forget('heading.contact');
        \Artisan::call('cache:clear');

        return response()->json(__('Contact Section Updated'));
    }
}
