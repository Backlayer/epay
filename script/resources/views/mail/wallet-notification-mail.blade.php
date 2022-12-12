@component('mail::message')
# Hi, {{ $subscription->subscriber->name }}

You have insufficient balance to renew this plan, and subscription plan will expire at : {{ formatted_date($subscription->expire_at) }}.

@component('mail::table')
|&nbsp;|&nbsp;|
|:-----|:-----|
|Plan|{{ $subscription->plan->name }}|
|From|{{ $subscription->plan->owner->name }}|
|Duration|{{ $subscription->plan->interval }}|
|Auto Renew|{{ $subscription->is_auto_renew ? 'Yes' : 'No' }}|
@endcomponent

@component('mail::button', ['url' => route('user.deposits.index')])
Deposit Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
