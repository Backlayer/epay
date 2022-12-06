<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Document') }}</title>
    <link rel="icon" href="{{ get_option('logo_setting', true)->favicon ?? null }}"/>
</head>
<body>
<article class="card">
    <div class="container">
        <div class="card-title">
            <h2>{{ __('Payment') }}</h2>
        </div>
        <div class="card-body">
            <div class="payment-type">
                <h4>{{ __('Choose payment method below') }}</h4>
                <div class="types flex justify-space-between">
                    <div class="type selected">
                        <div class="logo">
                            <i class="far fa-credit-card"></i>
                        </div>
                        <div class="text">
                            <p>{{ __('Pay with Credit Card') }}</p>
                        </div>
                    </div>
                    <div class="type">
                        <div class="logo">
                            <i class="fab fa-paypal"></i>
                        </div>
                        <div class="text">
                            <p>{{ __('Pay with PayPal') }}</p>
                        </div>
                    </div>
                    <div class="type">
                        <div class="logo">
                            <i class="fab fa-amazon"></i>
                        </div>
                        <div class="text">
                            <p>{{ __('Pay with Amazon') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payment-info flex justify-space-between">
                <div class="column billing">
                    <div class="title">
                        <div class="num">1</div>
                        <h4>{{ __('Billing Info') }}</h4>
                    </div>
                    <div class="field full">
                        <label for="name">{{ __('Full Name') }}</label>
                        <input id="name" type="text" placeholder="{{ __('Full Name') }}">
                    </div>
                    <div class="field full">
                        <label for="address">{{ __('Billing Address') }}</label>
                        <input id="address" type="text" placeholder="{{ __('Billing Address') }}">
                    </div>
                    <div class="flex justify-space-between">
                        <div class="field half">
                            <label for="city">{{ __('City') }}</label>
                            <input id="city" type="text" placeholder="City">
                        </div>
                        <div class="field half">
                            <label for="state">{{ __('State') }}</label>
                            <input id="state" type="text" placeholder="State">
                        </div>
                    </div>
                    <div class="field full">
                        <label for="zip">{{ __('Zip') }}</label>
                        <input id="zip" type="text" placeholder="Zip">
                    </div>
                </div>
                <div class="column shipping">
                    <div class="title">
                        <div class="num">2</div>
                        <h4>{{ __('Credit Card Info') }}</h4>
                    </div>
                    <div class="field full">
                        <label for="name">{{ __('Cardholder Name') }}</label>
                        <input id="name" type="text" placeholder="Full Name">
                    </div>
                    <div class="field full">
                        <label for="address">{{ __('Card Number') }}</label>
                        <input id="address" type="text" placeholder="1234-5678-9012-3456">
                    </div>
                    <div class="flex justify-space-between">
                        <div class="field half">
                            <label for="city">{{ __('Exp. Month') }}</label>
                            <input id="city" type="text" placeholder="12">
                        </div>
                        <div class="field half">
                            <label for="state">{{ __('Exp. Year') }}</label>
                            <input id="state" type="text" placeholder="19">
                        </div>
                    </div>
                    <div class="field full">
                        <label for="zip">{{ __('CVC Number') }}</label>
                        <input id="zip" type="text" placeholder="468">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-actions flex justify-space-between">
            <div class="flex-start">
                <button class="button button-secondary">{{ __('Return to Store') }}</button>
            </div>
            <div class="flex-end">
                <button class="button button-link">{{ __('Back to Shipping') }}</button>
                <button class="button button-primary">{{ __('Proceed') }}</button>
            </div>
        </div>
    </div>
</article>
<footer>
    Design based on example found <a href="/" target="_blank">here</a>
</footer>
</body>
</html>
