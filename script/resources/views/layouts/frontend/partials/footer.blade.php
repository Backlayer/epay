@php
    $logo = get_option('logo_setting');
    $footer = get_option('footer_setting');
    $languages = get_option('languages', false);
@endphp

<!-- Footer Area -->
<div class="footer-contact-area bg-gray-cu section-padding-100-50">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Footer Widget -->
            <div class="col-sm-5 col-lg-4">
                <div class="footer-single-widget left mb-50">
                    <div class="footer-logo">
                        <a href="#">
                            <img src="{{ $logo['logo'] ?? null }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                    <p>{{ $footer['about'] ?? null }}</p>
                </div>
            </div>

            <div class="col-sm-7 col-lg-7">
                <div class="row">
                    <!-- Footer Widget -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-single-widget first mb-50">
                            {{ RenderMenu('footer_left_menu', 'components.menu.footer') }}
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-single-widget first mb-50">
                            {{ RenderMenu('footer_right_menu', 'components.menu.footer') }}
                        </div>
                    </div>

                    <!-- Footer Widget -->
                    <div class="col-md-9 col-lg-6">
                        <div class="footer-single-widget second mb-50">
                            <h4>{{ __('News Letter') }}</h4>
                            <!-- News Letter Area -->
                            <div class="newsletter-form mb-4">
                                <form action="{{ route('frontend.subscribe-to-news-letter') }}" method="post" class="ajaxform">
                                    @csrf
                                    <input class="form-control" type="email" name="email" placeholder="{{ __("Enter email") }}" required>
                                    <button class="btn submit-btn submit-button px-3" type="submit">{{ __("Submit") }}</button>
                                </form>
                            </div>
                            <ul class="footer-social-area">
                                @foreach($footer['social'] ?? [] as $social)
                                    <li><a href="{{ $social['website_url'] ?? null }}"><i @class([$social['icon_class'] ?? null])></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
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
                    <!-- Copywrite Text -->
                    <div class="copywrite-text text-center">
                        <p class="mb-0">
                            {{ $footer['copyright'] ?? null }}
                        </p>
                    </div>
                    <!-- Dropup -->
                    <div class="language-dropdown text-center text-lg-end">
                         @foreach($languages ?? [] as $code => $language)
                         @php
                         if($code ==  current_locale()){
                            $current_locale=  $language;
                         }
                         
                         @endphp
                         @endforeach
                        <button class="copy-btn btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">{{ $current_locale ?? __('Language') }} </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            @foreach($languages ?? [] as $code => $language)
                                <a class="dropdown-item" href="{{ route('frontend.set-language', $code) }}">{{ $language }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bottom Copy Right Area -->
