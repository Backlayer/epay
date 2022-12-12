@extends('layouts.backend.app')

@section('title', __('Orders list'))

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Orders') }}</h4>
                    </div>
                    <div class="card-body total-orders">
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
                        <h4>{{ __('Approved Order') }}</h4>
                    </div>
                    <div class="card-body completed-orders">
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
                        <h4>{{ __('Pending Order') }}</h4>
                    </div>
                    <div class="card-body pending-orders">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Cancled Order') }}</h4>
                    </div>
                    <div class="card-body cancled-orders">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Orders list') }}</h4>
            <form action="{{ route('admin.orders.index') }}" class="card-header-form">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by name / email / amount') }}">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-header">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ !request('status') ? 'active bg-primary' : '' }}" href="{{ route('admin.orders.index') }}">
                                {{ __('All') }}
                                <span class="badge {{ request('status') == 'all' ? 'badge-white' : 'badge-primary' }} total-orders"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'approved' ? 'active bg-success' : '' }}" href="{{ route('admin.orders.index', ['status' => 'approved']) }}">
                                {{ __('Approved') }}
                                <span class="badge {{ request('status') == 'approved' ? 'badge-white' : 'badge-primary' }} completed-orders"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'pending' ? 'active bg-warning' : '' }}" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">
                                {{ __('Pending') }}
                                <span class="badge {{ request('status') == 'pending' ? 'badge-white' : 'badge-primary' }} pending-orders"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'cancled' ? 'active bg-danger' : '' }}" href="{{ route('admin.orders.index', ['status' => 'cancled']) }}">
                                {{ __('Cancled') }}
                                <span class="badge {{ request('status') == 'cancled' ? 'badge-white' : 'badge-primary' }} cancled-orders"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.orders.mass-destroy') }}" method="POST" class="ajaxform_with_mass_delete">
                @csrf
                <div class="float-left">
                    <button class="btn btn-danger btn-lg basicbtn mass-delete-btn" id="submit-button"
                        style="display: none;">{{ __('Delete') }}</button>
                </div>
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-flush" id="table">
                        <thead>
                            <tr>
                                <th class="text-center pt-2">
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>{{ __('Invoice no') }}</th>
                                <th>{{ __('Store name') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="ids[]" id="order-{{ $order->id }}" class="custom-control-input checked_input" value="{{ $order->id }}" data-checkboxes="mygroup">
                                            <label for="order-{{ $order->id }}" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}">
                                            {{ $order->invoice_no }}
                                        </a>
                                    </td>
                                    <td><a href="{{ url('/store/'.$order->storefront->id ?? '') }}">{{ $order->storefront->name ?? '' }}</a></td>
                                    <td>{{ currency_format($order->amount, currency:$order->currency) }}</td>
                                    <td>{{ formatted_date($order->created_at) }}</td>
                                    <td>
                                        <div class="badge badge-{{ $order->storefront->product_type ? 'future':'primary' }}">{{ $order->storefront->product_type ? 'Digital':'Physical' }}</div>
                                    </td>
                                    <td>
                                        @if ($order->status == 1)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @elseif($order->status == 2)
                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                        @elseif($order->status == 0)
                                        <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="card-footer">
            {{ $orders->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
    <input type="hidden" id="get-orders-url" value="{{ route('admin.get-orders') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalOrders()
    </script>
@endpush
