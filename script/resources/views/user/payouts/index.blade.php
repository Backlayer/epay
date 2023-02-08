@extends('layouts.user.master')

@section('title', __('Payout'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Payout') }}</li>
@endsection

@section('actions')
    <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modal-formx">
        <i class="fa fa-plus" aria-hidden="true"></i>
        {{ __('Withdraw Request') }}
    </button>
@endsection

@php
    $option = get_option('charges');
@endphp

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-payouts">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Payouts') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 completed-payouts">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Completed') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 pending-payouts">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Pending') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 rejected-payouts">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Rejected') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row search-table">
        <div class="col-md-12 text-center">
            @if ($payouts->count() > 0 || request('search'))
            <div class="card">
                <div class="card-header">
                    <h4></h4>
                    <form action="{{ route('user.payouts.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Trx ID") }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive p3-5">
                    <table class="table table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('S / N') }}</th>
                                <th>{{ __('Trx ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Charge') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payouts as $payout)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $payout->trx }}</td>
                                <td>{{ currency_format($payout->amount, currency:user_currency())  }}</td>
                                <td>{{ currency_format($payout->charge, currency:user_currency())  }}</td>
                                <td>
                                    @if ($payout->status == 'pending')
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif ($payout->status == 'rejected')
                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                    @elseif ($payout->status == 'approved')
                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                        @endif
                                </td>
                                <td>{{ formatted_date($payout->created_at) }}</td>
                                <td>
                                    <a href="{{ route('user.payouts.show', $payout->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-body pb-0">
                        {{ $payouts->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col mt-5">
                    <img src="{{ asset('user/img/icons/empty.svg') }}" alt="">
                    <h4 class="mt-3">{{ __('No Payout Request') }}</h4>
                    <p>{{ __("We couldn't find any payout request to this account") }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('modal')
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 h3 font-weight-bolder">{{ __('Create Payout Request') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.payouts.store') }}" method="post" class="ajaxform_instant_reload">
                            @csrf

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                        </div>
                                        <input type="number" step="any" name="amount" id="amounttransfer3" class="form-control" placeholder="0.00" required="">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <select name="bank_id" id="bank_id" class="form-control" required>
                                            <option value="">-{{ __('Select Bank') }}-</option>
                                            @foreach ($userbanks as $userbank)
                                            <option value="{{ $userbank->id }}">{{ $userbank->bank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-xs">
                                        {{ __('Withdraw charge is') }}
                                        {{ $option['transfer_charge']['type'] == 'fixed' ? currency_format($option['transfer_charge']['rate'], currency:user_currency()) : $option['transfer_charge']['rate'].'%' }} +
                                        {{ $option['withdraw_charge']['type'] == 'fixed' ? currency_format($option['withdraw_charge']['rate'], currency:user_currency()) : $option['withdraw_charge']['rate'].'%' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __('Request Payout') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    <input type="hidden" id="get-payouts-url" value="{{ route('user.get-payouts') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js?v=' . config('app.version')) }}"></script>
    <script>
        getTotalPayouts()
    </script>
@endpush
