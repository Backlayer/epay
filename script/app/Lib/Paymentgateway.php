<?php


return [
    ['name' => 'paypal', 'logo' => 'uploads/21/04/1698367938881552.png', 'namespace' => 'App\\Lib\\Paypal', 'phone_required' => '0', 'data' => '{"client_id":"","client_secret":""}', 'is_auto' => 1],

    ['name' => 'stripe', 'logo' => 'uploads/21/04/1698367948712217.png', 'namespace' => 'App\\Lib\\Stripe', 'phone_required' => '0', 'data' => '{"publishable_key":"","secret_key":""}', 'is_auto' => 1],

    ['name' => 'mollie', 'logo' => 'uploads/21/04/1698367959065956.png', 'namespace' => 'App\\Lib\\Mollie', 'phone_required' => '0', 'data' => '{"api_key":""}', 'is_auto' => 1],

    ['name' => 'paystack', 'logo' => 'uploads/21/04/1698367968509154.png', 'namespace' => 'App\\Lib\\Paystack', 'phone_required' => '0', 'data' => '{"public_key":"","secret_key":""}', 'is_auto' => 1],

    ['name' => 'razorpay', 'logo' => 'uploads/21/04/1698367977941644.png', 'namespace' => 'App\\Lib\\Razorpay', 'phone_required' => '0', 'data' => '{"key_id":"","key_secret":""}', 'is_auto' => 1],

    ['name' => 'instamojo', 'logo' => 'uploads/21/04/1698367990639996.png', 'namespace' => 'App\\Lib\\Instamojo', 'phone_required' => '1', 'data' => '{"x_api_key":"","x_auth_token":""}', 'is_auto' => 1],

    ['name' => 'toyyibpay', 'logo' => 'uploads/21/04/1698368000180467.png', 'namespace' => 'App\\Lib\\Toyyibpay', 'phone_required' => '1', 'data' => '{"user_secret_key":"","cateogry_code":""}', 'is_auto' => 1],

    ['name' => 'flutterwave', 'logo' => 'uploads/21/04/1698368012665741.png', 'namespace' => 'App\\Lib\\Flutterwave', 'phone_required' => '1', 'data' => '{"public_key":"","secret_key":"","encryption_key":"","payment_options":"card"}', 'is_auto' => 1],

    ['name' => 'payu', 'logo' => 'uploads/21/04/1698368022202232.png', 'namespace' => 'App\\Lib\\Payu', 'phone_required' => '1', 'data' => '{"merchant_key":"","merchant_salt":"","auth_header":""}', 'is_auto' => 1],

    ['name' => 'thawani', 'logo' => 'uploads/21/04/1698368032853372.png', 'namespace' => 'App\\Lib\\Thawani', 'phone_required' => '1', 'data' => '{"secret_key":"","publishable_key":""}', 'is_auto' => 1],

    ['name' => 'manual', 'logo' => 'uploads/21/04/1698368040658664.png', 'namespace' => 'App\\Lib\\CustomGateway', 'phone_required' => '0', 'data' => '', 'is_auto' => 0],

    ['name' => 'mercadopago', 'logo' => 'uploads/21/04/1698368050865604.png', 'namespace' => 'App\\Lib\\Mercado', 'currency_name' => 'USD', 'is_auto' => '1', 'image_accept' => '0', 'test_mode' => '1', 'status' => '1', 'phone_required' => '0', 'data' => '{"secret_key":"","public_key":""}', 'is_auto' => 1],

    ['name' => 'my credits', 'logo' => NULL, 'namespace' => 'App\\Lib\\Credit', 'phone_required' => '0', 'data' => '', 'is_auto' => 0]
];


