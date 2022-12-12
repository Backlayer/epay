@extends('layouts.auth.app')

@section('title', __('Confirm Password'))

@section('form')
    {{ __('Please confirm your password before continuing.') }}

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password" required />
        </div>

        <input class="button" type="submit" value="Confirm Password" />
    </form>
@endsection


@section('footer')
    <p class="credit">{{ __('Forgot Your Password?') }} <a href="{{ route('password.request') }}">{{ __('Reset Now') }}</a></p>
@endsection

