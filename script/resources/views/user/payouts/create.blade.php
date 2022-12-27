@extends('layouts.user.master')

@section('title', __('Otp for payout request'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Otp for payout request') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.payouts.index') }}" class="btn btn-sm btn-neutral">
        <i class="fa fa-eye" aria-hidden="true"></i>
        {{ __('Withdraw List') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-header text-left">
                    <h5 class="text-primary">
                        <a class="btn btn-primary btn-sm rounded-pill" href="{{ route('user.payouts.index') }}"><i class="fa fa-backward" aria-hidden="true"></i> {{ __('Back') }}</a>
                    </h5>
                </div>
                <div class="card-body">
                    <h3>{{ __('An OTP has been sent to your mail. Please check and confirm.') }}</h3>
                    <form action="{{ route('user.payouts.update', 'update') }}" method="post"
                        class="ajaxform_instant_reload mb-5">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="input-group input-group-merge">
                                <input type="number" class="form-control" name="otp" placeholder="{{ __('OTP') }}" required>
                                <div class="input-group-append">
                                    <button class="input-group-text">{{ __('Confirm') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @php
                        $payout_amount = session('payout_amount');
                        $plan_charge = session('plan_charge');
                        $payout_charge = session('payout_charge');
                        $available_amount = $payout_amount - $payout_charge;
                    @endphp
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Current balance is') }}</h4>
                        <h4 class="font-weight-bold"> {{  currency_format(auth()->user()->wallet ,currency:user_currency()) }} </h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Payout request amount') }}</h4>
                        <h4 class="font-weight-bold">{{  currency_format($payout_amount ,currency:user_currency()) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Total charge') }}</h4>
                        <h4 class="font-weight-bold">{{  currency_format($payout_charge ,currency:user_currency()) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Receivable amount') }}</h4>
                        <h4 class="font-weight-bold">{{  currency_format($available_amount ,currency:user_currency()) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
