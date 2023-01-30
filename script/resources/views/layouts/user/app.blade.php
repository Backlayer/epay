@extends('layouts.user.master')

@section('body')
    @include('layouts.user.partials.sidenav')
    <!-- Main content -->
    <div class="main-content" id="panel">
        @include('layouts.user.partials.topnav')

        @include('layouts.user.partials.header')

        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('content')

            @include('layouts.user.partials.footer')
        </div>
    </div>
@endsection

@push('css')
    <style>
        @media (min-width: 767px) {
            body {
                display: flex !important;
                justify-content: end !important;
            }
            .main-content {
                width: 100% !important;
            }
        }

        @media (min-width: 1200px) {
            .main-content {
                width: calc(100% - 250px) !important;
            }
        }
    </style>
@endpush