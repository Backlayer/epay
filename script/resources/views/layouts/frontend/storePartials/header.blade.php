@php
    $store = get_store(request('store'));
@endphp

<!-- Header Area Start -->
<header class="site-header ecommerce site-header--menu-right landing-1-menu site-header--absolute site-header--sticky">
    <div class="container d-flex justify-content-between align-items-center">
        <nav class="navbar site-navbar">
            <!-- Brand Logo-->
            <div class="brand-logo ecommerce">
                <a href="{{ route('frontend.store-products', request('store')) }}">
                    <img src="{{ asset($store->image) }}" alt="" class="dark-version-logo">
                </a>
            </div>

            <div class="menu-block-wrapper">
                <div class="menu-overlay"></div>
                <nav class="menu-block" id="append-menu-header">
                    <div class="mobile-menu-head">
                        <div class="go-back">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="current-menu-title"></div>
                        <div class="mobile-menu-close">&times;</div>
                    </div>
                    <ul class="site-menu-main py-1">
                        <li> <a class="nav-link-item"></a></li>
                    </ul>
                </nav>
            </div>
        </nav>


        <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
            <!-- Cart -->
            <div class="cart-area">
                <div class="cart--btn"><i class="fas fa-cart-plus"></i> <span class="cart_quantity">{{ Cart::instance('shopping_'.request('store'))->count() }}</span></div>
                <!-- Cart Dropdown Content -->
                <div class="cart-dropdown-content">
                    <ul class="cart-list">
                        @foreach (Cart::instance('shopping_'.request('store'))->content() as $cart)
                        <li>
                            <div class="cart-item-desc">
                                <a href="{{ route('frontend.products.show', [$store->id, $cart->id]) }}" class="image">
                                    <img src="{{ asset($cart->options['image'] ?? '') }}" class="cart-thumb" alt="">
                                </a>
                                <div>
                                    <a href="{{ route('frontend.products.show', [$store->id, $cart->id]) }}">{{ Str::limit($cart->name, 20, '...') }}</a>
                                    <p>{{ $cart->qty }} x - <span class="price">{{ user_currency($cart->options['user'] ?? '')->symbol . ($cart->qty * $cart->price) }}</span></p>
                                </div>
                            </div>
                            <span class="dropdown-product-remove cart__close"  data-id="{{ $cart->rowId }}"><i class="fas fa-times"></i></span>
                        </li>
                        @endforeach
                    </ul>
                    <div class="cart-btn">
                        <a href="{{ route('frontend.cart.index', ['store' => request('store')]) }}" class="d-block">{{ __("Cart") }}</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
<!-- header-end -->
