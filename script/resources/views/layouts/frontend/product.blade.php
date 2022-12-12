@extends('layouts.frontend.master')

@section('body')
    @include('layouts.frontend.partials.preloader')

    @include('layouts.frontend.productPartials.header')

    @yield('content')

    @include('layouts.frontend.partials.footer')
@endsection
