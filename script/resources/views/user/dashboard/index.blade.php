@extends('layouts.user.app')

@section('title', __('Transactions Log'))

@section('content')
    <div class="row">
        <div class="col-md-8">
            <!--<div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>{{ __('API Documentation') }}</h4>
                            <p class="text-base">{{ __('Our documentation contains what you need to integrate Boompay in your website.') }}</p>
                            <a href="{{ route('user.websites.documentation') }}" class="mt-2 btn btn-outline-primary btn-sm"><i class="fas fa-file-alt"></i> {{ __('Go to Docs') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>{{ __('Your Keys') }}</h4>
                            <p>{{ __('Also available in') }} <a href="{{ url('/user/api-keys') }}" class="text-primary">{{ __('Settings > API Keys') }}</a></p>

                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text rounded-0">{{ __('PUBLIC KEY') }}</span>
                                <input type="text" class="form-control" id="public_key" value="{{ Auth::user()->public_key }}">
                                <button class="input-group-text rounded-0 clipboard-button" data-clipboard-target="#public_key" data-message="{{ __(':name copied to clipboard', ['name' => __('Public Key')]) }}">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>

                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text rounded-0">{{ __('SECRET KEY') }}</span>
                                <input type="text" class="form-control" id="secret_key" value="{{ Auth::user()->secret_key }}">
                                <button class="input-group-text rounded-0 clipboard-button" data-clipboard-target="#secret_key" data-message="{{ __(':name copied to clipboard', ['name' => __('Secret Key')]) }}">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            @if ($transactions->count() > 0)
            <div class="card mt-4">
                <div class="table-responsive py-3 ">
                    <table class="table table-flush" id="table">
                        <caption></caption>

                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('S/N') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Charge') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Reason') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->charge }}</td>
                                    <td>{{ formatted_date($transaction->created_at) }}</td>
                                    <td>{{ $transaction->reason }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-body pb-0">
                        {{ $transactions->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
            @else
            <div class="row my-5">
                <div class="col text-center">
                    <img src="{{ asset('user/img/icons/empty.svg') }}" alt="">
                    <h4 class="mt-3">{{ __('No Earning History') }}</h4>
                    <p>{{ __("We couldn't find any earning log to this account") }}</p>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col text-center">
                    <div id="qrcode" class="mx-auto mb-3">

                    </div>

                    <a href="" id="download-qr" class="custom-btn d-block btn-block mt-3 py-2 download-qr" download="{{ auth()->user()->name . '.png' }}">
                        <i class="fas fa-download"></i> {{ __('Download') }}
                    </a>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col text-center">
                    <h4 class="text-base"><i class="fas fa-cart-plus"></i> {{ __('Total Payout') }} </h4>
                    <h3>{{ user_currency()->code ." ". number_format($payouts, 2) }}</h3>
                    <a href="{{ route('user.profiles.index') }}" class="custom-btn d-block btn-block mt-3 py-2"><i class="fas fa-arrow-up"></i> {{ __('Upgrade Account') }} </a>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col text-center">
                    <h4 class="text-base"><i class="fas fa-comment-dollar"></i> {{ __('Revenue') }} </h4>
                    <h3>{{ currency_format(auth()->user()->wallet, currency:user_currency()) }}</h3>
                    <a href="{{ url('/user/payouts') }}" class="custom-btn d-block btn-block mt-3 py-2"><i class="fas fa-history"></i>  {{ __('All Payouts') }}</a>
                </div>
            </div>
        </div>
    </div>

    @include('user.dashboard.charts.single-charge')

    @include('user.dashboard.charts.qr-payments')

    <!--
    @include('user.dashboard.charts.debit-credit')

    @include('user.dashboard.charts.order')

    @include('user.dashboard.charts.donation')

    @include('user.dashboard.charts.plans')
    -->

    <input type="hidden" id="get-chart-data" value="{{ route('user.dashboard.chart') }}">
    <input type="hidden" id="qrUrl" value="{{ route('frontend.qr.index', auth()->user()->qr) }}">
    <input type="hidden" id="username" value="{{ auth()->user()->name }}">
    <input type="hidden" id="currency" value="{{ user_currency()->symbol }}">
@endsection

@push('script')
    <script src="{{ asset('user/js/chart/chart.min.js') }}"></script>
    <script src="{{ asset('plugins/qr2js/qrjs2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/clipboard-js/clipboard.min.js') }}"></script>
    <script src="{{ asset('user/vendor/jvectormap-next/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('user/js/vendor/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('user/js/chart/dashboard.js?v5') }}"></script>
@endpush
