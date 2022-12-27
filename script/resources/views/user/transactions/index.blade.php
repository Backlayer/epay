@extends('layouts.user.master')

@section('title', __('Transactions'))

@section('content')
    <div class="row mb-5">
        <div class="col text-center">
            <a href="{{ route('user.transactions.index') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions')])>
                <i class="fas fa-link"></i>
                {{ __("All Transactions") }}
            </a>
            <a href="{{ route('user.transactions.index', 'single-charge') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/single-charge')])>
                <i class="fas fa-link"></i>
                {{ __("Single Charge") }}
            </a>
            <a href="{{ route('user.transactions.index', 'donation') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/donation')])>
                <i class="fas fa-gift"></i>
                {{ __("Donation") }}
            </a>
            <a href="{{ route('user.transactions.index', 'qr-code') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/qr-code')])>
                <i class="fas fa-arrow-down"></i>
                {{ __("Qr Code") }}
            </a>
            <a href="{{ route('user.transactions.index', 'invoice') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/invoice')])>
                <i class="fas fa-envelope"></i>
                {{ __("Invoice") }}
            </a>
            <a href="{{ route('user.transactions.index', 'deposit') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/deposit')])>
                <i class="fas fa-arrow-up"></i>
                {{ __("Deposit") }}
            </a>
            <a href="{{ route('user.transactions.index', 'website') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/website')])>
                <i class="fas fa-laptop"></i>
                {{ __("Website") }}
            </a>
            <a href="{{ route('user.transactions.index', 'plan') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/plan')])>
                <i class="fas fa-user"></i>
                {{ __("Your Subscriptions") }}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-transactions">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Transactions') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 credit-transactions">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Credit Transactions') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 debit-transactions">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Debit Transactions') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h4>{{ __("Transactions") }}</h4>
            <form class="card-header-form">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Search...") }}">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive py-3">
                @if(is_null($type))
                    @include('user.transactions._all')
                @elseif($type == 'single-charge')
                    @include('user.transactions._single_charge')
                @elseif($type == 'donation')
                    @include('user.transactions._donation')
                @elseif($type == 'qr-code')
                    @include('user.transactions._qr_code')
                @elseif($type == 'invoice')
                    @include('user.transactions._invoice')
                @elseif($type == 'deposit')
                    @include('user.transactions._deposit')
                @elseif($type == 'website')
                    @include('user.transactions._website')
                @elseif($type == 'plan')
                    @include('user.transactions._plan')
                @endif
            </div>
        </div>
    </div>
    <input type="hidden" id="get-transaction-url" value="{{ route('user.get-transaction') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        getTotalTransactions()
    </script>
@endpush
