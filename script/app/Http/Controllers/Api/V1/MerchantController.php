<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use App\Models\WebOrder;
use App\Models\Website;
use App\Models\WebTestOrder;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => ['required', 'max:32','exists:websites,token'],
            'public_key' => ['required', 'string', 'max:39', 'min:39', 'exists:users,public_key'],
            'reference_code' => ['required', 'string', 'max:20', 'unique:web_orders,reference_code'],
            'callback_url' => ['required', 'url'],
            'amount' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'quantity' => ['required', 'integer'],
            'currency' => ['required', 'exists:currencies,code']
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 403);
        }

        $owner = User::wherePublicKey($request->input('public_key'))->firstOrFail();
        $website = Website::whereToken($request->input('token'))->firstOrFail();
        $currency = Currency::whereCode($request->input('currency'))->firstOrFail();

        if (!$website->mode){
            $order = WebTestOrder::create([
                "user_id" => $owner->id,
                "website_id" => $website->id,
                "currency_id" => $currency->id,
                "reference_code" => $request->input('reference_code'),
                "amount" => $request->input('amount'),
                "quantity" => $request->input('quantity'),
                "meta" => [
                    'title' => $request->input('title'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'description' => $request->input('description'),
                    'callback_url' => $request->input('callback_url'),
                    'ip_address' => $request->ip(),
                    'user-agent' => $request->userAgent()
                ],
            ]);
        }else{
            $order = WebOrder::create([
                "user_id" => $owner->id,
                "website_id" => $website->id,
                "currency_id" => $currency->id,
                "reference_code" => $request->input('reference_code'),
                "amount" => $request->input('amount'),
                "quantity" => $request->input('quantity'),
                "meta" => [
                    'title' => $request->input('title'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'description' => $request->input('description'),
                    'callback_url' => $request->input('callback_url'),
                    'ip_address' => $request->ip(),
                    'user-agent' => $request->userAgent()
                ],
            ]);
        }

        return $request->expectsJson() ?
            response()->json([
                'message' => __('Order Created Successfully'),
                'status' => "success",
                'redirect' => route('frontend.merchant.index', [$website->id, $order->uuid]),
                'data' => $order
            ])
            : to_route('frontend.merchant.index', [$website->id, $order->uuid]);
    }

    public function storeSecondMethod(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => ['required', 'max:32','exists:websites,token'],
            'public_key' => ['required', 'string', 'max:39', 'min:39', 'exists:users,public_key'],
            'reference_code' => ['required', 'string', 'max:20', 'unique:web_orders,reference_code'],
            'callback_url' => ['required', 'url'],
            'amount' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'quantity' => ['required', 'integer'],
            'currency' => ['required', 'exists:currencies,code']
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 403);
        }

        $owner = User::wherePublicKey($request->input('public_key'))->firstOrFail();
        $website = Website::whereToken($request->input('token'))->firstOrFail();
        $currency = Currency::whereCode($request->input('currency'))->firstOrFail();

        if (!$website->mode){
            $order = WebTestOrder::create([
                "user_id" => $owner->id,
                "website_id" => $website->id,
                "currency_id" => $currency->id,
                "reference_code" => $request->input('reference_code'),
                "amount" => $request->input('amount'),
                "quantity" => $request->input('quantity'),
                "meta" => [
                    'title' => $request->input('title'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'description' => $request->input('description'),
                    'callback_url' => $request->input('callback_url'),
                    'ip_address' => $request->ip(),
                    'user-agent' => $request->userAgent()
                ],
            ]);
        }else{
            $order = WebOrder::create([
                "user_id" => $owner->id,
                "website_id" => $website->id,
                "currency_id" => $currency->id,
                "reference_code" => $request->input('reference_code'),
                "amount" => $request->input('amount'),
                "quantity" => $request->input('quantity'),
                "meta" => [
                    'title' => $request->input('title'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'description' => $request->input('description'),
                    'callback_url' => $request->input('callback_url'),
                    'ip_address' => $request->ip(),
                    'user-agent' => $request->userAgent()
                ],
            ]);
        }

        return response()->json([
            'message' => __('Order Created Successfully'),
            'status' => "success",
            'redirect' => route('frontend.merchant.index', [$website->id, $order->uuid]),
            'data' => $order
        ]);
    }

    public function verifyPayment(Request $request, $referenceCode, $secretKey)
    {
        $user = User::whereSecretKey($secretKey)->first();
        $order = WebOrder::whereReferenceCode($referenceCode)->first();

        if (!$order ||!$user || $user->id !== $order->website->user_id){
            return response()->json([
                'message' => 'Transaction not found',
                'status' => 'error'
            ], 404);
        }else{
            return response()->json([
                'message' => __('The payment status is :status', ['status' => $order->paid_at ? __('paid') : __('unpaid')]),
                'status' => 'success',
                'data' => $order
            ]);
        }
    }
}
