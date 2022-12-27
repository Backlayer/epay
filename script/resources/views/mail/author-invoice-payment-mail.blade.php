@component('mail::message')
# Hi {{ $invoice->owner->name }},

<b>{{ $userInfo['name'] }}</b> send you a payment

## Issue Date: {{ formatted_date($invoice->created_at) }}
## Due Date: {{ formatted_date($invoice->due_date) }}
## Payment Status: {{ $invoice->is_paid ? 'Paid':"Unpaid" }}

@component('mail::table')
|Invoice|Amount|Quantity|
|:--:|:----:|:------:|
@foreach($invoice->items as $item)
|{{ $item->name }}|{{ currency_format($item->amount, currency: $invoice->currency) }}|{{ $item->quantity }}|{{ currency_format($item->subtotal, currency: $invoice->currency) }}|
@endforeach
@endcomponent


@if($invoice->note)
## Note:

{{ $invoice->note }}
@endif

<hr>
<strong>Sub Total:</strong> {{ $subTotal }}
<strong>Discount:</strong> {{ $invoice->discount }}%
<strong>Tax:</strong> {{ $invoice->tax }}%
<strong>Total:</strong> {{ $total }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
