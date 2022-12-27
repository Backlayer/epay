@extends('layouts.backend.app', [
    'prev' => route('admin.deposits.index')
])

@section('title', __('Deposits'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th width="30%">
                                {{ __("User") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $deposit->user->name }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Gateway") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>
                                <img src="{{ $deposit->gateway->logo }}" alt="{{ $deposit->gateway->name }}" height="20">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Currency") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $deposit->currency->name }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Trx") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $deposit->trx }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Amount") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ convert_money_direct($deposit->amount, $deposit->currency, default_currency(), true) }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Charge") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ convert_money_direct($deposit->charge, $deposit->currency, default_currency(), true) }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Created At") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ formatted_date($deposit->created_at) }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Updated At") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ formatted_date($deposit->updated_at) }}</td>
                        </tr>
                        @if ($deposit->gateway->is_auto == 0)
                        <tr>
                            <th>
                                {{ __("Comment") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $deposit->meta['comment'] ?? '' }}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center">
                            @if ($deposit->gateway->is_auto == 0)
                            <h4>{{ __("Attachment") }}</h4>
                            <img class="img-fluid" src="{{ asset($deposit->meta['image'] ?? null) }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
