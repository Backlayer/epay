@component('mail::message')
Hi, {{ $subscriber->subscriber->name }}

@if($isRenewed)
Here is your subscription renewal information
@else
Here is your subscription information
@endif

@component('mail::table')
|&nbsp;|&nbsp;|
|:-----|:-----|
|Plan|{{ $subscriber->plan->name }}|
|From|{{ $subscriber->plan->owner->name }}|
|Duration|{{ $subscriber->plan->interval }}|
@endcomponent

@component('mail::button', ['url' => route('user.transactions.index', 'plan')])
Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
