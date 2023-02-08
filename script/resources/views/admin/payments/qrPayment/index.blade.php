@extends('layouts.backend.app')

@section('title', __('Qr Payment'))

@section('content')

    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Qr Payment') }}</h4>
                    </div>
                    <div class="card-body total-qr-payments">
                        <img src="{{ asset('user/img/loading.svg') }}" height="40" class="loading mb-2 mt-1">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Paid Qr Payment') }}</h4>
                    </div>
                    <div class="card-body paid-qr-payments">
                        <img src="{{ asset('user/img/loading.svg') }}" height="40" class="loading mb-2 mt-1">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Confirmed Qr Payment') }}</h4>
                    </div>
                    <div class="card-body confirmed-qr-payments">
                        <img src="{{ asset('user/img/loading.svg') }}" height="40" class="loading mb-2 mt-1">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Qr Payments') }}</h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="{{ __('Search by user') }}" value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Merchant') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Currency') }}</th>
                                    <th>{{ __('Payment Status') }}</th>
                                    <th>{{ __('Created') }}</th>
                                    <th>{{ __('Updated') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qrPayments as $qrPayment)
                                    <tr>
                                        <td>
                                            <a href="{{ url('admin/customers/' . $qrPayment->seller->id) }}">
                                                {{ $qrPayment->seller->business_name ?? ($qrPayment->seller->name ?? __('Deleted')) }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ convert_money_direct($qrPayment->amount, $qrPayment->currency, default_currency(), true) }}
                                        </td>
                                        <td>{{ $qrPayment->currency->name }}</td>
                                        <td>{!! $qrPayment->PaymentStatus !!}</td>
                                        <td>{{ formatted_date($qrPayment->created_at) }}</td>
                                        <td>{{ formatted_date($qrPayment->updated_at) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.payments.qr-payment.show', $qrPayment->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $qrPayments->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="get-qr-payment-url" value="{{ route('admin.payments.qr-payment') }}">
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js?v=' . config('app.version')) }}"></script>
    <script>
        "use strict";
        getTotalQrPayment()
    </script>
@endpush
