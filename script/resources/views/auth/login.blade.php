@extends('layouts.auth.app')

@section('title', __('Login'))

@section('form')
    <form action="{{ route('login') }}" method="POST" class="ajaxform_instant_reload">
        <div class="mb-20">
            <label for="email" class="col-form-label">{{ __('Email') }}</label>
            <input type="text" class="form-control focus-input100" id="email" name="email" placeholder="Type email" required>
        </div>

        <div class="mb-40">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>
            <input type="password" class="form-control focus-input100" id="password" name="password" placeholder="Type Password" required>
        </div>

        <!-- Button -->
        <button type="submit" class="site-btn w-100 submit-btn">{{ __('Login') }}</button>
    </form>

    <!-- Other Sign Up -->
    <div class="other-sign-up-area text-center">
        <p><a href="{{ url('/password/reset') }}">{{ __('Forgot Password?') }}</a></p>
        <span>{{ __('Don\'t have an account?') }} <a href="{{ route('register') }}">{{ __('Sign up') }}</a></span>
    </div>
@endsection
