@extends('layouts.frontend.store')

@section('content')
    <div class="product-area section-padding-100-50">
        @if ($store->status)
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <a href="{{ route('frontend.products.show', [$store->id, $product->id]) }}">
                            <div class="product-img">
                                <img src="{{ asset($product->image ?? 'uploads/default.png') }}" alt="">
                            </div>
                        </a>
                        <div class="product-text">
                            <h6>{{ $product->category->title }}</h6>
                            <h5> {{ $product->name }} </h5>
                            <p>{{ __('Price') }}: {{ user_currency($store->user)->symbol . $product->price }}</p>
                            <div class="product-details-area ">
                                <div class="cart-btn">
                                    <a href="{{ route('frontend.products.show', [$store->id, $product->id]) }}">{{ __('Add To Cart') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="shop_pagination_area mt-30 mb-50">
                        {{ $products->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6 text-center">
                    <h3 class="text-warning">{{ __("This store has been disabled.") }}</h3>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
