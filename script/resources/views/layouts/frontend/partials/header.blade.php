@php
    $logo = get_option('logo_setting');
@endphp

<!-- Header Area Start -->
<header class="site-header site-header--menu-right landing-1-menu site-header--absolute site-header--sticky">
    <div class="container">
        <nav class="navbar site-navbar">
            <!-- Brand Logo-->
            <div class="brand-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ $logo['logo'] ?? null }}" alt="{{ config('app.name') }}" class="dark-version-logo">
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
                        {{ RenderMenu('header', 'components.menu.header') }}
                    </ul>
                </nav>
                @if(Auth::check())
                <a href="{{ Auth::user()->role == 'user' ? route('user.dashboard.index') : route('admin.dashboard.index') }}" class="hero-btn two d-none d-md-block">
                    {{ __('Dashboard') }}
                </a>
                @else
                    <a href="{{ route('login') }}" class="hero-btn two d-none d-md-block">
                        {{ __('Login') }}
                    </a>
                @endif
            </div>
            <!-- mobile menu trigger -->
            <div class="mobile-menu-trigger">
                <span></span>
            </div>
        </nav>
    </div>
</header>
<!-- header-end -->
