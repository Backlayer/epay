@extends('layouts.frontend.master')

@section('body')
    @include('layouts.frontend.partials.preloader')

    @include('layouts.frontend.storePartials.header')

    @yield('content')

    @include('layouts.frontend.storePartials.footer')
@endsection
