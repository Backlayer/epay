@extends('layouts.backend.app', [
    'prev' => route('admin.orders.index')
])

@section('title', __('Orders details'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <h2>{{ $order->seller->meta['business_name'] ?? '' }}</h2>
                <h5 class="mb-0"><b>{{ __('Store') }}:</b> {{ optional($order->storefront)->name }}</h5>
                <small>{{ $order->seller->meta['address'] ?? '' }}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <small><b>{{ __('Invoice') }}</b> : #{{ $order->invoice_no }}</small>
            </div>
            <div class="col-sm-6 text-right">
                <small class="d-block"><b>{{ __('Date') }}</b> : {{ Carbon\Carbon::parse($order->created_at)->format('Y-m-d, H:i:s'); }}</small>
            </div>
        </div>
    </div>
    <div class="table-responsive pb-5">
        <table class="table table-flush">
            <thead>
                <tr class="text-center">
                    <th>{{ __('S/N') }}</th>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Product Type') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Quantity') }}</th>
                    <th>{{ __('Total Price') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderitems as $item)
                <tr class="text-center">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->product->name }}</h6></td>
                    <td>
                        <div class="badge badge-{{ $order->storefront->product_type ? 'future':'primary' }}">{{ $order->storefront->product_type ? 'Digital':'Physical' }}</div>
                    </td>
                    <td>{{ currency_format(optional($item->product)->price, currency:$order->currency) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ currency_format($item->quantity * optional($item->product)->price, currency:$order->currency) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h3 class="font-weight-bold">{{ __('Buyer Infos') }}</h3>
                <p><strong>{{ __('Name') }} : </strong> {{ $order->name }}</p>
                <p><strong>{{ __('Email') }} : </strong> {{ $order->email }}</p>
                <p><strong>{{ __('Phone') }} : </strong> {{ $order->phone }}</p>
            </div>
        </div>
        @if ($order->shipping)
        <div class="col-md-6">
            <div class="card-body">
                <h3 class="font-weight-bold">{{ __('Shipping infos') }}</h3>
                <p><strong>{{ __('Region') }} : </strong> {{ $order->shipping->region }}</p>
                <p><strong>{{ __('Charge') }} : </strong> {{ currency_format($order->shipping->amount, currency:$order->currency) }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
