@extends('layouts.backend.app')

@section('title', __('Deposits list'))

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Deposits') }}</h4>
                    </div>
                    <div class="card-body total-deposits">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Completed Deposits') }}</h4>
                    </div>
                    <div class="card-body completed-deposits">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Pending Deposits') }}</h4>
                    </div>
                    <div class="card-body pending-deposits">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Rejected Deposits') }}</h4>
                    </div>
                    <div class="card-body rejected-deposits">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Deposits list') }}</h4>
                    <form action="{{ route('admin.deposits.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by Trx ID / amount') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-flush table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('S/N') }}</th>
                                <th>{{ __('Trx ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Charge') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $deposit->trx }}</td>
                                <td>{{ currency_format($deposit->amount, currency:user_currency()) }}</td>
                                <td>{{ formatted_date($deposit->created_at) }}</td>
                                <td>{{ number_format($deposit->charge, 2) }}</td>
                                <td>{{ $deposit->gateway->name }}</td>
                                <td>
                                    @if ($deposit->status == 2)
                                    <span class="badge badge-warning">
                                        {{ __('Pending') }}
                                    </span>
                                    @elseif ($deposit->status == 1)
                                    <span class="badge badge-success">
                                        {{ __('Completed') }}
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        {{ __('Rejected') }}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon" href="{{ route('admin.deposits.show', $deposit->id) }}">
                                            <i class="fa fa-eye"></i>
                                            {{ __('View') }}
                                        </a>

                                        @if ($deposit->status == 2)
                                        <a class="dropdown-item has-icon action-confirm" href="javascript:void(0)" data-action="{{ route('admin.deposits.approve', $deposit->id) }}" data-icon="success" data-text="You want to approve this deposit?">
                                            <i class="fa fa-check"></i>
                                            {{ __('Approve') }}
                                        </a>
                                        @endif

                                        @if ($deposit->status != 0 && $deposit->gateway->is_auto == 0)
                                        <a class="dropdown-item has-icon action-confirm" href="javascript:void(0)" data-action="{{ route('admin.deposits.reject', $deposit->id) }}" data-icon="warning" data-text="You want to reject this deposit?">
                                            <i class="fa fa-ban"></i>
                                            {{ __('Reject') }}
                                        </a>
                                        @endif

                                        <a href="javascript:void(0)"
                                            class="dropdown-item has-icon delete-confirm"
                                            data-action="{{ route('admin.deposits.destroy', $deposit->id) }}"
                                            data-method="DELETE"
                                        >
                                            <i class="fa fa-trash"></i>
                                            {{ __('Delete') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $deposits->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-deposits-url" value="{{ route('admin.get-deposits') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalDeposits()
    </script>
@endpush
