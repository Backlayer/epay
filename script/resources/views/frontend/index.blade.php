@extends('layouts.frontend.app')

@section('content')
    @include('frontend.home.welcome')

    @include('frontend.home.feature')

    @include('frontend.home.about')

    @include('frontend.home.payment')

    @include('frontend.home.integration')

    @include('frontend.home.capture')

    @include('frontend.home.security')

    @include('frontend.home.review')

    @include('frontend.home.faq')

    @include('frontend.home.blog')
@endsection
