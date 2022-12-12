@extends('layouts.auth.app')


@section('form')
    <form method="POST" action="{{ route('password.update') }}" class="">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input_field">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

        </div>
        <div class="input_field">
            <input id="password" type="password" placeholder="Enter New Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        </div>
        <div class="input_field">
            <input id="password-confirm" placeholder="Enter Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button class="btn btn-danger w-100 basicbtn">  {{ __('Reset Password') }}</button>
    </form>
@endsection
