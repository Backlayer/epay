@extends('layouts.frontend.master')

@section('body')
    <!-- Donation Area -->
    <div class="donation-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="col-12">
                        <div class="breadcrumb-text mb-50 d-flex justify-content-between align-items-center">
                            <a class="back-home-title" href="{{ url('/') }}">
                                <i class="fas fa-long-arrow-alt-left"></i>
                                {{ __('Back To Home') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-4">
                    <div class="single-donation-area">
                        <div class="donation-image">
                            <img src="{{ asset($donation->image) }}" alt="">
                        </div>
                        <div class="donation-text">
                            <h5>{{ $donation->title }}</h5>
                            <span class="donation-time">{{ __("(by :name on :dateTime)", ['name' => $donation->user->name, 'dateTime' => formatted_date($donation->created_at, 'h:i A, d M, Y')]) }}
                            </span>
                            <h2>
                                {!! __(":amount GOAL", ['amount' => '<span>'.currency_format($donation->amount, currency: $donation->currency).'</span>']) !!}
                            </h2>
                            <div class="progressbar-area mb-30">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $goalCompleted }}%;" aria-valuenow="{{ $goalCompleted }}"
                                         aria-valuemin="0" aria-valuemax="100">{{ __(':percentage %', ['percentage' => round($goalCompleted, 2)]) }}</div>
                                </div>
                            </div>

                            <h6>{{ __(":raised Raised, Donations (:donations)", ['raised' => currency_format($raisedAmount + $raisedAmountCharge, currency: $donation->currency), 'donations' => $donation->orders_count]) }}</h6>
                            <p>{{ $donation->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="donation-form-area">
                        <label for="exampleInputEmail1" class="donate-title"> {{ $donation->title }}</label>

                        <form action="{{ route('frontend.donation.gateway', [$donation->uuid]) }}" method="post" class="init_form_validation">
                            @csrf
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">{{ $donation->currency->symbol }}</span>
                                    <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="{{ max(round($donation->amount - ($raisedAmount + $raisedAmountCharge), 2), 0) }}" required>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                @foreach($gateways as $gateway)
                                    <div class="col-md-4">
                                        <div class="custom-control custom-radio image-checkbox" data-required="{{ __('Please Select A Gateway') }}">
                                            <input type="radio" name="gateway" id="{{ str($gateway->name)->slug('_') }}" value="{{ $gateway->id }}" class="custom-control-input" required>
                                            <label class="custom-control-label" for="{{ str($gateway->name)->slug('_') }}">
                                                <img src="{{ $gateway->logo }}" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-12">
                                <div class="button-area text-center">
                                    <button type="submit" class="btn dtn-btn w-100">
                                        {{ __('Pay Now') }}
                                    </button>
                                </div>
                            </div>
                        </form>


                        <!-- Donars Area -->
                        <div class="col-12">
                            <div class="donars-area">
                                <h4>{{ __('Donors List:') }}</h4>
                                @foreach($orders as $order)
                                    <!-- Single Donors -->
                                    <div class="single-donors-area d-flex align-items-center">
                                        <!-- Gift Area -->
                                        <div class="gift-area-img">
                                            @if($order->is_anonymous)
                                                <img src="{{ asset('uploads/user.png') }}" alt="">
                                            @elseif($order->donor)
                                                <img src="{{ avatar($order->donor) }}" alt="">
                                            @else
                                                <img src="{{ get_gravatar($order->email) }}" alt="">
                                            @endif
                                        </div>
                                        <!-- Gift Text -->
                                        <div class="gift-text">
                                            <h6>
                                                @if($order->is_anonymous)
                                                    {{ __('Anonymous') }}
                                                @else
                                                    {{ $order->name }}
                                                @endif
                                            </h6>
                                            <span>
                                                {{ __(':amount - :datetime', [
                                                    'amount' => currency_format($order->amount + $order->charge, currency: $donation->currency),
                                                    'datetime' => formatted_date($order->created_at, 'h:i A d M, Y')
                                                ])}}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mt-3">
                                    {{ $orders->links('vendor/pagination/bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Donation Area -->
@endsection
