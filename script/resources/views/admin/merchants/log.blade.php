@extends('layouts.backend.app')

@section('title', __('Transaction Logs'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("From") }}</th>
                                <th>{{ __("IP Address") }}</th>
                                <th>{{ __("Amount") }}</th>
                                <th>{{ __("Charge") }}</th>
                                <th>{{ __("Quantity") }}</th>
                                <th>{{ __("Ref ID") }}</th>
                                <th>{{ __("Gateway") }}</th>
                                <th>{{ __("Payment Status") }}</th>
                                <th>{{ __("Paid At") }}</th>
                                <th>{{ __("Created At") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($merchant->orders as $order)
                                <tr>
                                    <td>{{ $order->website->merchant_name }}</td>
                                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                    <td>{{ $order->ip_address }}</td>
                                    <td>{{ convert_money_direct($order->amount, $order->currency, default_currency(), true) }}</td>
                                    <td>{{ convert_money_direct($order->charge, $order->currency, default_currency(), true) }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->reference_code }}</td>
                                    <td>
                                        @if($order->gateway)
                                            <img src="{{ $order->gateway->logo }}" alt="{{ $order->gateway->name }}" height="20">
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->payment_status)
                                            <span class="badge badge-success">{{ __("Paid") }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __("Failed") }}</span>
                                        @endif
                                    </td>
                                    <td>{{ formatted_date($order->paid_at) }}</td>
                                    <td>{{ formatted_date($order->created_at) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
