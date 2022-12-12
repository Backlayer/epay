@extends('layouts.user.master')

@section('title', __('Orders'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('View order') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.orders.index') }}" class="btn btn-sm btn-neutral">
        <i class="fa fa-list" aria-hidden="true"></i>
        {{ __('Orders list') }}
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>{{ auth()->user()->meta['business_name'] ?? '' }}</h2>
                    <h5 class="mb-0"><b>{{ __('Store') }}:</b> {{ optional($order->storefront)->name }}</h5>
                    <small>{{ auth()->user()->meta['address'] ?? '' }}</small>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <small><b>{{ __('Invoice') }}</b> : #{{ $order->invoice_no }}</small>
                </div>
                <div class="col-sm-6 text-right">
                    <small class="d-block"><b>{{ __('Date') }}</b> : {{ Carbon\Carbon::parse($order->created_at)->format('Y-m-d, H:i:s') }}</small>
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
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->quantity * $item->product->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
