<?php

namespace App\Http\Controllers\Frontend;

use Throwable;
use App\Models\User;
use App\Models\Order;
use App\Models\Gateway;
use App\Models\Shipping;
use App\Models\Orderitems;
use App\Models\Storefront;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendInvoiceMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Hash;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class CheckoutController extends Controller
{
    public function index()
    {
        $store = Storefront::with('user')->findOrFail(request('store'));
        $logo = asset($store->image);

        JsonLdMulti::setTitle('Checkout - '.$store->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($store->description ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle('Checkout - '.$store->name ?? env('APP_NAME'));
        SEOMeta::setDescription($store->description ?? null);
        
        SEOTools::setTitle('Checkout - '.$store->name ?? env('APP_NAME'));
        SEOTools::setDescription($store->description ?? null);
  
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle('Checkout - '.$store->name ?? env('APP_NAME'));
        SEOTools::jsonLd()->addImage(asset($logo));

        $shippings = Shipping::where('user_id', $store->user_id)->get();
        return view('frontend.checkout.index', compact('store', 'shippings'));
    }

    public function create()
    {
        $store = Session::get('store');
        if (!$store) {
            return redirect('/');
        }
        $gateways = Gateway::with('currency')->whereStatus(1)->whereIsAuto(1)->get();
        return view('payment.create', compact('gateways'));
    }

    public function store(Request $request)
    {
        $store = Storefront::findOrFail($request->store);
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'note' => 'nullable|string|max:1000',
        ]);

        if ($store->product_type == 0) {
            $request->validate([
                'street_address' => 'required|string|max:100',
                'apartment' => 'nullable|string|max:100',
                'city' => 'required|string|max:100',
                'country' => 'required|string|max:100',
            ]);
        }

        if ($store->shipping_status && $store->product_type == 0) {
            $request->validate([
                'shipping_id' => 'required|integer',
            ]);
        }

        if ($request->create_account) {
            $request->validate([
                'password' => 'required|string|max:20',
            ]);

            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        if ($request->wallet) {
            return $this->placeOrder($request->all(), $store, $request->shipping_id ?? 0);
        } else {
            Session::put('store', $store->load('user.currency'));
            Session::put('order_infos', $request->all());
            Session::put('without_auth', true);
            Session::put('without_tax', true);
            if ($request->shipping_id) {
                $shipping = Shipping::findOrFail($request->shipping_id);
                Session::put('shipping', [
                    'id' => $shipping->id,
                    'amount' => $shipping->amount,
                ]);
            }

            return response()->json([
                'message' => __("Great, Please follow the next step."),
                'redirect' => route('frontend.checkout.create'),
            ]);
        }
    }

    public function placeOrder($request, $store, $shipping)
    {
        DB::beginTransaction();
        try {

            if ($shipping) {
                $shipping = Shipping::where('user_id')->findOrFail($shipping);
            }
            $user = User::with('currency')->findOrFail(auth()->id());
            $seller = User::with('currency')->findOrFail($store->user_id);
            $amount = Cart::instance('shopping_'.request('store'))->subtotal();
            $products = Cart::instance('shopping_'.request('store'))->content();
            $user_amount = number_format((convert_money($amount, $seller->currency) * $user->currency->rate), 2);
            $user_amount = $user_amount + ($shipping->amount ?? 0);

            if ($user_amount > auth()->user()->wallet) {
                return response()->json([
                    'message' => __('Insufficient balance. Please deposite now.')
                ], 404);
            }

            $order = Order::create([
                "seller_id" => $store->user_id,
                "name" => $request['name'],
                "email" => $request['email'],
                "phone" => $request['phone'],
                'amount' => $amount,
                'storefront_id' => $store->id,
                'shipping_id' => $shipping->id ?? null,
                "trx" => 'trx_'.Str::random(10).rand(1,100),
                'currency_id' => $seller->currency->id ?? '',
            ]);

            foreach ($products as $cart) {
                Orderitems::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'quantity' => $cart->qty,
                ]);

                Cart::instance('shopping_'.$store->id)->remove($cart->rowId);
                $product = Product::findOrFail($cart->id);
                $product->quantity = $product->quantity - $cart->qty;
                $product->save();
            }

            $user->wallet = $user->wallet - $user_amount;
            $user->save();

            Transaction::create([
                'user_id' => $user->id,
                'reason' => 'Purchased',
                'amount' => '-'.$user_amount,
                'currency_id' => $user->currency_id,
                'type' => 'debit',
                'name' => $user->name,
                'email' => $user->email,
                'rate' => $user->currency->rate ?? 0,
            ]);

            $seller->wallet = $seller->wallet + $amount + ($shipping->amount ?? 0);
            $seller->save();

            Transaction::create([
                'reason' => 'Sells',
                'user_id' => $seller->id,
                'amount' => $amount,
                'currency_id' => $seller->currency_id,
                'type' => 'credit',
                'name' => $seller->name,
                'email' => $seller->email,
                'rate' => $seller->currency->rate ?? 0,
            ]);

            // Email
            $options = [
                'store' => $store,
                'invoice_total' => $amount,
                'user_name' => $user->name,
                'seller_name' => $seller->name,
                'order' => $order->load('orderitems'),
                'address' => $seller->meta['address'] ?? '',
            ];

            $seller_template = 'mail.send-seller-invoice';
            $user_template = 'mail.send-user-invoice';
            if (config('system.queue.mail')){
                \Mail::to($user->email)->queue(new SendInvoiceMail($options, $user_template));
                \Mail::to($seller->email)->queue(new SendInvoiceMail($options, $seller_template));
            } else {
                \Mail::to($user->email)->send(new SendInvoiceMail($options, $user_template));
                \Mail::to($seller->email)->send(new SendInvoiceMail($options, $seller_template));
            }

            DB::commit();

            return response()->json([
                'message' => __("Order placed successfully."),
                'redirect' => route('frontend.order.placed', [$order->id, 'store' => $store->id])
            ]);

        } catch (Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => __('Something went wrong.')
            ], 404);
        }
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        if ($gateway->is_auto == 0){
            return redirect()->back()->with('error', __('This gateway is not supported'));
        }

        $store = Session::get('store');
        $order_infos = Session::get('order_infos');
        $shipping = Session::get('shipping')['amount'] ?? 0;
        $seller_price = Cart::instance('shopping_'.$store->id)->subtotal() + ($shipping ?? 0);
        $price = convert_money($seller_price, $store->user->currency) * $gateway->currency->rate;

        Session::put('payment_type', 'payment');
        Session::put('fund_callback.success_url', '/checkout/payment/success');
        Session::put('fund_callback.cancel_url', '/checkout/payment/failed');

        // Checkout process
        $payment_data['currency'] = $gateway->currency->code ?? 'USD';
        $payment_data['email'] = $order_infos['email'];
        $payment_data['name'] = $order_infos['name'];
        $payment_data['phone'] = $order_infos['phone'];
        $payment_data['billName'] = $order_infos['name'];
        $payment_data['amount'] = $price;
        $payment_data['test_mode'] = $gateway->test_mode;
        $payment_data['charge'] = $gateway->charge ?? 0;
        $payment_data['pay_amount'] = $price + $gateway->charge ?? 0;
        $payment_data['gateway_id'] = $gateway->id;
        $payment_data['payment_type'] = 'payment';
        $payment_data['request_from'] = 'merchant';

        $gateway_info = json_decode($gateway->data, true);
        if (!empty($gateway_info)) {
            foreach ($gateway_info as $key => $info) {
                $payment_data[$key] = $info;
            }
        }

        $redirect = $gateway->namespace::make_payment($payment_data);

        return $request->expectsJson() ? response()->json([
            'message' => __('Great! You are redirect to next step.'),
            'redirect' => $redirect
        ]) : $redirect;
    }

    public function success()
    {
        abort_if(!Session::has('payment_info') && !Session::has('payment_type'), 404);
        $store = Session::get('store');
        DB::beginTransaction();
        try {

            $shipping = Session::get('shipping');
            $order_infos = Session::get('order_infos');
            $price = Cart::instance('shopping_'.$store->id)->subtotal() + ($shipping['amount'] ?? 0);

            $gateway_id = Session::get('payment_info')['gateway_id'];
            $trx = Session::get('payment_info')['payment_id'];
            $payment_status = Session::get('payment_info')['payment_status'] ?? 0;

            $seller = User::with('currency')->findOrFail($store->user_id);
            $products = Cart::instance('shopping_'.$store->id)->content();

            if ($payment_status) {
                $order = Order::create([
                    "trx" => $trx,
                    'amount' => $price,
                    "gateway_id" => $gateway_id,
                    'storefront_id' => $store->id,
                    "seller_id" => $store->user_id,
                    "name" => $order_infos['name'],
                    "email" => $order_infos['email'],
                    "phone" => $order_infos['phone'],
                    'shipping_id' => $shipping['id'] ?? null,
                    'currency_id' => $seller->currency_id,
                ]);

                foreach ($products as $cart) {
                    Orderitems::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->id,
                        'quantity' => $cart->qty,
                    ]);

                    Cart::instance('shopping_'.$store->id)->remove($cart->rowId);
                    $product = Product::findOrFail($cart->id);
                    $product->quantity = $product->quantity - $cart->qty;
                    $product->save();
                }

                $seller->wallet = $seller->wallet + $price;
                $seller->save();

                Transaction::create([
                    'reason' => 'Sells',
                    'user_id' => $seller->id,
                    'amount' => $price,
                    'currency_id' => $seller->currency_id,
                    'type' => 'credit',
                    'name' => $seller->name,
                    'email' => $seller->email,
                    'rate' => $seller->currency->rate ?? 0,
                ]);

                // Email
                $options = [
                    'store' => $store,
                    'invoice_total' => $order->amount,
                    'user_name' => $order_infos['name'],
                    'seller_name' => $seller->name,
                    'address' => $seller->meta['address'] ?? '',
                    'order' => $order->load('orderitems'),
                ];

                // Email
                $seller_template = 'mail.send-seller-invoice';
                $user_template = 'mail.send-user-invoice';
                if (config('system.queue.mail')){
                    \Mail::to($order_infos['email'])->queue(new SendInvoiceMail($options, $user_template));
                    \Mail::to($seller->email)->queue(new SendInvoiceMail($options, $seller_template));
                } else {
                    \Mail::to($order_infos['email'])->send(new SendInvoiceMail($options, $user_template));
                    \Mail::to($seller->email)->send(new SendInvoiceMail($options, $seller_template));
                }

                DB::commit();
            }

            Session::forget('store');
            Session::forget('order_infos');
            Session::forget('without_tax');
            Session::forget('payment_info');
            Session::forget('fund_callback');
            Session::forget('without_auth');
            Session::forget('shipping');
            Session::forget('payment_type');

            return redirect(route('frontend.order.placed', [$order->id, 'store' => $store->id]))->with('success', __("Order placed successfully."));

        } catch (Throwable $th) {
            DB::rollback();
            Session::forget('store');
            Session::forget('without_tax');
            Session::forget('fund_callback');
            Session::forget('order_infos');
            Session::forget('payment_info');
            Session::forget('payment_type');
            Session::forget('without_auth');
            Session::forget('shipping');
            Session::flash('error', $th->getMessage());
            return redirect(route('frontend.store-products', $store->id))->with('error', __('Something went wrong.'));
        }
    }

    public function failed()
    {
        return $store = Session::get('store');
        Session::forget('store');
        Session::forget('order_infos');
        Session::forget('payment_info');
        Session::forget('fund_callback');
        return redirect($store ? route('frontend.store-products', $store->id) : url('/'));
    }

    function orderSuccess($id)
    {
        $order = Order::with(['orderitems.product', 'storefront'])->findOrFail($id);
        return view('payment.success', compact('order'));
    }
}
