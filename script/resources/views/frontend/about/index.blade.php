@extends('layouts.frontend.app')

@section('content')

    <!-- About Us Area -->
    <div class="single-about-us-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="about-2-img">
                        <img src="{{ asset($about->image) }}" alt="">
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="about-content-text">
                        <h2>{{ $about->title ?? null }}</h2>
                        <p>{{ $about->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Area -->


    @include('frontend.home.feature')

    @include('frontend.home.about')
@endsection
