@extends('layouts.frontend.master', [
    'bodyClass' => 'bg-gray-cu-2'
])

@section('body')
    <!-- Login Area -->
    <div class="login-area">
        <!-- Welcome Animation -->
        <div class="welcome-animation">

            <div class="bubble wb-two d-none d-md-block"></div>
            <div class="bubble b_three"></div>
            <div class="bubble b_four d-none d-sm-block"></div>
            <div class="square-shape1 d-none d-sm-block"></div>
            <div class="bubble b_six d-none d-sm-block"></div>

        </div>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Login form -->
                <div @class(['col-lg-5' => !isset($columnClass), $columnClass ?? null])>
                    <div class="login-content">
                        <p class="login-title">@yield('title')</p>
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
