@extends('layouts.backend.app', [
    'prev' => route('admin.transactions.index')
])

@section('title', __('Transaction'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th width="30%">
                                {{ __("Receiver") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $transaction->user->name }}</td>
                        </tr>
                        <tr>
                            <th width="30%">
                                {{ __("Sender") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>
                                {{ $transaction->name }}<br>
                                {{ $transaction->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Currency") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $transaction->currency->name }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Amount") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>
                                {{ convert_money_direct($transaction->amount, $transaction->currency, default_currency(), true) }}
                                @if($transaction->type == 'credit')
                                    <span class="badge badge-success">{{ __('Credit') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Debit') }}</span>
                                @endif
                            </td>
                        </tr>
                        @if($transaction->type == 'credit')

                            <tr>
                                <th>
                                    {{ __("Charge") }}
                                    <span class="float-right">:</span>
                                </th>
                                <td>{{ convert_money_direct($transaction->charge, $transaction->currency, default_currency(), true) }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>
                                {{ __("Reason") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ $transaction->reason }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Created At") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ formatted_date($transaction->created_at) }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Updated At") }}
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ formatted_date($transaction->updated_at) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
