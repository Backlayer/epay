@component('mail::message')
# Hello

<strong>Issue Date:</strong> {{ formatted_date($invoice->created_at) }}<br>
<strong>Due Date:</strong> {{ formatted_date($invoice->due_date) }}<br>
<strong>Payment Status:</strong> {{ $invoice->is_paid ? 'Paid':"Unpaid" }}<br>

@component('mail::table')
|Item|Amount|Quantity|Sub Total|
|:--:|:----:|:------:|:-------:|
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

@component('mail::button', ['url' => route('frontend.invoice.index', $invoice->uuid)])
Pay Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
