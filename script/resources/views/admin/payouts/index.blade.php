@extends('layouts.backend.app')

@section('title', __('Withdraw list'))

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Payouts') }}</h4>
                    </div>
                    <div class="card-body total-payouts">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
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
                        <h4>{{ __('Total Completed') }}</h4>
                    </div>
                    <div class="card-body completed-payouts">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
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
                        <h4>{{ __('Total Pending') }}</h4>
                    </div>
                    <div class="card-body pending-payouts">
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
                        <h4>{{ __('Total Rejected') }}</h4>
                    </div>
                    <div class="card-body rejected-payouts">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Withdraws list') }}</h4>
                        <form action="{{ route('admin.payouts.index') }}" class="card-header-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by trx id / amount') }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('admin.payouts.delete') }}" class="confirm-form">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select class="form-control action" name="method">
                                            <option value="">{{ __('Select Action') }}</option>
                                            <option value="delete">{{ __('Delete Permanently') }}</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 text-right float-right">
                                    <ul class="nav nav-pills float-right">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('*/payouts') && !request('status') ? 'active' : '' }}" href="{{ route('admin.payouts.index') }}">@lang('All')
                                            <span class="badge badge-primary total-payouts"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') == 'approved' ? 'active' : '' }}" href="{{ route('admin.payouts.index', ['status' => 'approved']) }}">{{ __('Approved') }}
                                            <span class="badge badge-primary completed-payouts"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.payouts.index', ['status' => 'pending']) }}">{{ __('Pending') }}
                                            <span class="badge badge-primary pending-payouts"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('status') == 'rejected' ? 'active' : '' }}" href="{{ route('admin.payouts.index', ['status' => 'rejected']) }}"> {{ __('Rejected') }} <span class="badge badge-primary rejected-payouts"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>#</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Charge') }}</th>
                                            <th>{{ __('Rate') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            <tr id="row4">
                                                <td class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" name="ids[]" class="custom-control-input" value="{{ $withdraw->id }}" id="data-{{ $withdraw->id }}">
                                                        <label for="data-{{ $withdraw->id }}" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M y', strtotime($withdraw->created_at)) }}</td>
                                                <td>{{ $withdraw->currency->symbol.$withdraw->amount }}</td>
                                                <td>{{ $withdraw->currency->symbol.$withdraw->charge }}</td>
                                                <td>{{ $withdraw->currency->symbol.$withdraw->rate }}</td>
                                                <td>
                                                    @if ($withdraw->status == 'pending')
                                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                    @elseif ($withdraw->status == 'rejected')
                                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                    @elseif ($withdraw->status == 'approved')
                                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item has-icon" href="{{ route('admin.payouts.show', $withdraw->id) }}">
                                                            <i class="fa fa-eye"></i>
                                                            {{ __('View') }}
                                                        </a>
                                                        @if ($withdraw->status != 'approved')
                                                        <a class="dropdown-item has-icon action-confirm" href="javascript:void(0)" data-action="{{ route('admin.payouts.approved', ['withdraw' => $withdraw->id]) }}" data-icon="success" data-text="You want to approve this?">
                                                            <i class="fa fa-check"></i>
                                                            {{ __('Approve') }}
                                                        </a>
                                                        @endif
                                                        @if ($withdraw->status != 'rejected')
                                                        <a class="dropdown-item has-icon action-confirm" href="javascript:void(0)" data-action="{{ route('admin.payouts.reject', ['withdraw' => $withdraw->id]) }}" data-icon="warning" data-text="You want to reject this?">
                                                            <i class="fa fa-ban"></i>
                                                            {{ __('Reject') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        {{ $withdraws->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-payouts-url" value="{{ route('admin.get-payouts') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalPayouts()
    </script>
@endpush
