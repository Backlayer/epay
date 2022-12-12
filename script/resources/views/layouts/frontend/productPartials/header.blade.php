<!-- Header Area Start -->
<header class="site-header ecommerce site-header--menu-right landing-1-menu site-header--absolute site-header--sticky">
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-6">
                    <div class="welcome-note">
                        <span class="popover--text" data-toggle="popover" data-content="Welcome to Bigshop ecommerce template." data-original-title="" title=""><i class="icofont-info-square"></i></span>
                        <span class="text">{{ __('Welcome to Transfer ecommerce template.') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                        <!-- Language Dropdown -->
                        <div class="language-dropdown">
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('English') }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">{{ __('Bangla') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('Arabic') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Currency Dropdown -->
                        <div class="currency-dropdown">
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    $ {{ __('USD') }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">৳ {{ __('BDT') }}</a></li>
                                    <li><a class="dropdown-item" href="#">€ {{ __('Euro') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-between align-items-center">
        <nav class="navbar site-navbar">
            <!-- Brand Logo-->
            <div class="brand-logo ecommerce">
                <a href="{{ route('frontend.store-products', request('store')) }}">
                    <img src="{{ asset('frontend/img/core-img/logo.png') }}" alt="" class="dark-version-logo">
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
                    <ul class="site-menu-main">
                        <li> <a href="index.html" class="nav-link-item">{{ __('Home') }}</a></li>
                        <li> <a href="about.html" class="nav-link-item">{{ __('About') }}</a></li>
                        <li class="nav-item nav-item-has-children">

                            <a href="#" class="nav-link-item drop-trigger">{{ __('Features') }} <i class="fas fa-angle-down"></i>
                            </a>
                            <ul class="sub-menu" id="submenu-9">
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Transfer Money') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Requesting Money') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Invoice') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Single Charge') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="donation.html">{{ __('Donation Service') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Virtual Cards') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Bill Payment') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Subscription Service') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Sub Accounts') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="#">{{ __('Website Integration') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item nav-item-has-children">

                            <a href="#" class="nav-link-item drop-trigger">{{ __('Storefront') }} <i
                                    class="fas fa-angle-down"></i>
                            </a>
                            <ul class="sub-menu" id="submenu-10">
                                <li class="sub-menu--item">
                                    <a href="product.html">{{ __('Product') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="product-details.html">{{ __('Product Details') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="cart.html">{{ __('Cart') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="checkout.html">{{ __('Checkout') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-has-children">

                            <a href="#" class="nav-link-item drop-trigger">{{ __('Pages') }} <i
                                    class="fas fa-angle-down"></i>
                            </a>
                            <ul class="sub-menu" id="submenu-12">
                                <li class="sub-menu--item">
                                    <a href="blog.html">{{ __('Blog Grid') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="blog-details.html">{{ __('Blog Details') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="login.html">{{ __('Login') }}</a>
                                </li>
                                <li class="sub-menu--item">
                                    <a href="register.html">{{ __('Register') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li> <a href="contact.html" class="nav-link-item">{{ __('Contact') }}</a></li>
                    </ul>
                </nav>
            </div>

            <!-- mobile menu trigger -->
            <div class="mobile-menu-trigger">
                <span></span>
            </div>
        </nav>

        <!-- Brand Logo-->
        <div class="brand-logo-mobile-menu-bar">
            <a href="#">
                <img src="{{ asset('frontend/img/core-img/logo.png') }}" alt="" class="dark-version-logo">
            </a>
        </div>

        <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
            <!-- Search -->
            <div class="search-area">
                <div class="search-btn"><i class="fas fa-search"></i></div>
                <!-- Form -->
                <div class="search-form">
                    <input type="search" class="form-control" placeholder="Search">
                    <input type="submit" class="d-none" value="Send">
                </div>
            </div>

            <!-- Wishlist -->
            <div class="wishlist-area">
                <a href="product.html" class="wishlist-btn"><i class="far fa-heart"></i></a>
            </div>

            <!-- Cart -->
            <div class="cart-area">
                <div class="cart--btn">
                    <i class="fas fa-cart-plus"></i>
                    <span class="cart_quantity">{{ Cart::instance('shopping_'.request('store'))->count() }}</span>
                </div>

                <!-- Cart Dropdown Content -->
                <div class="cart-dropdown-content">
                    <ul class="cart-list">
                        @include('layouts.frontend.productPartials.cart-items')
                    </ul>
                    <div class="cart-btn">
                        <a href="{{ route('frontend.cart.index', ['store' => request('store')]) }}" class="d-block">{{ __("Carts") }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->
