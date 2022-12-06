@component('mail::message')
# Hi {{ $options['user_name'] }}
<h2 style="text-align: center">{{ $options['store']->name }}</h2>
<small style="text-align: center; display: block">{{ $options['address'] }}</small>
<br><br>
# Invoice No {{ $options['order']->invoice_no }}
<table role="presentation" style="width:100%;border-collapse:collapse;border-spacing:0;background:#ffffff;">
    <thead>
        <tr>
            <th align="center">{{ __('S/N') }}</th>
            <th align="center">{{ __('Product') }}</th>
            <th align="center">{{ __('Price') }}</th>
            @if ($options['store']->product_type == 1)
            <th align="center">{{ __('Download Link') }}</th>
            @endif
        </tr>
    </thead>
    <body>
        @foreach ($options['order']->orderitems as $item)
        <tr>
            <td align="center">{{ $loop->index+1 }}</td>
            <td align="center">{{ $item->product->name }}</h6></td>
            <td align="center">{{ $item->product->price }}</td>
            @if ($options['store']->product_type == 1)
            <td align="center">
                <a class="add_to_cart" href="{{ $item->product->link }}">{{ __("Download") }}</a>
            </td>
            @endif
        </tr>
        @endforeach
    </body>
</table>
<br><br>
Thanks for purchasing,<br>
{{ config('app.name') }}
@endcomponent
