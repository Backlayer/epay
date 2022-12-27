@component('mail::message')
# Hi {{ $options['order']->seller_name }}
New purchase order from, {{ $options['user_name'] ?? null }}
<br>
#Invoice No <b>{{ $options['order']->invoice_no }}</b>
<br><br>
<p><strong>{{ __('Data : ') }}</strong> {{ Carbon\Carbon::parse($options['order']->created_at)->format('Y-m-d, H:i:s A'); }}</p>
<table role="presentation" style="width:100%;border-collapse:collapse;border-spacing:0;background:#ffffff;">
    <thead>
        <tr>
            <th align="center">{{ __('S/N') }}</th>
            <th align="center">{{ __('Product') }}</th>
            <th align="center">{{ __('Price') }}</th>
        </tr>
    </thead>
    <body>
        @foreach ($options['order']->orderitems as $item)
        <tr>
            <td align="center">{{ $loop->index+1 }}</td>
            <td align="center">{{ $item->product->name }}</h6></td>
            <td align="center">{{ $item->product->price }}</td>
        </tr>
        @endforeach
    </body>
</table>
<br><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
