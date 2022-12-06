@component('mail::message')
Hi {{ $order->website->merchant_name }},


You are received a payment from <b>{{ $order->first_name .' '. $order->last_name }}</b>

@component('mail::table')
|Amount|Quantity|Total|Paid At|
|:----:|:------:|:---:|:-----:|
|{{ $order->amount }}|{{ $order->quantity }}|{{ currency_format($order->amount * $order->quantity, currency: $order->currency) }}|{{ formatted_date($order->paid_at, 'h:i A - d M, Y') }}|
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
