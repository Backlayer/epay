@extends('layouts.user.blank')

@section('title', $singleCharge->title)

@section('body')
<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <form action="{{ route('frontend.single-charge.gateway', [$singleCharge->uuid]) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
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

                                <h4 class="card-title font-weight-bold mb-2">
                                    {{ str($singleCharge->title)->upper() }}
                                </h4>

                                <div class="mb-2">
                                    <small>{!! __("by :name at :datetime", ['name' => '<b>'.$singleCharge->user->name.'</b>', 'datetime' => '<b>'.formatted_date($singleCharge->created_at, 'd M, Y - h:i A').'</b>']) !!}</small>
                                </div>

                                <p class="mb-3">{{ $singleCharge->description }}</p>

                                <div class="form-group text-center">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-future">{{ $singleCharge->user->currency->symbol  }}</span>
                                        </div>
                                        <input class="form-control" type="number" name="amount" value="{{ number_format($singleCharge->amount, 2) }}" step="any" min="0.1" @if($singleCharge->amount > 0) readonly @endif>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control" type="text" name="customer_name" value="{{ $singleCharge->customer_name }}" @if($singleCharge->customer_name) readonly @endif>
                                    </div>
                                </div>

                                @include('payment.gatewayList', [
                                    'is_paid' => $singleCharge->IsPaid,
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
