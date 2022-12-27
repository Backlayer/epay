@extends('layouts.user.blank')

@section('title', __('Pricing'))

@section('body')
    <div class="main-content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __("Plan Information") }}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mb-5">
                                    <tbody>
                                    <tr>
                                        <th>{{ __("Plan") }}</th>
                                        <td>{{ $plan->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("From") }}</th>
                                        <td>{{ $plan->owner->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Duration") }}</th>
                                        <td>{{ $plan->interval }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <h4>{{ __("Features") }}</h4>
                                <ul class="list-group">
                                    @foreach($plan->features as $feature)
                                        <li class="list-group-item">
                                            <i class="fas fa-check"></i>
                                            {{ $feature['title'] ?? null }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('frontend.plan.payment', [$plan->uuid]) }}" method="post" class="ajaxform_instant_reload_after_confirm">
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

                                    <div class="form-group">
                                        <label for="amount">{{ __('Price') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-future">{{ user_currency()->symbol }}</span>
                                            </div>
                                            <input class="form-control" type="number" name="amount" value="{{ convert_money_direct($plan->amount, $plan->currency, user_currency(), numberFormat: true) }}" @if($plan->amount) readonly @endif>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="auto_renew" class="required">{{ __('Auto Renew') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-future">
                                                    <i class="fas fa-redo"></i>
                                                </span>
                                            </div>
                                            <select name="auto_renew" id="auto_renew" class="form-control" required>
                                                <option value="0">{{ __('No') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if(Auth::check())
                                        <button class="btn btn-dark w-100 submit-btn" data-message="{{ __("Are you sure to subscribe this plan?") }}">
                                            {{ __('Subscribe Now') }}
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-dark w-100">
                                            <i class="fas fa-door-open"></i> {{ __("Login") }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
