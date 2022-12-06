@component('mail::message')
# You have an system error: please contact with software provider.

{{ $message }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
