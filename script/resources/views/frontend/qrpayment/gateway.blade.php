@extends('layouts.user.blank')

@section('body')
    <div class="main-content">

        <div class="container pt-7 pb-5 mb-0">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="card bg-gradient-white">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <img src="{{ $gateway->logo }}" height="20" alt="{{ $gateway->name }}"/>
                                </div>
                            </div>
                            <div class="mt-4">
                                <table class="table table-bordered mb-4">
                                    <tbody class="list">
                                    <tr>
                                        <th>{{ __("Gateway Name") }}</th>
                                        <td>{{ $gateway->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Gateway Charge") }}</th>
                                        <td>
                                            {{ convert_money_direct($gateway->charge, $gateway->currency, user_currency(), true) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Gateway Currency") }}</th>
                                        <td>{{ $gateway->currency->name }} ({{ $gateway->currency->code }})</td>
                                    </tr>

                                    <tr>
                                        <th>{{ __("Amount") }}</th>
                                        <td>
                                            {{ convert_money_direct($amount, $user->currency, user_currency(), true) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('Total') }}</th>
                                        <td>
                                            @php
                                                $charge = convert_money_direct($gateway->charge, $gateway->currency, user_currency());
                                                $cAmount = convert_money_direct($amount, $user->currency, user_currency());
                                                $total = $charge + $cAmount;
                                            @endphp
                                            {{ currency_format(($cAmount + $charge), currency: user_currency()) }}
                                            @if($gateway->currency_id !== user_currency()->id)
                                                = {{ convert_money_direct($total, user_currency(), $gateway->currency, true) }}
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <form action="{{ route('frontend.qr.payment', [$user->qr, $gateway->id]) }}" method="post" role="form" class="form-light form">
                                    @csrf

                                    @unless(Auth::check())
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Your full name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Your email address" required>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($gateway->phone_required == 1)
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                                </div>
                                                <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone ?? null }}" class="form-control" placeholder="Your Phone Number" >
                                            </div>
                                        </div>
                                    @endif

                                    @if ($gateway->image_accept == 1)
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-image"></i></span>
                                                    </div>
                                                    <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/jpeg,image/jpg,image/png" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-sticky-note"></i></span>
                                                    </div>
                                                    <textarea name="comment" id="comment" class="form-control" placeholder="Payment Instruction"></textarea>
                                                </div>
                                            </div>
                                    @endif
                                    <button class="btn btn-block btn-dark">
                                        {{ __('Continue') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
