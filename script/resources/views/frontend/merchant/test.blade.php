@extends('layouts.user.blank')

@section('title', __("Test Payment"))

@section('body')
    <div class="main-content">
        <div class="container pt-7 pb-5 mb-0">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="card bg-gradient-white">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <img src="{{ $gateway->logo }}" height="20" alt="{{ $gateway->name }}"/>
                                </div>
                            </div>
                            <div class="mt-4">
                                <table class="table table-bordered mb-4">
                                    <tbody class="list">
                                    <tr>
                                        <th>{{ __("Gateway Name") }}</th>
                                        <td>{{ ucwords($gateway->name) }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Gateway Currency") }}</th>
                                        <td>{{ $gateway->currency->name }} ({{ $gateway->currency->code }})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Amount") }}</th>
                                        <td>
                                            @if($order->currency_id !== $gateway->currency_id)
                                                {{ currency_format($amount, currency: $order->currency) }}  =
                                            @endif
                                            {{ convert_money_direct($amount, $order->currency, $gateway->currency, true) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Gateway Charge") }}</th>
                                        <td>
                                            {{ currency_format($gateway->charge, currency: $gateway->currency) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('Total') }}</th>
                                        <td>
                                            @php
                                                $order->amountForGateway = convert_money_direct($amount, $order->currency, $gateway->currency);
                                            @endphp
                                            {{ currency_format($gateway->charge + $order->amountForGateway, currency: $gateway->currency) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <form action="{{ route('frontend.payment.test', [$website->id, $order->uuid, $gateway->id]) }}" method="post" id="submitPaymentForm">
                                    @csrf
                                    <input type="radio" name="status" id="cancel" onchange="document.getElementById('submitPaymentForm').submit()" value="cancel" hidden>
                                    <input type="radio" name="status" id="success" onchange="document.getElementById('submitPaymentForm').submit()" value="success" hidden>

                                    <div class="d-flex justify-content-between">
                                        <label for="cancel" class="btn btn-danger" style="cursor: pointer">{{ __("Cancel") }}</label>
                                        <label for="success" class="btn btn-primary" style="cursor: pointer">{{ __("Success") }}</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
