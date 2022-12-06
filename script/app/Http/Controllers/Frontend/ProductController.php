<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Storefront;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductController extends Controller
{
    public function index()
    {
        return view('frontend.products.index');
    }

    public function show($store, Product $product)
    {
        $store = Storefront::with('user')->findOrFail($store);
        $product->load('user.currency');
        $products = Product::with('category')->whereHas('stores',function ($q) use ($store){
              return   $q->where('storefront_id',$store->id);
        })->where('category_id', $product->category_id)->where('id','!=',$product->id)->inRandomOrder()->limit(4)->get();

        $logo = asset($product->image);

        JsonLdMulti::setTitle($product->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($product->description ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($product->name ?? env('APP_NAME'));
        SEOMeta::setDescription($product->description?? null);
        
        SEOTools::setTitle($product->name ?? env('APP_NAME'));
        SEOTools::setDescription($product->description ?? null);
  
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($product->name?? env('APP_NAME'));
        SEOTools::jsonLd()->addImage(asset($logo));

        return view('frontend.products.show', compact('product', 'products', 'store'));
    }

    public function storeProducts($store_id)
    {
        $store = Storefront::with('user')->where('status',1)->findOrFail($store_id);

       
        $logo = asset($store->image);

        JsonLdMulti::setTitle($store->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($store->description ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($store->name ?? env('APP_NAME'));
        SEOMeta::setDescription($store->description ?? null);
        
        SEOTools::setTitle($store->name ?? env('APP_NAME'));
        SEOTools::setDescription($store->description ?? null);
  
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($store->name ?? env('APP_NAME'));
        SEOTools::jsonLd()->addImage(asset($logo));

        $products = $store->products()->with('category')->paginate();
        return view('frontend.products.store-base', compact('products', 'store'));
    }
}
