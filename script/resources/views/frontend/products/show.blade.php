@extends('layouts.frontend.store')

@section('title', __($product->name))

@section('content')
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area-single">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content-text">
                        <h6>@lang('Product Details')</h6>
                        <h3>@lang('Stay focused on your business.')</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area -->

    <section class="shop-details">

        <div class="product__details__content">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5">
                        <div class="product-image text-center mb-5">
                            <img src="{{ asset($product->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product__details__text mb-5">
                            <h4>{{ $product->name }}</h4>

                            <h3>
                                {{ user_currency($product->user)->symbol . $product->price }}
                            </h3>
                            <p>{!! $product->description !!}</p>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <span class="fa fa-angle-up dec qtybtn"></span>
                                        <input type="number" value="1" id="quantity" max="{{ $product->quantity }}" min="1">
                                        <span class="fa fa-angle-down inc qtybtn"></span>
                                    </div>
                                </div>
                                @if ($product->quantity)
                                <a href="javascript:void(0)" data-id="{{ $product->id ?? '' }}" data-url="{{ route('frontend.cart.store') }}" data-store="{{ request('store') }}" class="add_to_cart product-dro-btn two"> {{ __('add to cart') }}</a>
                                @else
                                <a href="javascript:void(0)" class="product-dro-btn text-warning two">{{ __('Stock out') }}</a>
                                @endif
                                <input type="hidden" id="max-qty" value="{{ $product->quantity }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab mb-100">
                            <ul class="nav nav-pills mb-3 product-border-bottom justify-content-center" id="pills-tab"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ __("Description") }}
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="product__details__tab__content">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-6 col-lg-3">
                        <div class="single-product-area text-center">
                            <a href="{{ route('frontend.products.show', [$store->id, $product->id]) }}">
                                <div class="product-img">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </div>
                            </a>
                            <div class="product-text">
                                <h6>{{ $product->category->title ?? '' }}</h6>
                                <h5> {{ $product->name }} </h5>
                                <p>{{ __('Price') }}: {{ user_currency($store->user)->symbol . $product->price }}</p>
                                <div class="product-details-area ">
                                    <div class="cart-btn">
                                        <a href="{{ route('frontend.products.show', [$store->id, $product->id]) }}">{{ __('Shop product') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
