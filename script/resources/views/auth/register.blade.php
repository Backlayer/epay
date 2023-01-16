@extends('layouts.auth.app', [
    'columnClass' => 'col-lg-8',
])

@section('title', __('Register'))

@section('form')
    <form action="{{ route('register') }}" method="post" class="ajaxform_instant_reload">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-20">
                <label for="business_name" class="col-form-label required">{{ __('Business Name') }}</label>
                <input type="text" class="form-control focus-input100 required" name="business_name" id="business_name"
                    placeholder="{{ __('Enter your business name') }}" required>
            </div>
            <div class="col-md-6 mb-20">
                <label for="name" class="col-form-label required">{{ __('Full Name') }}</label>
                <input type="text" class="form-control focus-input100 required" name="name" id="name"
                    placeholder="{{ __('Your full name') }}" required>
            </div>
            <div class="col-md-6 mb-20">
                <label for="email" class="col-form-label required">{{ __('Email') }}</label>
                <input type="email" class="form-control focus-input100 required" name="email" id="email"
                    placeholder="{{ __('Your email address') }}" required>
            </div>
            <div class="col-md-6 mb-20">
                <label for="phone" class="col-form-label required">{{ __('Phone') }}</label>
                <input type="tel" class="form-control focus-input100 required" aria-describedby="phoneNumberHelp"
                    name="phone" id="phone" placeholder="{{ __('Your phone number') }}" required>
                <div id="phoneNumberHelp" class="form-text text-danger">
                    {{ __('The phone number must contain the country code: Example: +584145551212') }}</div>
            </div>

            <!--
            <div class="mb-20">
            <label for="country" class="col-form-label">{{ __('Country') }}</label>
            <select class="form-control focus-input100" name="country" id="country" required>
                @foreach ($countries as $id => $country)
    <option value="{{ $id }}">{{ $country }}</option>
    @endforeach
            </select>
            </div>
            -->

            @include('auth.signup_fields', [
                'signupFields' => $signupFields,
            ])
        </div>

        <div class="mb-40">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>
            <input type="password" class="form-control focus-input100" name="password" id="password"
                placeholder="{{ __('Type Password') }}" min="8" required autocomplete="new-password">
        </div>

        <div class="form-check form-check-inline mb-40">
            <input class="form-check-input" type="checkbox" name="agree" id="agree">
            <label class="form-check-label" for="agree">{!! __('agree_term_of_service_checkbox', ['url' => url('/terms')]) !!}</label>
        </div>

        <!-- Button -->
        <button type="submit" class="site-btn w-100 submit-btn">{{ __('Create Account') }}</button>
    </form>

    <!-- Other Sign Up -->
    <div class="other-sign-up-area text-center">
        <p>{{ __('Or Sign Up Using') }}</p>
        <span>{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></span>
    </div>
@endsection

@push('css')
    <style>
        #phoneNumberHelp {
            font-size: 11px;
        }

        label.required::after {
            content: '*';
            color: var(--bs-red);
        }
    </style>
@endpush

@push('script')
    <script>
        $('label.required')
            .prop('title', '{{ __('Required') }}')
    </script>
@endpush
