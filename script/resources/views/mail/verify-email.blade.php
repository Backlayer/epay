@component('mail::message')

# @lang('Hello!') {{ $user->name }}

Thank you for registering!.

Please click the button below to verify your email address.

@component('mail::button', ['url' => $url])
Verify Email Adddress
@endcomponent

@isset($user->passw)

<hr>

<h2 style="color: #6777ef;">@lang('Your credentials are:')</h2>
@lang('Email'): {{ $user->email }}<br>
@lang('Password'): {{ $user->passw }}

## @lang('Keep in mind that you should not share this data and you must keep it in a safe place, you are responsible for its use.')

@endisset

<hr>

@lang("If you're having trouble clicking the \"Verify Email Address\" button, copy and paste the URL below into your web browser"): 
{{ $url }}

Regards,<br>
{{ config('app.name') }}

@endcomponent
