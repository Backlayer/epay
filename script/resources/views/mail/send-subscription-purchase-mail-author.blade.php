@component('mail::message')
# Hi, {{ $subscriber->owner->name }}

@if(!$isRenewal)
You have a new subscriber.
@endif

Here is your subscription information

@component('mail::table')
|&nbsp;|&nbsp;|
|:-----|:-----|
|Plan|{{ $subscriber->plan->name }}|
|From|{{ $subscriber->plan->owner->name }}|
|Duration|{{ $subscriber->plan->interval }}|
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
