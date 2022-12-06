@extends('layouts.user.master')

@section('title', __('Deposits'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Deposits list') }}</li>
@endsection

@section('actions')
    <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#deposit_modal">
        <i class="fas fa-hand-holding-usd"></i>
        {{ __('Make deposit') }}
    </button>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-deposits">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Deposits') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 completed-deposits">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Completed Deposits') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 pending-deposits">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Pending Deposits') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 rejected-deposits">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Rejected Deposits') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary search-table">
        <div class="card-header pb-2">
            <h4></h4>
            <form action="{{ route('user.deposits.index') }}" class="card-header-form">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Trx ID") }}">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive pb-5">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Trx ID') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Charge') }}</th>
                        <th>{{ __('Payment Method') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deposits as $deposit)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $deposit->trx }}</td>
                            <td>{{ currency_format($deposit->amount, currency:user_currency()) }}</td>
                            <td>{{ formatted_date($deposit->created_at) }}</td>
                            <td>{{ number_format($deposit->charge, 2) }}</td>
                            <td>
                                <div class="badge badge-success">
                                    {{ $deposit->gateway->name }}
                                </div>
                            </td>
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
                                <span class="badge badge-danger font-weight-600">
                                    {{ __('Rejected') }}
                                </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('modal')
        <div class="modal fade" id="deposit_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 h3 font-weight-bolder">{{ __('Make Deposit') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.deposits.store') }}" method="post" class="ajaxform_instant_reload">
                            @csrf

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="">{{ __('Enter amount') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                        </span>
                                        <input type="number" step="any" class="form-control" name="amount" required=""
                                            placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-neutral btn-block submit-btn">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    {{ __('Deposits') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    <input type="hidden" id="get-deposits-url" value="{{ route('user.get-deposits') }}">
@endsection

@push('script')
    <script src="{{ asset('user/js/card-data.js') }}"></script>
    <script>
        getTotalDeposits()
    </script>
@endpush
