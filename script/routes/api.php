<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\MerchantController;
use App\Http\Controllers\Api\V1\WebHookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['throttle:api']], function () {
    Route::post('payment/create', [
        MerchantController::class, 'storeSecondMethod'
    ])->name('merchant.store-second-method');
    Route::post('payment/merchant/create', [
        MerchantController::class, 'store'
    ])->name('merchant.store');
    Route::get('payment/merchant/verify/{referenceCode}/{secretKey}', [
        MerchantController::class, 'verifyPayment'
    ])->name('merchant.verify-payment');

    Route::post('webhook/account/create/{secretKey}', [
        WebHookController::class, 'createAccount'
    ])->name('webhook.create-account');
});
