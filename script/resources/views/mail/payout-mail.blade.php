@component('mail::message')
<h1 style="text-align: center; color: #6777ef;">@lang('Payout request from') {{ env('APP_NAME') }}</h1>

<table style="width: 100%; border: 1px solid #000">
    <thead style="background: rgb(248,249,250); padding: 10px 0;">
        <tr>
            <th>{{ __('User name') }}</th>
            <th>{{ __('User email') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Charge') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{{ $options['name'] }}</th>
            <th>{{ $options['email'] }}</th>
            <th>{{ $options['amount'] }}</th>
            <th>{{ $options['charge'] }}</th>
        </tr>
    </tbody>
</table>
@endcomponent
