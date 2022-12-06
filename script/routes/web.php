<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group(['as' => 'frontend.', 'namespace' => 'App\Http\Controllers\Frontend'], function (){
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/about', 'AboutController@index')->name('about.index');
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/store/{store}/product/{product}/', 'ProductController@show')->name('products.show');
    Route::get('/store/{store}', 'ProductController@storeProducts')->name('store-products');

    // Product order
    Route::resource('checkout', 'CheckoutController')->only('index', 'create', 'store');
    Route::post('/checkout/make-payment/{gateway}', 'CheckoutController@makePayment')->name('checkout.make-payment');
    Route::get('/checkout/payment/success', 'CheckoutController@success')->name('checkout.payment.success');
    Route::get('/checkout/payment/failed', 'CheckoutController@failed')->name('checkout.payment.failed');
    Route::get('/order/placed/{id}', 'CheckoutController@orderSuccess')->name('order.placed');

    Route::get('/blog', 'BlogController@index')->name('blog.index');
    Route::get('/blog/{post:slug}', 'BlogController@show')->name('blog.show');
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact/send', 'ContactController@send')->name('contact.send');

    Route::resource('cart', 'CartController');

    Route::get('page/{page:slug}', 'PageController@index')->name('page.index');

    Route::get('locale/{locale}', 'LocaleController@setLanguage')->name('set-language');
    Route::post('newsletter-subscribe', '\App\Http\Controllers\CommonController@subscribeToNewsLetter')->name('subscribe-to-news-letter');


    Route::get('single-charge/{single_charge:uuid}', 'SingleChargeController@index')->name('single-charge.index');
    Route::post('single-charge/{single_charge:uuid}', 'SingleChargeController@gateway')->name('single-charge.gateway');
    Route::post('single-charge/{single_charge:uuid}/{gateway}/payment', 'SingleChargeController@payment')->name('single-charge.payment');

    // Donation Payment
    Route::get('donation/{donation:uuid}', 'DonationController@index')->name('donation.index');
    Route::post('donation/{donation:uuid}', 'DonationController@gateway')->name('donation.gateway');
    Route::post('donation/{donation:uuid}/{gateway}/payment', 'DonationController@payment')->name('donation.payment');

    // External Merchant Payment
    // Merchant Payment
    Route::get('merchant/{website}/{uuid}', 'MerchantController@index')->name('merchant.index');
    Route::post('merchant/{website}/{uuid}', 'MerchantController@gateway')->name('merchant.gateway');
    Route::post('merchant/{website}/{uuid}/{gateway}/payment', 'MerchantController@payment')->name('merchant.payment');

    // Invoice Payment
    Route::get('invoice/{invoice:uuid}', 'InvoiceController@index')->name('invoice.index');
    Route::post('invoice/{invoice:uuid}', 'InvoiceController@gateway')->name('invoice.gateway');
    Route::post('invoice/{invoice:uuid}/{gateway}/payment', 'InvoiceController@payment')->name('invoice.payment');

    // Plan Payment
    Route::get('plan/{plan:uuid}', 'PlanController@index')->name('plan.index');
    Route::post('plan/{plan:uuid}/payment', 'PlanController@payment')->name('plan.payment');

    // QR Code Payment
    Route::get('qr/{user:qr}', 'QRPaymentController@index')->name('qr.index');
    Route::post('qr/{user:qr}', 'QRPaymentController@gateway')->name('qr.gateway');
    Route::post('qr/{user:qr}/{gateway}/payment', 'QRPaymentController@payment')->name('qr.payment');

    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function (){
        Route::get('success', [PaymentController::class, 'success'])->name('success');
        Route::get('failed', [PaymentController::class, 'failed'])->name('failed');
        Route::post('test/{website}/{order:uuid}/{gateway}', [PaymentController::class, 'test'])->name('test');
    });
});

Route::group([
    'namespace' => 'App\Lib'
], function (){
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

Route::group(['prefix' => 'cron', 'as' => 'cron.'], function (){
    Route::get('run/temporary-files', [\App\Http\Controllers\CronController::class, 'deleteTemporaryFiles'])->name('run.temporary-files');

    Route::get('run/delete-unpaid-external-orders', [\App\Http\Controllers\CronController::class, 'deleteUnpaidExternalOrders'])->name('run.delete-unpaid-external-orders');

    Route::get('run/transfer-refund', [\App\Http\Controllers\CronController::class, 'moneyRefund'])->name('run.money-refund');

    Route::get('run/pre-renewal-notification', [\App\Http\Controllers\CronController::class, 'preRenewalNotification'])->name('run.pre-renewal-notification');

    Route::get('run/auto-renew', [\App\Http\Controllers\CronController::class, 'autoRenew'])->name('run.auto-renew');
});



Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function () {
    // Website
    Route::post('customers/send-email/{user}', 'CustomerController@sendEmail')->name('customers.send-email');
    Route::resource('customers', 'CustomerController')->except('create', 'store');
    Route::get('get-customers', 'CustomerController@getCustomers')->name('get-customers');
    Route::get('customer/login/{user}', 'CustomerController@Login')->name('customer.login');
    Route::resource('staff', 'StaffController');
    Route::get('promotional-email', 'PromotionalEmailController@index')->name('promotional-email.index');
    Route::post('promotion-email-send', 'PromotionalEmailController@sendEmail')->name('promotional-email.send-email');
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function (){
        Route::get('banks', 'ReportController@banks')->name('banks.index');
    });
    Route::get('transactions', 'TransactionController@index')->name('transactions.index');
    Route::get('transactions/{transaction}', 'TransactionController@show')->name('transactions.show');
    Route::get('get-transaction', 'TransactionController@getTransaction')->name('get-transaction');
    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function (){
        Route::get('single-charge', 'SingleChargeController@index')->name('single-charge.index');
        Route::get('single-charge/{singleCharge}', 'SingleChargeController@show')->name('single-charge.show');
        Route::get('donations', 'DonationController@index')->name('donations.index');
        Route::get('donations/{donation}', 'DonationController@show')->name('donations.show');
        Route::get('get-donations', 'DonationController@getDonations')->name('get-donations');
        Route::get('get-single-charge', 'SingleChargeController@getSingleCharge')->name('single-charge');
    });
    Route::get('invoices', 'InvoiceController@index')->name('invoices.index');
    Route::get('invoices/{invoice}', 'InvoiceController@show')->name('invoices.show');
    Route::get('get-invoices', 'InvoiceController@getInvoices')->name('get-invoices');
    Route::get('merchants', 'MerchantController@index')->name('merchants.index');
    Route::get('merchants/{merchant}/log', 'MerchantController@log')->name('merchants.log');
    Route::get('payment-plans', 'PaymentPlanController@index')->name('payment-plans.index');
    Route::get('payment-plans/{id}', 'PaymentPlanController@show')->name('payment-plans.show');
    Route::get('charges', 'ChargeController@index')->name('charges.index');
    Route::resource('banks', 'BankController');

    Route::post('payouts/delete-all', 'PayoutController@deleteAll')->name('payouts.delete');
    Route::get('payouts/approved', 'PayoutController@approved')->name('payouts.approved');
    Route::get('payouts/reject', 'PayoutController@reject')->name('payouts.reject');
    Route::resource('payouts', 'PayoutController')->only('index', 'show');
    Route::get('get-payouts', 'PayoutController@getPayouts')->name('get-payouts');

    // System
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard.index');
    Route::get('settings', 'AdminController@settings')->name('settings');
    Route::post('currencies/sync', 'CurrencyController@sync')->name('currencies.sync');
    Route::put('currencies/default/{currency}', 'CurrencyController@makeDefault')->name('currencies.make.default');
    Route::resource('currencies', 'CurrencyController');
    Route::resource('banks', 'BankController')->only('index', 'update', 'store', 'destroy');
//    Route::resource('taxes', 'TaxController');
    Route::post('update-general', 'AdminController@updateGeneral')->name('update-general');
    Route::post('update-password', 'AdminController@updatePassword')->name('update-password');
    Route::get('clear-cache', 'AdminController@clearCache')->name('clear-cache');

    Route::post('blog/delete-all',  'BlogController@deleteAll')->name('blog.delete-all');
    Route::resource('blog', 'BlogController');
    Route::resource('reviews', 'ReviewController');
    Route::resource('users', 'UserController');

    Route::get('pages/choose/{lang}', 'PageController@choose')->name('page.choose');
    Route::post('page/delete-all',  'PageController@deleteAll')->name('page.delete-all');
    Route::resource('page', 'PageController');
    Route::resource('payment-gateways', 'PaymentGatewayController')->except('show');
    Route::post('/orders/mass-destroy','OrderController@massDestroy')->name('orders.mass-destroy');
    Route::get('orders/invoice/{order}/print', 'OrderController@print')->name('orders.print.invoice');
    Route::get('orders/pdf', 'OrderController@orderPdf')->name('orders.pdf');
    Route::post('orders/payment-status/{id}', 'OrderController@paymentStatusUpdate')->name('orders.payment-status');
    Route::resource('orders', 'OrderController');
    Route::get('get-orders', 'OrderController@getOrders')->name('get-orders');

    Route::post('users/login/{user}', 'UserController@login')->name('users.login');
    Route::delete('subscribers/{email}/unsubscribe', 'SubscriberController@unsubscribe')->name('subscribers.unsubscribe');
    Route::resource('subscribers', 'SubscriberController')->only('index', 'destroy');
    Route::post('supports/get-ticket', 'SupportController@getSupport')->name('supports.get-ticket');
    Route::post('supports/update-status', 'SupportController@updateStatus')->name('supports.update-status');
    Route::post('supports/reply/{support}', 'SupportController@reply')->name('supports.reply');
    Route::resource('supports', 'SupportController');

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::group(['prefix' => 'website', 'as' => 'website.', 'namespace' => 'Website'], function () {
            Route::group(['prefix' => 'heading', 'as' => 'heading.'], function () {
                Route::controller('HeadingController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::put('update-welcome', 'updateWelcome')->name('update-welcome');
                    Route::put('update-feature', 'updateFeature')->name('update-feature');
                    Route::put('update-about', 'updateAbout')->name('update-about');
                    Route::put('update-payment', 'updatePayment')->name('update-payment');
                    Route::put('update-integration', 'updateIntegration')->name('update-integration');
                    Route::put('update-capture', 'updateCapture')->name('update-capture');
                    Route::put('update-security', 'updateSecurity')->name('update-security');
                    Route::put('update-review', 'updateReview')->name('update-review');
                    Route::put('update-faq', 'updateFaq')->name('update-faq');
                    Route::put('update-latest-news', 'updateLatestNews')->name('update-latest-news');
                    Route::put('update-contact', 'updateContact')->name('update-contact');
                });
            });
            Route::get('logo', 'LogoController@index')->name('logo.index');
            Route::put('logo', 'LogoController@update')->name('logo.update');
            Route::get('footer', 'FooterController@index')->name('footer.index');
            Route::post('footer/store', 'FooterController@store')->name('footer.store');

            Route::get('about','AboutController@index')->name('about.index');
            Route::put('about','AboutController@update')->name('about.update');

            Route::resource('faq', 'FAQController')->except('show');
        });
        Route::get('charges', 'IncomeChargeController@index')->name('charges.index');
        Route::put('charges/update', 'IncomeChargeController@update')->name('charges.update');
    });


    Route::post('/kyc-method/mass-destroy','KycMethodController@massDestroy')->name('kyc-method.mass-destroy');
    Route::resource('kyc-method','KycMethodController')->except('destroy');

    Route::post('kyc-requests/destroy/mass',  'KycRequestController@destroyMass')->name('kyc-requests.destroy.mass');
    Route::post('users/kyc-verified/{user}', 'KycRequestController@kycVerified')->name('kyc-requests.kyc-verified');
    Route::resource('kyc-requests', 'KycRequestController')->except('edit', 'update');

    //Support Route
    Route::post('supportInfo', 'SupportController@getSupportData')->name('support.info');
    Route::post('supportstatus', 'SupportController@supportStatus')->name('support.status');
    Route::resource('support', 'SupportController');

    Route::resource('money-requests', 'RequestMoneyController')->only('index', 'show');
    Route::resource('products', 'ProductController')->only('index');
    Route::resource('stores', 'StoreController')->except('show');
    Route::resource('deposits', 'DepositeController')->only('index', 'show', 'destroy');

    Route::get('get-deposits', 'DepositeController@getDeposits')->name('get-deposits');
    Route::get('deposit/approve/{id}', 'DepositeController@approve')->name('deposits.approve');
    Route::get('deposit/reject/{id}', 'DepositeController@reject')->name('deposits.reject');

    Route::get('get-request-money', 'RequestMoneyController@getRequestMoney')->name('get-request-money');
    Route::get('get-products', 'ProductController@getProducts')->name('get-products');
    Route::get('get-stores', 'StoreController@getStores')->name('get-stores');

    Route::resource('roles', 'RoleController')->except('show');
    Route::post('assign-role/search', 'AssignRoleController@search')->name('assign-role.search');
    Route::resource('assign-role', 'AssignRoleController')->only('index', 'store');
    Route::get('shippings', 'ShippingController@index')->name('shippings.index');
    Route::get('categories', 'ProductCategoryController@index')->name('categories.index');
    Route::get('transfers', 'TransferController@index')->name('transfers.index');
    Route::get('get-transfers', 'TransferController@getTransfers')->name('get-transfers');

    Route::resource('seo', 'SeoController')->only('index', 'edit', 'update');
    Route::resource('env', 'EnvController');
    Route::resource('media', 'MediaController');
    Route::get('medias/list', 'MediaController@list')->name('media.list');
    Route::post('medias/delete', 'MediaController@destroy')->name('medias.delete');
    Route::get('/dashboard/static', 'DashboardController@staticData');
    Route::get('/dashboard/performance/{period}', 'DashboardController@performance');
    Route::get('/dashboard/deposit/performance/{period}', 'DashboardController@depositPerformance');
    Route::get('/dashboard/order_statics/{month}', 'DashboardController@order_statics');
    Route::get('/dashboard/visitors/{days}', 'DashboardController@google_analytics');
    Route::get('languages/delete/{id}', 'LanguageController@destroy')->name('languages.delete');
    Route::post('languages/setActiveLanguage', 'LanguageController@setActiveLanguage')->name('languages.active');
    Route::post('languages/add_key', 'LanguageController@add_key')->name('language.add_key');
    Route::resource('language', 'LanguageController');
    Route::resource('menu', 'MenuController');
    Route::post('/menus/destroy', 'MenuController@destroy')->name('menus.destroy');
    Route::post('menues/node', 'MenuController@MenuNodeStore')->name('menus.MenuNodeStore');
    Route::get('/site-settings', 'SitesettingsController@index')->name('site-settings');
    Route::post('/site-settings-update/{type}', 'SitesettingsController@update')->name('site-settings.update');
    Route::resource('cron', 'CronController');

});

