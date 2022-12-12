<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@hasSection('title') @yield('title') | @endif{{ config('app.name') }}</title>

    <!-- Favicon icon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ get_option('logo_setting', true)->favicon ?? null }}"/>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-5.15.4/css/all.css') }}">

    @yield('style')
    @stack('css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>

<body>

<section class="section">
    <div class="container mt-5">
        <div class="page-error">
            <div class="page-inner">
                <h1>@yield('code')</h1>
                <div class="page-description">
                    @yield('message')
                </div>
                <div class="mt-3">
                    <a href="{{ $button_url ?? url('/') }}">{{ $button_text ?? __('Back to Home') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="simple-footer mt-5">
        {{ get_option('footer_setting')['copyright'] ?? __("Copyright &copy; :name :year", ['name' => config('app.name'), 'year' => date('Y')]) }}
    </div>
</section>
</body>
</html>
