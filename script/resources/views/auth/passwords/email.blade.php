@extends('layouts.auth.app')

@section('title', __('Reset Password'))

@section('form')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input_field">
            <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email Address" required />
        </div>

        <input class="button" type="submit" value=" {{ __('Send Password Reset Link') }}" />
    </form>
@endsection
