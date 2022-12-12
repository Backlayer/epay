@component('mail::message')
Hey <b>{{ $info['name'] }}</b>,
We’ve confirmed your payment.

Here is your payment information

@component('mail::table')
|Title|Amount|Charge|Pay At|
|:------|:----:|:----:|:----:|
|{{ $order->donation->title }}|{{ currency_format($order->amount, 'icon', $order->currency->symbol) }}|{{ currency_format($order->charge, 'icon', $order->currency->symbol) }}|{{ formatted_date($order->created_at) }}|
@endcomponent

@if(Auth::check())
@component('mail::button', ['url' => route('user.transactions.index', 'donation')])
More Information
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
