@extends('layouts.backend.app')

@section('title', __('Headings'))

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="welcome-tab" data-toggle="tab" href="#welcome" role="tab" aria-controls="home" aria-selected="true">
                                {{ __('Welcome Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="feature-tab" data-toggle="tab" href="#feature" role="tab" aria-controls="feature" aria-selected="false">
                                {{ __('Feature Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">
                                {{ __('About Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">
                                {{ __('Payment Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="integration-tab" data-toggle="tab" href="#integration" role="tab" aria-controls="integration" aria-selected="false">
                                {{ __('Integration Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="capture-tab" data-toggle="tab" href="#capture" role="tab" aria-controls="capture" aria-selected="false">
                                {{ __('Capture Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">
                                {{ __('Security Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">
                                {{ __('Review Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">
                                {{ __('FAQ Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="latest-news-tab" data-toggle="tab" href="#latest-news" role="tab" aria-controls="latest-news" aria-selected="false">
                                {{ __('Latest News Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                                {{ __('Contact') }}
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8">
            <div class="tab-content no-padding" id="myTab2Content">
                <div class="tab-pane fade show active" id="welcome" role="tabpanel" aria-labelledby="welcome-tab">
                    @include('admin.settings.website.heading.welcome')
                </div>

                <div class="tab-pane fade" id="feature" role="tabpanel" aria-labelledby="feature-tab">
                    @include('admin.settings.website.heading.feature')
                </div>

                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                    @include('admin.settings.website.heading.about')
                </div>

                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    @include('admin.settings.website.heading.payment')
                </div>

                <div class="tab-pane fade" id="integration" role="tabpanel" aria-labelledby="integration-tab">
                    @include('admin.settings.website.heading.integration')
                </div>

                <div class="tab-pane fade" id="capture" role="tabpanel" aria-labelledby="capture-tab">
                    @include('admin.settings.website.heading.capture')
                </div>

                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    @include('admin.settings.website.heading.security')
                </div>

                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    @include('admin.settings.website.heading.review')
                </div>

                <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    @include('admin.settings.website.heading.faq')
                </div>

                <div class="tab-pane fade" id="latest-news" role="tabpanel" aria-labelledby="latest-news-tab">
                    @include('admin.settings.website.heading.latestnews')
                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @include('admin.settings.website.heading.contact')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqueryrepeater/jquery.repeater.min.js') }}"></script>
@endpush
