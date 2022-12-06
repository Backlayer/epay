<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class BlogController extends Controller
{
    public function index(Request $request)
    {
        //Set SEO
        $seo = get_option('seo_blog', true);
        $logo = get_option('logo_setting')->logo ?? asset('uploads/logo.png');

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);

        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($logo));

        // Main
        $src = $request->get('q');
        $tag = $request->get('tag');

        $posts = Term::whereType('blog')
            ->whereStatus(1)
            ->with('preview', 'description', 'excerpt')
            ->when($src !== null, function (Builder $builder) use($src){
                $builder->where('title', 'LIKE', '%'.$src.'%');
            })
            ->when($src !== null, function (Builder $builder) use($tag){
                $builder->whereHas('metaTag', function (Builder $builder) use ($tag){
                    $builder->where('value', 'LIKE', '%'.$tag.'%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show(Term $post)
    {
        abort_if(!$post->status, 404);
        $logo=asset($post->preview->value ?? 'default.png');
        JsonLdMulti::setTitle($post->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage($logo);

        SEOMeta::setTitle($post->title ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        

        SEOTools::setTitle($post->title ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
        
        
        SEOTools::opengraph()->addProperty('image', $logo);
        SEOTools::twitter()->setTitle($post->title ?? env('APP_NAME'));
        
        SEOTools::jsonLd()->addImage($logo);

        $recentPosts = Term::whereType('blog')
            ->with('preview')
            ->latest()->limit(3)->get();
        return view('frontend.blog.show', compact('recentPosts', 'post'));
    }
}
