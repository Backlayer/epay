@extends('layouts.user.blank')

@section('title', __($order->website->merchant_name))

@section('body')
    <div class="container ">
        <div class="row justify-content-center mt-3 align-items-center h-100vh">
            <div class="col-md-6">
                @if($order->paid_at)
                <div class="card">
                    <div class="card-body">
                        <div class="p-5 text-center">
                            {{ __('Transaction already paid') }}
                        </div>
                    </div>
                </div>
                @else
                <form action="{{ route('frontend.merchant.gateway', [$website->id, $order->uuid]) }}" method="post" class="init_form_validation">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="card bg-gradient-danger border-0">
                                <!-- Card body -->
                                <div class="card-body pb-0">
                                    <div class="row align-items-center">
                                        <div class="col d-flex gap-5 align-items-center">
                                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                @if(Auth::check())
                                                    <img src="{{ avatar() }}" alt="" class="rounded-circle" width="50">
                                                @else
                                                    <i class="fas fa-user"></i>
                                                @endif
                                            </div>
                                            <div class="ml-3">
                                                @if(Auth::check())
                                                    <h2 class="text-white">{{ Auth::user()->name }}</h2>
                                                    <p class="text-white">
                                                        <span>@</span>{{ Auth::user()->username }}
                                                    </p>
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

                                    <div class="row mt-5">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 class="card-title">
                                                        <ul class="list-unstyled">
                                                            <li>{!! __("Merchant: :merchant", ['merchant' => $order->website->merchant_name]) !!}</li>
                                                            <li>{!! __("Amount: :amount", ['amount' => currency_format($order->amount, currency: $order->currency)]) !!}</li>
                                                            <li>{!! __("Quantity: :quantity", ['quantity' => $order->quantity]) !!}</li>
                                                            <li>{!! __("Total: :total", ['total' => currency_format($order->amount * $order->quantity, currency: $order->currency)]) !!}</li>
                                                        </ul>

                                                    </h2>
                                                    <small>{{ __('by :name on :datetime', ['name' => $order->user->business_name ?? $order->user->name, 'datetime' => formatted_date($order->created_at, 'h:i A - d M, Y')]) }}</small>
                                                    <p>{{ $order->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if(!$website->mode)
                                        <div class="alert alert-danger text-center">
                                            <strong>{{ __('Test Mode') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row align-items-center">
                                @foreach($gateways as $gateway)
                                    <div class="col-md-4">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" name="gateway" id="{{ str($gateway->name)->slug('_') }}" value="{{ $gateway->id }}" class="custom-control-input" required>
                                            <label class="custom-control-label" for="{{ str($gateway->name)->slug('_') }}">
                                                <img src="{{ $gateway->logo }}" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="btn btn-dark">
                                {{ __('Pay Now') }}
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
