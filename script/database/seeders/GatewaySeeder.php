<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateways = [
            ['id' => '1','name' => 'paypal','logo' => '/uploads/payment-gateway/paypal.png','charge' => '2','namespace' => 'App\\Lib\\Paypal','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"client_id":"ARKsbdD1qRpl3WEV6XCLuTUsvE1_5NnQuazG2Rvw1NkMG3owPjCeAaia0SXSvoKPYNTrh55jZieVW7xv","client_secret":"EJed2cGACzB2SJFQwSannKAA1gyBjKkwlKh1o8G75zQHYzAgLQ3n7f9EfeNCZgtfPDMxyFzfp6oQWPia"}', 'currency_id' => 1, 'created_at' => now(),'updated_at' => now()],
            ['id' => '2','name' => 'stripe','logo' => '/uploads/payment-gateway/stripe.png','charge' => '2','namespace' => 'App\\Lib\\Stripe','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"publishable_key":"pk_test_51I8GqvBRq7fsgmoHB37mXDC3oNVtsJBMQRYeRLUykmuWlqihZ1kDvYeLUeno9Nkqze4axZF0nLeeqkdYJP42S06u00GEiuG8CS","secret_key":"sk_test_51I8GqvBRq7fsgmoHldttMcxnaiSwu5thxGVELXwxd9la5NNttvNBICXTY7r0TkTEDKqzdIl9KZIJu6sNMJqMM1MZ00I8obAU6P"}', 'currency_id' => 1, 'created_at' => now(),'updated_at' => now()],
            ['id' => '3','name' => 'mollie','logo' => '/uploads/payment-gateway/mollie.png','charge' => '2','namespace' => 'App\\Lib\\Mollie','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"api_key":"test_WqUGsP9qywy3eRVvWMRayxmVB5dx2r"}', 'currency_id' => 1, 'created_at' => now(),'updated_at' => now()],
            ['id' => '4','name' => 'paystack','logo' => '/uploads/payment-gateway/paystack.png','charge' => '2','namespace' => 'App\\Lib\\Paystack','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"public_key":"pk_test_84d91b79433a648f2cd0cb69287527f1cb81b53d","secret_key":"sk_test_cf3a234b923f32194fb5163c9d0ab706b864cc3e"}', 'currency_id' => 5, 'created_at' => now(),'updated_at' => now()],
            ['id' => '5','name' => 'razorpay','logo' => '/uploads/payment-gateway/rajorpay.png','charge' => '2','namespace' => 'App\\Lib\\Razorpay','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"key_id":"rzp_test_siWkeZjPLsYGSi","key_secret":"jmIzYyrRVMLkC9BwqCJ0wbmt"}', 'currency_id' => 4, 'created_at' => now(),'updated_at' => now()],
            ['id' => '6','name' => 'instamojo','logo' => '/uploads/payment-gateway/instamojo.png','charge' => '2','namespace' => 'App\\Lib\\Instamojo','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"x_api_key":"test_0027bc9da0a955f6d33a33d4a5d","x_auth_token":"test_211beaba149075c9268a47f26c6"}', 'currency_id' => 4, 'created_at' => now(),'updated_at' => now()],
            ['id' => '7','name' => 'toyyibpay','logo' => '/uploads/payment-gateway/toyybipay.png','charge' => '2','namespace' => 'App\\Lib\\Toyyibpay','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"user_secret_key":"v4nm8x50-bfb4-7f8y-evrs-85flcysx5b9p","cateogry_code":"5cc45t69"}','currency_id' => 6,'created_at' => now(),'updated_at' => now()],
            ['id' => '8','name' => 'flutterwave','logo' => '/uploads/payment-gateway/flutterwave.png','charge' => '2','namespace' => 'App\\Lib\\Flutterwave','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"public_key":"FLWPUBK_TEST-f448f625c416f69a7c08fc6028ebebbf-X","secret_key":"FLWSECK_TEST-561fa94f45fc758339b1e54b393f3178-X","encryption_key":"FLWSECK_TEST498417c2cc01","payment_options":"card"}', 'currency_id' => 5, 'created_at' => now(),'updated_at' => now()],
            ['id' => '9','name' => 'payu','logo' => '/uploads/payment-gateway/payu.png','charge' => '2','namespace' => 'App\\Lib\\Payu','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"merchant_key":"IPeQuHyk","merchant_salt":"YsfnYBVxYI","auth_header":"VHgXMklEVpktkIZjOZjdUJKPdSPe+c5iICxOFwaC9T0="}','currency_id'=>4,'created_at' => now(),'updated_at' => now()],
            ['id' => '10','name' => 'thawani','logo' => '/uploads/payment-gateway/uhawan.png','charge' => '1','namespace' => 'App\\Lib\\Thawani','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"secret_key":"rRQ26GcsZzoEhbrP2HZvLYDbn9C9et","publishable_key":"HGvTMLDssJghr9tlN9gr4DVYt0qyBy"}','currency_id'=> 7,'created_at' => now(),'updated_at' => now()],
            ['id' => '11','name' => 'mercadopago','logo' => '/uploads/payment-gateway/mercado-pago.png','charge' => '2','namespace' => 'App\\Lib\\Mercado','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"secret_key":"TEST-1884511374835248-071019-698f8465954d5983722e8b4d7a05f1ca-370993848","public_key":"TEST-7d239fd1-3c41-4dc0-96eb-f759b7d2adab"}', 'currency_id' => 1, 'created_at' => now(),'updated_at' => now()],
            ['id' => '12','name' => 'manual','logo' => '/uploads/payment-gateway/manual.png','charge' => '1','namespace' => 'App\\Lib\\CustomGateway','is_auto' => '0','image_accept' => '1','test_mode' => '1','status' => '1','phone_required' => '0','data' => '','currency_id'=> 1,'created_at' => now(),'updated_at' => now()],
            ['id' => '13','name' => 'From Wallet','logo' => '/uploads/payment-gateway/mycredit.png','charge' => '0','namespace' => 'App\\Lib\\Credit','is_auto' => '1','image_accept' => '0','test_mode' => '0','status' => '1','phone_required' => '0','data' => '','currency_id'=> 1, 'created_at' => now(),'updated_at' => now()]
        ];
        Gateway::insert($gateways);
        \Artisan::call('cache:clear');
    }
}
