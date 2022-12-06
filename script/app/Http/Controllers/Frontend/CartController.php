<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Storefront;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class CartController extends Controller
{
    public function index()
    {

        $store = Storefront::with('user')->findOrFail(request('store'));
        \Config::set('app.name',$store->name);


        $logo = asset($store->image);

        JsonLdMulti::setTitle('Cart - '.$store->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($store->description ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle('Cart - '.$store->name ?? env('APP_NAME'));
        SEOMeta::setDescription($store->description ?? null);
        
        SEOTools::setTitle('Cart - '.$store->name ?? env('APP_NAME'));
        SEOTools::setDescription($store->description ?? null);
  
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle('Cart - '.$store->name ?? env('APP_NAME'));
        SEOTools::jsonLd()->addImage(asset($logo));

        return view('frontend.cart.index', compact('store'));
    }

    public function create(Request $request)
    {
        if ($request->update) {
            return $this->update($request);
        }
        return false;
    }

    public function store(Request $request)
    {
        $store_id=$request->store;
        $product = Product::with('user')->whereHas('stores',function($q) use ($store_id){
          return  $q->where('storefront_id',$store_id);
        })->findOrFail($request->id);
        if ($product->quantity < $request->quantity) {
            return response()->json([
                    'message' => __('Quantity not available. Available quantity is '.$product->quantity)
                ], 404);
        }
        $data['qty']    = $request->quantity;
        $data['weight'] = 1;
        $data['id']     = $product->id;
        $data['name']   = $product->name;
        $data['price']  = $product->price;
        $data['options']['image'] = $product->image;
        $data['options']['user'] = $product->user;
        $data['tax']   = 0;

        Cart::instance('shopping_'.$request->store)->add($data);

        return response()->json(
            [
                'success' => true,
                'carts' => view('layouts.frontend.productPartials.cart-items')->render(),
                'items' => Cart::instance('shopping_'.$request->store)->count(),
                'message' => __('Product added to the cart')
            ]
        );
    }

    public function update(Request $request)
    {
        $store = Storefront::find($request->store);
        if (!$store) {
            return response()->json([
                'message' => 'Not found.'
            ], 404);
        }

        foreach ($request->rowid as $key => $rowid) {
            Cart::instance('shopping_'.$request->store)->update($rowid, ['qty' => $request->qty[$key]]);
        }

        return response()->json([
            'success' => true,
            'data' => view('frontend.cart.cart-items', compact('store'))->render(),
            'message' => __('Cart product updated successfully.')
        ]);
    }

    public function destroy(Request $request)
    {
        $store = Storefront::with('user')->findOrFail($request->store);
        Cart::instance('shopping_'.$request->store)->remove($request->rowId);
        return response()->json([
            'carts' => view('layouts.frontend.productPartials.cart-items')->render(),
            'data' => view('frontend.cart.cart-items', compact('store'))->render(),
            'items' => Cart::instance('shopping_'.$request->store)->count(),
            'message' => __('Product has been removed from cart.')
        ]);
    }
}
