@extends('layouts.backend.app')

@section('title', __('Transactions'))

@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Transactions') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-0 total-transactions">
                            <img src="{{ asset('user/img/loading.svg') }}" height="40" class="loading mb-3 mt-1">

                            <b class="font-weight-bold count d-none"></b>
                            <p class="font-weight-bold sum d-none"></p>
                        </div>
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
                        <h4>{{ __('Credit Transactions') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-0 credit-transactions">
                            <img src="{{ asset('user/img/loading.svg') }}" height="40" class="loading mb-3 mt-1">

                            <b class="font-weight-bold count d-none"></b>
                            <p class="font-weight-bold sum d-none"></p>
                        </div>
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
                        <h4>{{ __('Debit Transactions') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-0 debit-transactions">
                            <img src="{{ asset('user/img/loading.svg') }}" height="40" class="loading mb-3 mt-1">

                            <b class="font-weight-bold count d-none"></b>
                            <p class="font-weight-bold sum d-none"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Transactions') }}</h4>
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
                                    <th>{{ __('TRX') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Currency') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                            class="btn btn-primary btn-sm">
                                            {{ $transaction->invoice_no ?? 'NA' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/customers', $transaction->user_id) }}">
                                            {{ $transaction->user->name ?? null }}
                                        </a>
                                    </td>
                                    <td>{{ $transaction->currency->name }}</td>
                                    <td>{{ convert_money_direct($transaction->amount, $transaction->currency, default_currency(), true) }}
                                    </td>
                                    <td>{{ convert_money_direct($transaction->charge, $transaction->currency, default_currency(), true) }}
                                    </td>
                                    <td>
                                        @if ($transaction->type == 'credit')
                                            <span class="badge badge-success">{{ __('Credit') }}</span>
                                        @elseif($transaction->type == 'debit')
                                            <span class="badge badge-danger">{{ __('Debit') }}</span>
                                        @else
                                            {{ __('Other') }}
                                        @endif
                                    </td>
                                    <td>{{ formatted_date($transaction->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{ $transactions->links('vendor/pagination/bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-transaction-url" value="{{ route('admin.get-transaction') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js?v=' . config('app.version')) }}"></script>
    <script>
        "use strict";
        getTotalTransactions()
    </script>
@endpush
