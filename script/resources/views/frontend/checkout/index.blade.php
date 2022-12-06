@extends('layouts.frontend.store')

@section('title', __('Products'))

@section('content')

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-text">
                        <h2>{{ __('Checkout') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('frontend.checkout.store', ['store' => request('store')]) }}" method="post" class="ajaxform_instant_reload">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6 mb-50">
                            <h6 class="checkout__title">{{ __('Billing Details') }}</h6>
                            <div class="checkout__input">
                                <p>{{ __('Name') }}<span>*</span></p>
                                <input type="text" name="name" required value="{{ auth()->user()->name ?? '' }}">
                            </div>
                            @if ($store->product_type == 0)
                            <div class="checkout__input">
                                <p>{{ __('Address') }}<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="street_address" required>
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)" name="apartment">
                            </div>
                            <div class="checkout__input">
                                <p>{{ __("Town/City") }}<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('Country/State') }}<span>*</span></p>
                                <input type="text" name="country" required>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>{{ __('Phone') }}<span>*</span></p>
                                        <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>{{ __('Email') }}<span>*</span></p>
                                        <input type="text" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                                    </div>
                                </div>
                            </div>
                            @if ($store->product_type == 0 && !auth()->check())
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    {{ __('Create an account?') }}
                                    <input type="checkbox" id="acc" name="create_account">
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{ __('Create an account by entering the information below. If you are a returning customer please login at the top of the page') }}</p>
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('Account Password') }}</p>
                                <input type="text" name="password">
                            </div>
                            @endif
                            @if ($store->note_status)
                            <div class="checkout__input">
                                <p>{{ __('Order notes') }}</p>
                                <input type="text" name="note" {{ $store->note_status == 1 ? 'required':'' }} placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">{{ __('Your order') }}</h4>
                                <div class="checkout__order__products">{{ __('Product') }} <span>{{ __('Total') }}</span></div>
                                <ul class="checkout__total__products">
                                    @foreach (Cart::instance('shopping_'.request('store'))->content() as $product)
                                    <li>{{ $loop->index+1 ." ". $product->name }} <span> {{ $product->qty }} × {{ user_currency($product->options['user'] ?? null)->symbol . $product->price }}</span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>{{ __('Subtotal') }} <span>{{ user_currency($store->user)->symbol . Cart::instance('shopping_'.request('store'))->subtotal() }}</span></li>
                                    <li>{{ __('Total') }} <span> {{ user_currency($store->user)->symbol }} <span class="total-price">{{ Cart::instance('shopping_'.request('store'))->subtotal() }}</span></span></li>
                                </ul>
                                @if ($store->shipping_status && $store->product_type == 0)
                                <div class="checkout__input shipping-fees">
                                    <p>{{ __('Select shipping address') }}</p>
                                    <select name="shipping_id" class="form-control shipping-place">
                                        <option value="">-{{ __('Select') }}-</option>
                                        @foreach ($shippings as $shipping)
                                        <option amount="{{ $shipping->amount }}" value="{{ $shipping->id }}">{{ $shipping->region }}</option>
                                        @endforeach
                                    </select>
                                    <p>{{ __('Shipping charge is : ') . user_currency($store->user)->symbol }}<span class="shipping-charge text-dark fw-bold">0</span></p>
                                </div>
                                @endif
                                @auth
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="wallet">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ __('Pay from wallet') }}
                                    </label>
                                </div>
                                @endauth
                                @if (Cart::instance('shopping_'.request('store'))->count() > 0)
                                <button type="submit" class="site-btn submit-btn">{{ __('PLACE ORDER') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <input type="hidden" id="total-price" value="{{ Cart::instance('shopping_'.request('store'))->subtotal() }}">
@endsection
