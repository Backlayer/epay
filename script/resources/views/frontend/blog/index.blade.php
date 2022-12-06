@extends('layouts.frontend.app')



@section('title', __('Blog'))

@section('content')
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area-single">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content-text">
                        <h6>{{ __('Blog Posts') }}</h6>
                        <h3>{{ __('description.blog') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area -->


    <!-- BLog Area -->
    <div class="blog-area section-padding-100-50">
        <div class="container">
            <div class="row justify-content-center">
                @forelse($posts ?? [] as $post)
                <!-- Single Blog -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-blog-area mb-50">
                        <div class="blog-image">
                            <img src="{{ $post->preview->value ?? null }}" alt="">
                        </div>
                        <h4><a href="{{ route('frontend.blog.show', $post->slug) }}">{{ str($post->title)->words(7) }}</a></h4>
                        <p>{{ str($post->excerpt->value ?? "")->words(17) }}</p>
                        <div class="blog-btn">
                            <a href="{{ route('frontend.blog.show', $post->slug) }}">{{_('Read more')}} <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-6 col-lg-4">
                        <div class="single-blog-area mb-50 text-center">
                            {{ __('No posts found!') }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- BLog Area -->
@endsection
