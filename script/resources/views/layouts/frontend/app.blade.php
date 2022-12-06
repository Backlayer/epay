@extends('layouts.frontend.master')

@section('body')
    @include('layouts.frontend.partials.preloader')

    @include('layouts.frontend.partials.header')

    @yield('content')

    @include('layouts.frontend.partials.footer')
@endsection
