@php
$footer = get_option('footer_setting');
$languages = get_option('languages');
$store = get_store(request('store'));
@endphp

<!-- Footer Area -->
<div class="footer-contact-area bg-gray-cu section-padding-100-50">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Footer Widget -->
            <div class="col-12 text-center">
                <div class="footer-single-widget left">
                    <div class="footer-logo">
                        <a href="{{ route('frontend.store-products', request('store')) }}">
                            <img src="{{ asset($store->image) }}" alt="" class="dark-version-logo">
                        </a>
                    </div>
                    <p>{{ $store->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Copy Right Area -->
<div class="bootom-copy-right-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copywrite-bottom-area d-md-flex align-items-md-center justify-content-md-between">
                    <div class="copywrite-text text-center">
                        <p class="mb-0">
                            {!! $footer['copyright'] ?? null !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bottom Copy Right Area -->
<input type="hidden" id="cart-route" value="{{ route('frontend.cart.index') }}">
<input type="hidden" id="store" value="{{ request('store') }}">
