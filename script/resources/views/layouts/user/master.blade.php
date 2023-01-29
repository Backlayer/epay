<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Carlos Camacho">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset(get_option('logo_setting', true)->favicon ?? null) }}"/>
    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name') }}</title>
    @include('layouts.user.partials.styles')
</head>
<body>
    @include('layouts.user.partials.sidenav')
    <div class="main-content" id="panel">
        @include('layouts.user.partials.topnav')
        @include('layouts.user.partials.header')
        <div class="container-fluid mt--6">
            @yield('content')
        </div>
    </div>
    @stack('modal')
    @include('layouts.user.partials.scripts')
</body>
</html>
