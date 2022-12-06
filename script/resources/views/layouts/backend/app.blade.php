<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@hasSection('title') @yield('title') | @endif{{ config('app.name') }}</title>

    <!-- Favicon icon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ get_option('logo_setting', true)->favicon ?? null }}"/>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-5.15.4/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastifyjs/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm-js/jquery-confirm.min.css') }}">

    @yield('style')
    @stack('css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>

<body>

<div class="main-wrapper">
    <!--- Header Section ---->
    @include('layouts.backend.partials.header')

    <!--- Sidebar Section --->
    @include('layouts.backend.partials.sidebar')

    <!--- Main Content --->
    <div class="main-content  main-wrapper-1">
        @hasSection('title')
        <section class="section">
            @include('layouts.backend.partials.headersection')
        </section>
        @endif

        @yield('content')
    </div>

    @yield('modal')

    <!--- Footer Section --->
     @include('layouts.backend.partials.footer')
</div>


<input type="hidden" class="placeholder_image" value="{{ asset('admin/img/img/placeholder.png') }}">

<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="site_url" value="{{ url('/') }}">

<!-- General JS Scripts -->
<script src="{{ asset('admin/plugins/jquery/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('admin/plugins/popperjs/popper.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('admin/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqueryvalidation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-confirm-js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('admin/plugins/selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/toastifyjs/toastify.js') }}"></script>
<script src="{{ asset('plugins/custom/Notify.js') }}"></script>
<script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>


@yield('script')
@stack('script')

<!-- Template JS File -->
<script src="{{ asset('admin/js/scripts.js') }}"></script>

<script src="{{ asset('admin/js/main.js') }}"></script>
<script src="{{ asset('admin/js/custom.js') }}"></script>
<script src="{{ asset('admin/custom/form.js') }}"></script>
<script src="{{ asset('plugins/custom/custom.js') }}"></script>

@if(Session::has('success'))
    <script>
        Sweet('success', '{{ Session::get('success') }}');
    </script>
@endif

@if(Session::has('warning'))
    <script>
        Sweet('warning', '{{ Session::get('warning') }}');
    </script>
@endif

@if(Session::has('error'))
    <script>
        Sweet('error', '{{ Session::get('error') }}');
    </script>
@endif

@if(Request::has('trigger'))
    <script>
        $('#{{ Request::get('trigger') }}').trigger('click');
    </script>
@endif

</body>
</html>
