<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\Term;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {
        //Set SEO
        $seo = get_option('seo_home', true);
        $logo = get_option('logo_setting')->logo ?? asset('uploads/logo.png');

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($logo));

        //Get data
        $data = cache_remember('website.heading.'.current_locale(), function (){
            $headingData = Option::whereLang(current_locale())
                ->whereIn('key', [
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
                ])->get();

            $headings = [];
            foreach ($headingData as $heading) {
                $headings[$heading->key] = $heading->value;
            }

            $blog = Term::with('excerpt', 'preview')->whereType('blog')->latest()->limit(3)->get();
            $faqs = Category::where('key', '=', 'faq')->latest()->limit(5)->get();
            $reviews = Category::where('key', '=', 'reviews')->latest()->get();
            $our_services = [] ?? Category::where('key', '=', 'our_services')->whereLang(current_locale())->get();
            $plans = [];

            return [
                'headings' => $headings,
                'blog' => $blog,
                'faqs' => $faqs,
                'reviews' => $reviews,
                'plans' => $plans,
                'our_services' => $our_services,
            ];
        });

        return view('frontend.index', [
            'data' => $data
        ]);
    }
}
