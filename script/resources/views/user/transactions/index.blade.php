@extends('layouts.user.master')

@section('title', __('Transactions'))

@section('content')
    <div class="row mb-5">
        <div class="col text-right">
            <a href="{{ route('user.transactions.index') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions')])>
                <i class="fas fa-link"></i>
                {{ __("All Transactions") }}
            </a>
            <a href="{{ route('user.transactions.index', 'single-charge') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/single-charge')])>
                <i class="fas fa-link"></i>
                {{ __("Single Charge") }}
            </a>
            <a href="{{ route('user.transactions.index', 'invoice') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/invoice')])>
                <i class="fas fa-envelope"></i>
                {{ __("Invoice") }}
            </a>
            <a href="{{ route('user.transactions.index', 'qr-code') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/qr-code')])>
                <i class="fas fa-arrow-down"></i>
                {{ __("Qr Code") }}
            </a>
            <!--<a href="{{ route('user.transactions.index', 'website') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/website')])>
                <i class="fas fa-laptop"></i>
                {{ __("Website") }}
            </a>
            <a href="{{ route('user.transactions.index', 'donation') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/donation')])>
                <i class="fas fa-gift"></i>
                {{ __("Donation") }}
            </a>
            <a href="{{ route('user.transactions.index', 'deposit') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/deposit')])>
                <i class="fas fa-arrow-up"></i>
                {{ __("Deposit") }}
            </a>
            <a href="{{ route('user.transactions.index', 'plan') }}" @class(["latter-space-0 nav-link d-inline-block", "active" => Request::is('user/transactions/plan')])>
                <i class="fas fa-user"></i>
                {{ __("Your Subscriptions") }}
            </a>-->
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
@endsection
