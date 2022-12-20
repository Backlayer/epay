<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\PhysicalProductController;
use App\Models\KycRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//Without verified
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'App\Http\Controllers\User', 'middleware' => ['auth', 'user']], function () {
    Route::get('set-bank', 'ConfigureBankAccountController@index')->withoutMiddleware('hasBank')->name('set-bank.index');
    Route::post('set-bank/store', 'ConfigureBankAccountController@store')->withoutMiddleware('hasBank')->name('set-bank.store');
});

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'App\Http\Controllers\User',
    'middleware' => ['auth', 'verified', 'user', 'hasBank', 'kyc']
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    // Money request
    Route::get('request-money/cancel/{id}', 'RequestMoneyController@cancle')->name('request-money.cancel');
    Route::get('request-money/approved/{id}', 'RequestMoneyController@approved')->name('request-money.approved');
    Route::get('received-request/', 'RequestMoneyController@receivedRequest')->name('received-request.index');

    Route::post('single-charges/disable/{charge}', 'SingleChargeController@disable')->name('single-charges.disable');
    Route::post('donations/disable/{charge}', 'DonationController@disable')->name('donations.disable');
    Route::post('plans/disable/{plan}', 'PlanController@disable')->name('plans.disable');
    Route::post('invoices/{invoice}/send', 'InvoiceController@send')->name('invoices.send');
    Route::post('websites/{website}/live', 'WebsiteController@live')->name('websites.live');
    Route::get('websites/documentation', 'WebsiteController@documentation')->name('websites.documentation');

    // Deposit System
    Route::resource('deposits', 'DepositController');
    Route::post('/deposit/make-payment/{gateway}', 'DepositController@makePayment')->name('deposit.make-payment');
    Route::get('/deposit/payment/success', 'DepositController@success')->name('deposit.payment.success');
    Route::get('deposit/payment/failed', 'DepositController@failed')->name('deposit.payment.failed');

    Route::get('get-orders', 'OrderController@getOrders')->name('get-orders');
    Route::get('get-payouts', 'PayoutController@getPayouts')->name('get-payouts');
    Route::get('get-stores', 'StoreFrontController@getStores')->name('get-stores');
    Route::get('get-invoices', 'InvoiceController@getInvoices')->name('get-invoices');
    Route::get('get-deposits', 'DepositController@getDeposits')->name('get-deposits');
    Route::get('get-donations', 'DonationController@getDonations')->name('get-donations');
    Route::get('get-payments', 'QrPaymentController@getQrPayments')->name('get-payments');
    Route::get('get-transfers', 'TransferController@getTransfers')->name('get-transfers');
    Route::get('get-transaction', 'TransactionsController@getTransaction')->name('get-transaction');
    Route::get('get-single-charge', 'SingleChargeController@getSingleCharge')->name('single-charge');
    Route::get('get-physical-products', 'ProductController@getProducts')->name('get-physical-products');
    Route::get('get-request-money', 'RequestMoneyController@getRequestMoney')->name('get-request-money');
    Route::get('get-digital-products', 'DigitalProductController@getProducts')->name('get-digital-products');
    Route::get('get-physical-products', 'PhysicalProductController@getProducts')->name('get-physical-products');

    // Charts
    Route::get('dashboard/chart/', 'DashboardController@transactions')->name('dashboard.chart');
    Route::get('dashboard/order/', 'DashboardController@orderChart')->name('order.chart');
    Route::get('dashboard/single-charge/', 'DashboardController@singleCharge')->name('single-charge.chart');
    Route::get('dashboard/donations/', 'DashboardController@donations')->name('donations.chart');
    Route::get('dashboard/plans/', 'DashboardController@plans')->name('plans.chart');
    Route::get('dashboard/qr-payments/', 'DashboardController@qrPayments')->name('qr-payments.chart');

    //Kyc
    Route::get('kyc-verifications/{kycRequest}/resubmit', 'KycVerificationController@resubmit')
        ->name('kyc-verifications.resubmit')
        ->withoutMiddleware('kyc');
    Route::put('kyc-verifications/{kycRequest}/resubmit', 'KycVerificationController@resubmitUpdate')
        ->name('kyc-verifications.resubmit.update')
        ->withoutMiddleware('kyc');

    Route::get('websites/test/{website}', 'WebsiteController@testTransactions')->name('websites.test-transactions');

    Route::get('transactions/{type?}', 'TransactionsController@index')->name('transactions.index');
    Route::get('subscription/{subscription}', 'SubscriptionController@show')->name('subscription.show');
    Route::post('subscription/{subscription}/auto-renew', 'SubscriptionController@autoRenew')->name('subscription.auto-renew');
    Route::resource('kyc-verifications', 'KycVerificationController')->withoutMiddleware('kyc');
    Route::resource('plans', 'PlanController');
    Route::resource('charges', 'ChargeController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('supports', 'SupportController');
    Route::resource('transfers', 'TransferController');
    Route::resource('donations', 'DonationController');
    Route::resource('subscribers', 'SubscriberController');
    Route::resource('storefronts', 'StoreFrontController');
    Route::resource('single-charges', 'SingleChargeController');
    Route::resource('websites', 'WebsiteController');
    Route::resource('orders', 'OrderController')->only('index', 'show');
    Route::resource('qr-payments', 'QrPaymentController')->only('index');
    Route::resource('orders', 'OrderController')->only('index', 'show', 'update');
    Route::resource('profiles', 'ProfileController')->only('index', 'update');
    Route::resource('api-keys', 'ApiController')->only('index', 'store');
    Route::resource('payouts', 'PayoutController')->except('destroy', 'edit');
    Route::resource('shipping-rate', 'ShippingRateController')->except('show');
    Route::resource('digital-products', 'DigitalProductController')->except('show');
    Route::resource('physical-products', 'PhysicalProductController')->except('show');
    Route::resource('categories', 'CategoryController')->except('create', 'show', 'edit');
    Route::resource('request-money', 'RequestMoneyController')->only('index', 'store', 'update');

    Route::get('store-products/{store}', [PhysicalProductController::class, 'storeProducts'])->name('store-products');
    // Payment
    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
        Route::get('success', [PaymentController::class, 'success'])->name('success');
    });

    // INVOICES
    Route::get('invoices/{invoice}', 'InvoiceController@show')->name('invoices.show');
    Route::get('invoices/{invoice}/edit', 'InvoiceController@edit')->name('invoices.edit');
});

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth', 'verified'],
    'namespace' => 'App\Lib'
], function () {
    Route::get('/payment/paypal', 'Paypal@status');
    Route::post('/stripe/payment', 'Stripe@status')->name('stripe.payment');
    Route::get('/stripe', 'Stripe@view')->name('stripe.view');
    Route::get('/payment/mollie', 'Mollie@status');
    Route::post('/payment/paystack', 'Paystack@status')->name('paystack.status');
    Route::get('/paystack', 'Paystack@view')->name('paystack.view');
    Route::get('/mercadopago/pay', 'Mercado@status')->name('mercadopago.status');
    Route::get('/razorpay/payment', 'Razorpay@view')->name('razorpay.view');
    Route::post('/razorpay/status', 'Razorpay@status');
    Route::get('/payment/flutterwave', 'Flutterwave@status');
    Route::get('/payment/thawani', 'Thawani@status');
    Route::get('/payment/instamojo', 'Instamojo@status');
    Route::get('/payment/toyyibpay', 'Toyyibpay@status');
    Route::get('/manual/payment', 'CustomGateway@status')->name('manual.payment');
    Route::get('payu/payment', 'Payu@view')->name('payu.view');
    Route::post('/payu/status', 'Payu@status')->name('payu.status');
});
