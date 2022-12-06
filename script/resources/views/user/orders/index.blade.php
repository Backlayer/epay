@extends('layouts.user.master')

@section('title', __('Orders'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Orders list') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-orders">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Orders') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 completed-orders">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Approved Order') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 pending-orders">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Pending Order') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 cancled-orders">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Cancled Order') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card search-table">
        <div class="card-header pb-2">
            <h4></h4>
            <form action="{{ route('user.orders.index') }}" class="card-header-form">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Name / email / invoice / amount") }}">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive py-3">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Invoice no') }}</th>
                        <th>{{ __('Store name') }}</th>
                        <th>{{ __('Product type') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                            <a href="{{ route('user.orders.show', $order->id) }}">{{ $order->invoice_no }}</a>
                        </td>
                        <td>{{ $order->storefront->name }}</td>
                        <td>
                            <div class="badge badge-{{ $order->storefront->product_type ? 'future':'primary' }}">{{ $order->storefront->product_type ? 'Digital':'Physical' }}</div>
                        </td>
                        <td>{{ currency_format($order->amount, currency:user_currency()) }}</td>
                        <td>{{ formatted_date($order->created_at) }}</td>
                        <td>
                            @if ($order->status == 1)
                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                            @elseif($order->status == 2)
                                <span class="badge badge-success">{{ __('Approved') }}</span>
                            @elseif($order->status == 0)
                                <span class="badge badge-danger">{{ __('Cancel') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->status == 1)
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">

                                    <a class="dropdown-item confirm-action" data-action="{{ route('user.orders.update', [$order->id, 'type' => 'approve']) }}" data-method="PUT" data-icon="fas fa-check" href="#">
                                        <i class="fas fa-check mr-1 text-success"></i>
                                        {{ __('Approved') }}
                                    </a>
                                    <a class="dropdown-item confirm-action" data-action="{{ route('user.orders.update', [$order->id, 'type' => 'cancle']) }}" data-method="PUT" data-icon="fas fa-ban" href="#">
                                        <i class="far fa-window-close mr-1 text-danger"></i>
                                        {{ __('Cancle') }}
                                    </a>

                                </div>
                            </div>
                            @else
                                <span class="badge badge-{{ $order->status ? 'success':'danger' }}">{{ $order->status ? __('Approved'):__('Cancled') }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body pb-0">
                {{ $orders->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    <input type="hidden" id="get-orders-url" value="{{ route('user.get-orders') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        getTotalOrders()
    </script>
@endpush
