@extends('layouts.frontend.app')

@section('title', __('Blog'))

@section('content')
    <!-- BLog Area -->
    <div class="blog-details-area section-padding-100-50 ">
        <div class="container">
            <div class="row">
                <!-- Side Blog Content -->
                <div class="col-lg-3">
                    <div class="side-blog-details-area">
                        <div class="single-side-content">
                            <form action="{{ route('frontend.blog.index') }}" type="get">
                                <div class="input-group">
                                    <div class="form-outline">
                                        <input type="search" name="q" class="form-control" placeholder="Type &amp; hit" required="">
                                    </div>
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="single-side-content">
                            <h4 class="side-blog-title">{{ __('Recent post') }}</h4>
                            <div class="recent-post-area">
                                @foreach($recentPosts as $recentPost)
                                    <!-- Single Post -->
                                    <div class="single-recent-post d-xl-flex align-items-center">
                                        <div class="recent-post-img">
                                            <img src="{{ asset($recentPost->preview->value ?? 'default.png') }}" alt="">
                                        </div>

                                        <div class="recent-post-text">
                                            <h5>
                                                <a href="{{ route('frontend.blog.show', $recentPost->slug) }}">
                                                    {{ $recentPost->title }}
                                                </a>
                                            </h5>
                                            <span class="recent-post-date">{{ formatted_date($recentPost->created_at) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Text -->
                <div class="col-lg-9">
                    <div class="blog-details-content mb-50">
                        <div class="blog-details-image text-center">
                            <img src="{{ asset($post->preview->value ?? 'default.png') }}" alt="">
                        </div>

                        <!-- Post Meta -->
                        <div class="post-meta">
                            <h2>{{ $post->title }}</h2>

                            <p>{!! $post->description->value !!}</p>

                            <div class="share-post d-sm-flex justify-content-between align-items-center">
                                <span>{{ __('Share Post :') }}</span>
                                <div id="social-share">
                                </div>
                            </div>

                            <!-- Comments Area -->
                            <div class="blog-comments-area">
                                {{ disquscomment() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- BLog Area -->
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jssocials/jssocials.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jssocials/jssocials-theme-minima.css') }}" />
@endpush

@push('script')
    <script src="{{ asset('plugins/jssocials/jssocials.min.js') }}"></script>
    <script>
        "use strict";
        $("#social-share").jsSocials({
            shares: ["twitter", "facebook", "email", "pinterest", "whatsapp"],
            url: "{{ route('frontend.blog.show', $post->slug) }}",
            text: "{{ $post->title }}",
            shareIn: "popup",
        });
    </script>
@endpush
