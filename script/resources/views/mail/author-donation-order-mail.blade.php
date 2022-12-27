@component('mail::message')
# Hey {{ $order->donation->user->name }},

You are received a donation from <b>{{ $info['name'] }}</b>.

@component('mail::table')
|Title|Amount|Charge|Pay At|
|:------|:----:|:----:|:----:|
|{{ $order->donation->title }}|{{ currency_format($order->amount, currency:$order->currency) }}|{{ currency_format($order->charge, 'icon', $order->currency->symbol) }}|{{ formatted_date($order->created_at) }}|
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
