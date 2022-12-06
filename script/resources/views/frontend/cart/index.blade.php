@extends('layouts.frontend.store')

@section('title', __('Cart page'))

@section('content')
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-text d-sm-flex justify-content-between align-items-center">
                        <h2>{{ __('All Carts') }}</h2>
                        @if (auth()->id() == $store->user_id)
                        <div class="breadcrumb-dropdown d-flex align-items-center">
                            <div class="dropdown">
                                <a class="product-dro-btn dropdown-toggle two" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-plus"></i> {{ __('Add Product') }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user.physical-products.create') }}">{{ __('Physical product') }}</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('user.digital-products.create') }}">{{ __('Digital product') }}</a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area -->

    <!-- Cart Area -->
    <section class="shopping-cart spad">
        <div class="container" id="cart-area">
            @include('frontend.cart.cart-items')
        </div>
    </section>
    <!-- Cart Area -->
@endsection
