@component('mail::message')
# Hi {{ $info['name'] }},

We confirm that are we have received your payment

## Issue Date: {{ formatted_date($invoice->created_at) }}
## Due Date: {{ formatted_date($invoice->due_date) }}
## Payment Status: {{ $invoice->is_paid ? 'Paid':"Unpaid" }}

@component('mail::table')
|Item|Amount|Quantity|
|:--:|:----:|:------:|
|{{ $invoice->item_name }}|{{ $invoice->amount }}|{{ $invoice->quantity }}|
@endcomponent


@if($invoice->note)
## Note:

{{ $invoice->note }}
@endif

## Sub Total: {{ $subTotal }}
## Discount: {{ $invoice->discount }}%
## Tax: {{ $invoice->tax }}%
## Total: {{ $total }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
