@extends('layouts.user.master')

@section('title', __('Transfer Money'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Transfer Money') }}</li>
@endsection

@php
    $option = get_option('charges');
@endphp

@section('actions')
    <a href="{{ route('user.transfers.create') }}" class="btn btn-sm btn-neutral">
        <i class="fas fa-plus"></i> {{ __('Send Money') }}
    </a>
    <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#statistic">
        <i class="fas fa-sync"></i>
        {{ __('Statistics') }}
    </button>
    <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#beneficiary">
        <i class="fas fa-user"></i>
        {{ __('Beneficiary') }}
    </button>
@endsection

@section('content')

    <div class="row d-flex justify-content-between flex-wrap">
        <div class="col">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-transfers">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Transfers') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 completed-transfers">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Completed Transfers') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 pending-transfers">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Pending Transfers') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 refund-transfers">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Refund Transfers') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 cancled-transfers">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Cancled Transfers') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-end search-table">
                <div class="col-sm-6 col-md-4">
                    <form action="{{ route('user.transfers.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="TR/Email/Amount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($transfers->count() > 0)
        @foreach ($transfers as $transfer)
            <div class="row transfers-list">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 align-self-center">
                                    <h4 class="h4 mb-1 font-weight-bold">{{ __('TRX') }}-{{ $transfer->trx }}</h4>
                                    <p>{{ __('From') }}: {{ $transfer->user->email }}</p>
                                    @if (auth()->id() == $transfer->user_id)
                                        <p>{{ __('Sent') }}: {{ currency_format($transfer->amount + $transfer->charge, currency:user_currency()) }}</p>
                                    @else
                                        <p>{{ __('Received') }}:
                                            {{ currency_format(convert_money($transfer->amount, $transfer->currency) * user_currency()->rate, currency:user_currency()) }}
                                        </p>
                                    @endif
                                    <p class="text-sm">{{ __('Date') }}:
                                        {{ Carbon\Carbon::parse($transfer->created_at)->format('Y/m/d  H:i:A') }}</p>
                                </div>
                                <div class="col-sm-4 align-self-center">
                                    <h4 class="h4 mb-1 font-weight-bold">{{ __('Recipient') }}</h4>
                                    <p>{{ __('Email') }}: {{ $transfer->email }}</p>
                                    <p class="mb-2">{{ __('Business') }} {{ $transfer->user->meta['business_name'] ?? '' }}</p>
                                </div>
                                <div class="col-sm-3 align-self-center">
                                    @if (auth()->id() == $transfer->user_id)
                                        <span class="badge badge-pill badge-primary">{{ __('Charge') }}:
                                            {{ currency_format($transfer->charge, currency:user_currency()) }}
                                        </span>
                                    @endif
                                    @if ($transfer->status == 3)
                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i>
                                            {{ __('Confirmed') }}</span>
                                    @elseif ($transfer->status == 1)
                                        <span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i>
                                            {{ __('Pending') }}</span>
                                    @elseif ($transfer->status == 2)
                                        <span class="badge badge-pill badge-info"><i class="fas fa-spinner"></i>
                                            {{ __('Accepted') }}</span>
                                    @else
                                        <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i>
                                            {{ __('Canceled') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-1 align-self-center">
                                    @if (auth()->id() != $transfer->user_id && $transfer->status == 1)
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item confirm-action" data-action="{{ route('user.transfers.show', [$transfer->id, 'type' => 'accept']) }}" data-method="GET" data-icon="fas fa-check" href="#">
                                                <i class="fas fa-check mr-1"></i>
                                                {{ __('Accept') }}
                                            </a>
                                            <a class="dropdown-item confirm-action" data-action="{{ route('user.transfers.show', [$transfer->id, 'type' => 'cancle']) }}" data-method="GET" data-icon="fas fa-ban" href="#">
                                                <i class="fas fa-ban mr-1"></i>
                                                {{ __('Cancel') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row my-5 py-5">
            <div class="col text-center mt-5">
                <img src="{{ asset('user/img/icons/empty.svg') }}" alt="">
                <h4 class="mt-3">{{ __('No Transfer Request') }}</h4>
                <p>{{ __("We couldn't find any transfer request to this account") }}</p>
            </div>
        </div>
    @endif

    @push('modal')
        <div class="modal fade" id="statistic" tabindex="-1" role="dialog" aria-labelledby="modal-form" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title font-weight-bolder">{{ __('Statistics') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <h4 class="mb-4 text-primary font-weight-bolder">
                                    {{ __('Statistics') }}
                                </h4>
                                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> {{ __('Sent') }}</span><br>
                                <span class="text-xl text-dark mb-0">{{ currency_format($total_transfer, currency:user_currency()) }}</span><br>
                                <hr>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="my-4">
                                    <span class="surtitle">{{ __('Pending') }}</span><br>
                                    <span class="surtitle">{{ __('Returned') }}</span><br>
                                    <span class="surtitle ">{{ __('Total') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="my-4">
                                    <span class="surtitle ">{{ currency_format($pending_transfer, currency:user_currency()) }}</span><br>
                                    <span class="surtitle ">{{ currency_format($return_transfer, currency:user_currency()) }}</span><br>
                                    <span class="surtitle ">{{ currency_format($total_transfer, currency:user_currency()) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="beneficiary" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title font-weight-bolder">{{ __('Beneficiary') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            @if ($beneficiarys->count())
                                <div class="col-md-12 mb-5 text-left">
                                    <ul class="list-group list-group-flush list">
                                        @foreach ($beneficiarys as $beneficiary)
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h3 class="text-gray">{{ $beneficiary->email }}</h3>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <a data-email="{{ $beneficiary->email }}" href="#" class="btn btn-sm btn-neutral send-money-again"><i class="fas fa-share"></i> @lang('Send Money') </a>
                                                    <a href="#" class="btn btn-sm btn-neutral confirm-action" data-action="{{ route('user.transfers.destroy', $beneficiary->id) }}" data-method="DELETE" data-icon="fas fa-trash">
                                                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="col-md-12 mb-5">
                                    <div class="text-center mt-8">
                                        <div class="mb-3">
                                            <img src="{{ asset('user/img/icons/empty.svg') }}">
                                        </div>
                                        <h3 class="text-dark">{{ __('No Beneficiary Found') }}</h3>
                                        <p class="text-dark text-sm card-text"> {{ __("We couldn't find any beneficiary to this account") }} </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="send-money" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 h3 font-weight-bolder">@lang('Transfer money to') <span class="email"></span></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <span class="form-text text-xs">
                            {{ __('Transfer charge is') }}
                            {{ $option['transfer_charge']['type'] == 'fixed' ? currency_format($option['transfer_charge']['rate'], currency:user_currency()) : $option['transfer_charge']['rate'].'%' }} +
                            {{ $option['transaction_charge']['type'] == 'fixed' ? currency_format($option['transaction_charge']['rate'], currency:user_currency()) : $option['transaction_charge']['rate'].'%' }}
                            {{ __('per transaction, If user is not a member of '.env('APP_NAME').', registration will be required to claim money. Money will be refunded within 3 days if user does not claim money.') }}
                        </span>

                        <form action="{{ route('user.transfers.store') }}" method="post" class="ajaxform_instant_reload">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <input type="email" name="email" class="form-control email" placeholder="Email address" required="">
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                        </span>
                                        <input type="number" step="any" class="form-control" name="amount"  required="" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" name="password" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-2">
                                <button type="submit" class="btn btn-neutral btn-block submit-btn">
                                    {{ __('Transfer Money') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    <input type="hidden" id="get-transfers-url" value="{{ route('user.get-transfers') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        getTotalTransfers()
    </script>
@endpush
