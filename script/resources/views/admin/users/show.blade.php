@extends('layouts.backend.app', [
    'prev' => route('admin.customers.index')
])

@section('title', __('User Profile'))

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card bg-gradient-danger border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                        <img src="{{ avatar() }}" alt="" class="rounded-circle" width="50">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <h3 class="mt-3 mx-auto text-white">{{ $user->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group mt-4">
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Account ID') }}</div>
                            <div class="font-weight-light">{{ $user->id }}</div>
                        </li>

                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Username') }}</div>
                            <div class="font-weight-light"><span>@</span>{{ $user->username }}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Email') }}</div>
                            <div class="font-weight-light">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#sendEmailModal">
                                    {{ $user->email }} <i class="fas fa-paper-plane"></i>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Wallet') }}</div>
                            <div class="font-weight-light">
                                {{ convert_money_direct($user->wallet, $user->currency, default_currency(), true) }}
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Account Status') }}</div>
                            <div class="font-weight-light">
                                @if($user->status == 1)
                                    <span class="badge badge-primary">{{ __('Active') }}</span>
                                @elseif($user->status == 0)
                                    <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                @elseif($user->status == 2)
                                    <span class="badge badge-danger">{{ __('Banned') }}</span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Email Verified At') }}</div>
                            <div class="font-weight-light">
                                {{ formatted_date($user->email_verified_at) }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Kyc Verified At') }}</div>
                            <div class="font-weight-light">
                                @if($user->kyc_verified_at)
                                    {{ formatted_date($user->email_verified_at) }}
                                @else
                                    {{ __('Not verified') }}
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Deposit') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency_format($user->deposits_sum_amount, currency: $user->currency) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Withdraw') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ 55 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Transaction') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency_format($user->transactions_sum_amount, currency: $user->currency) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalTitle">{{ __('Send Email') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.customers.send-email', $user->id) }}" method="POST" class="ajaxform_with_reset">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="subject" class="required">{{ __('Subject') }}</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Enter email subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="message" class="required">{{ __('Message') }}</label>
                            <textarea name="message" id="message" class="summernote" placeholder="{{ __('Enter message') }}" ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary basicbtn">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
@endpush
