@extends('layouts.backend.app', [
    'prev' => route('admin.payments.qr-payment.show', [
        'qrPayment' => $qrPayment->id,
    ]),
])

@section('title', __('Qr Payment'))

<?php $quantity = 1; ?>

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row p-4 justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row align-self-start">
                            <span class="mx-4 mb-2 font-weight-bold">{{ __('Invoice No') }}:</span>
                            <span>{{ $qrPayment->invoice_no }}</span>
                        </div>
                        <div class="d-flex flex-row align-self-start">
                            <ul>
                                <li>
                                    <span class="mr-2 font-weight-bold">{{ __('Trx') }}:</span>
                                    {{ $qrPayment->trx ?? 'N/A' }}
                                </li>
                                <li>
                                    <span class="mr-2 font-weight-bold">{{ __('Status:') }}</span> {!! $qrPayment->PaymentStatus !!}
                                </li>
                                @if ($qrPayment->isPaid)
                                    <li>
                                        <span class="mr-2 font-weight-bold">{{ __('Paid At') }}:</span>
                                        {{ formatted_date($qrPayment->paid_at) }}
                                    </li>
                                @endif
                                <li>
                                    <span class="mr-2 font-weight-bold">{{ __('Created At') }}:</span>
                                    {{ formatted_date($qrPayment->created_at) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-self-start">
                        <div class="d-flex flex-row">
                            <span class="mx-4 mb-2 font-weight-bold">{{ __('Paid by Client') }}:</span>
                            <span>{{ $qrPayment->name ?? 'N/A' }}</span>
                        </div>
                        <div class="d-flex flex-row align-self-start">
                            <span class="mx-4 mb-2 font-weight-bold">{{ __('Contact Email') }}:</span>
                            <span>{{ $qrPayment->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-sm-center justify-content-md-center justify-content-lg-end">
                    <div class="p-4 w-50">
                        <table class="table table-borderless">
                            <caption></caption>

                            <tbody>
                                <tr>
                                    <th style="height:40px; width: 80px" class="text-right">
                                        {{ __('Amount') }}:
                                    </th>
                                    <td style="height:40px">
                                        {{ convert_money_direct($qrPayment->amount, $qrPayment->currency, default_currency(), true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="height:40px; width: 80px" class="text-right">
                                        {{ __('Charge') }}:
                                    </th>
                                    <td style="height:40px">
                                        {{ convert_money_direct($qrPayment->charge, $qrPayment->currency, default_currency(), true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="height:40px" class="text-right">
                                        {{ __('Total') }}:
                                    </th>
                                    <td style="height:40px">
                                        {{ convert_money_direct($qrPayment->amount, $qrPayment->currency, default_currency(), true) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($qrPayment->IsPaid)
                    @include('admin.payments.detailInformation', [
                        'gateway' => $qrPayment->gateway,
                        'payment' => $qrPayment,
                    ])
                @endif

                @if ($qrPayment->status_paid === '1')
                    <form action="{{ route('admin.payments.qr-payment.confirm', $qrPayment->id) }}" method="post"
                        class="ajaxform_instant_reload_after_confirm d-inline p-4">
                        @csrf

                        <button class="btn btn-success float-right submit-button submit-btn">
                            <i class="fas fa-check"></i>

                            {{ __('Confirm Payment') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
