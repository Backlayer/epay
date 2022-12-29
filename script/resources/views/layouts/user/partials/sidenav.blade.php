@php
    $logo = get_option('logo_setting');

    $primaryMenu = [
        'supports' => [
            'ruleActive' => Route::is('user.supports.index'),
            'route' => route('user.supports.index'),
            'classIcon' => 'fas fa-flag-usa text-default',
            'title' => __('Support'),
            'enable' => true
        ],
        'transactions' => [
            'ruleActive' => Route::is('user.transactions.index'),
            'route' => route('user.transactions.index'),
            'classIcon' => 'fas fa-money-check-alt text-green',
            'title' => __('Transactions'),
            'enable' => true
        ],
        'deposit' => [
            'ruleActive' => Route::is('user.deposits.index'),
            'route' => route('user.deposits.index'),
            'classIcon' => 'fas fa-arrow-up text-info',
            'title' => __('Deposit'),
            'enable' => false
        ],
        'transfers' => [
            'ruleActive' => Route::is('user.transfers.index') || Route::is('user.transfers.create'),
            'route' => route('user.transfers.index'),
            'classIcon' => 'fas fa-random text-orange',
            'title' => __('Transfer Money'),
            'enable' => false
        ],
        'subscribers' => [
            'ruleActive' => Route::is('user.subscribers.index'),
            'route' => route('user.subscribers.index'),
            'classIcon' => 'fa fa-user text-primary',
            'title' => __('Subscribers'),
            'enable' => false
        ],
        'payouts' => [
            'ruleActive' => Route::is('user.payouts.index'),
            'route' => route('user.payouts.index'),
            'classIcon' => 'fas fa-arrow-circle-down text-info',
            'title' => __('Payouts'),
            'enable' => true
        ],
        'charges' => [
            'ruleActive' => Route::is('user.charges.index'),
            'route' => route('user.charges.index'),
            'classIcon' => 'fas fa-comment-dollar text-red',
            'title' => __('Charges'),
            'enable' => true
        ]
    ];

    $secondaryMenu = [
        'categories' => [
            'ruleActive' => Route::is('user.categories.index'),
            'route' => route('user.categories.index'),
            'classIcon' => 'fas fa-sitemap text-dark',
            'title' => __('Categories'),
            'enable' => false
        ],
        'storefronts' => [
            'ruleActive' => Route::is('user.storefronts.index'),
            'route' => route('user.storefronts.index'),
            'classIcon' => 'fas fa-store-alt text-pink',
            'title' => __('Store front'),
            'enable' => false
        ],
        'products' => [
            'ruleActive' => request()->is('*/digital-products') || request()->is('*/physical-products'),
            'route' => 'navbar-products',
            'classIcon' => 'fas fa-shopping-bag text-gray',
            'title' => __('Products'),
            'enable' => false,
            'children' => [
                'physical-products' => [
                    'ruleActive' => request()->is('*/physical-products'),
                    'route' => route('user.physical-products.index'),
                    'title' => __('Physical products'),
                    'enable' => true
                ],
                'digital-products' => [
                    'ruleActive' => request()->is('*/digital-products'),
                    'route' => route('user.digital-products.index'),
                    'title' => __('Digital products'),
                    'enable' => true
                ]
            ]
        ],
        'shipping-rate' => [
            'ruleActive' => Route::is('user.shipping-rate.index'),
            'route' => route('user.shipping-rate.index'),
            'classIcon' => 'fas fa-street-view',
            'title' => __('Shippings'),
            'enable' => false
        ],
        'orders' => [
            'ruleActive' => Route::is('user.orders.index'),
            'route' => route('user.orders.index'),
            'classIcon' => 'fas fa-shopping-cart text-info',
            'title' => __('Orders'),
            'enable' => false
        ],
        'request-money' => [
            'ruleActive' => Route::is('user.request-money.index'),
            'route' => route('user.request-money.index'),
            'classIcon' => 'fas fa-handshake text-success',
            'title' => __('Request Money'),
            'enable' => true
        ],
        'single-charges' => [
            'ruleActive' => Route::is('user/single-charges*'),
            'route' => route('user.single-charges.index'),
            'classIcon' => 'fas fa-link text-primary',
            'title' => __('Single Charge'),
            'enable' => true
        ],
        'qr-payments' => [
            'ruleActive' => Route::is('user.qr-payments.index'),
            'route' => route('user.qr-payments.index'),
            'classIcon' => 'fas fa-qrcode text-info',
            'title' => __('Qr Payments'),
            'enable' => true
        ],
        'donations' => [
            'ruleActive' => Request::is('user/donations'),
            'route' => route('user.donations.index'),
            'classIcon' => 'fas fa-gift text-default',
            'title' => __('Donation'),
            'enable' => false
        ],
        'invoices' => [
            'ruleActive' => Route::is('user.invoices.index'),
            'route' => route('user.invoices.index'),
            'classIcon' => 'fas fa-envelope text-red',
            'title' => __('Invoice'),
            'enable' => true
        ],
        'plans' => [
            'ruleActive' => Route::is('user.plans.index'),
            'route' => route('user.plans.index'),
            'classIcon' => 'fas fa-layer-group text-info',
            'title' => __('Plan'),
            'enable' => false
        ],
        'websites' => [
            'ruleActive' => Route::is('user.websites.index'),
            'route' => route('user.websites.index'),
            'classIcon' => 'fas fa-laptop',
            'title' => __('Website Integration'),
            'enable' => false
        ]
    ];
@endphp

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('user.dashboard.index') }}">
                <img src="{{ $logo['logo'] ?? null }}" alt="{{ config('app.name') }}" class="dark-version-logo">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10">
                <h3 class="mb-0">@lang('Balance'): <b>{{ currency_format(auth()->user()->wallet, currency:user_currency()) }}</b></h3>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.dashboard.index')]) href="{{ route('user.dashboard.index') }}">
                            <i class="fas fa-home text-primary"></i>
                            <span class="nav-link-text">{{ __('Dashbaord') }}</span>
                        </a>
                    </li>
                </ul>
                <!-- Heading -->
                <h6 class="navbar-heading p-0 mt-3 text-muted">{{ __('YOUR BUSINESS') }}</h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    @foreach ($primaryMenu as $item)
                        @if($item['enable'])
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => $item['ruleActive']]) href="{{ $item['route'] }}">
                                <i class="{{ $item['classIcon'] }}"></i>
                                <span class="nav-link-text">{{ $item['title'] }}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
                <h6 class="navbar-heading p-0 text-muted">{{ __('COLLECT PAYMENTS') }}</h6>
                <ul class="navbar-nav mb-md-3">
                    @foreach ($secondaryMenu as $item)
                        @if($item['enable'])
                        <li class="nav-item">
                            @if(@!isset($item['children']))
                            <a @class(['nav-link', 'active' => $item['ruleActive']]) href="{{ $item['route'] }}">
                                <i class="{{ $item['classIcon'] }}"></i>
                                <span class="nav-link-text">{{ $item['title'] }}</span>
                            </a>
                            @else
                            <a @class(['nav-link', 'active' => $item['ruleActive']]) href="#{{ $item['route'] }}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
                                <i class="{{ $item['classIcon'] }}"></i>
                                <span class="nav-link-text">{{ $item['title'] }}</span>
                            </a>
                            <div class="{{ $item['ruleActive'] ? '' : 'collapse' }}" id="{{ $item['route'] }}">
                                <ul class="nav nav-sm flex-column">
                                @foreach (@$item['children'] as $subitem)
                                    @if($subitem['enable'])
                                    <li class="nav-item">
                                        <a href="{{ $subitem['route'] }}" @class(['nav-link', 'active' => $subitem['ruleActive']])>
                                            {{ $subitem['title'] }}
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                            @endif
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
