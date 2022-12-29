@extends('layouts.user.blank')

@section('title', $user->business_name ?? $user->name)

@section('body')
<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <form action="{{ route('frontend.qr.gateway', $user->qr) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-5">
                                    <a href="#!" class="avatar avatar-xl rounded-circle shadow mb-5">
                                        <img alt="{{ $user->business_name ?? $user->name }}" src="{{ $user->logo ?? avatar($user) }}">
                                    </a>

                                    <h3 class="font-weight-600">
                                        {{ $user->business_name ?? $user->name }}
                                    </h3>
                                </div>

                                <div class="card bg-gradient-danger border-0">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                    @if(Auth::check())
                                                    <img src="{{ avatar() }}" alt="" class="rounded-circle" width="50">
                                                    @else
                                                    <i class="fas fa-user"></i>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                @if(Auth::check())
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                                                    {{ __('My Wallet') }}
                                                </h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">
                                                    {{ currency_format(Auth::user()->wallet, currency: user_currency()) }}
                                                </span>
                                                @else
                                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                                                        {{ __('Hello, Guest') }}
                                                    </h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-future">{{ $user->currency->symbol }}</span>
                                        </div>
                                        <input class="form-control" type="number" name="amount" value="" required step="any" min="0.1" placeholder="{{ __("Enter amount") }}">
                                    </div>
                                </div>

                                @include('payment.gatewayList', [
                                    'is_paid' => false,
                                    'gateways' => $gateways
                                ])
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
