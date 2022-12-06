@extends('layouts.user.master')

@section('title', __('Transactions'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Website Integration') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.websites.create') }}" class="btn btn-sm btn-neutral">
        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New Website') }}
    </a>
    <a href="{{ route('user.websites.documentation') }}" class="btn btn-sm btn-neutral">
        <i class="fas fa-file"></i>
        {{ __('Documentation') }}
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>{{ __("Transactions") }}</h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Search...") }}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body pt-0">
                    @if ($orders->count() > 0)
                        <div class="table-responsive py-3 ">
                            <table class="table table-flush" id="table">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{ __('S/N') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('From') }}</th>
                                    <th>{{ __('IP Address') }}</th>
                                    <th>{{ __('Paid At') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('TRX') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Reference Code') }}</th>
                                    <th>{{ __('Gateway') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $order->website->merchant_name }}</td>
                                        <td>{{ $order->first_name .' '. $order->last_name }}</td>
                                        <td>{{ $order->ip_address }}</td>
                                        <td>
                                            @if($order->paid_at)
                                                {{ formatted_date($order->paid_at) }}
                                            @else
                                                <span class="badge badge-warning">
                                            <i class="fas fa-spinner"></i>
                                            {{ __('Unpaid') }}
                                        </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($order->paid_at && $order->payment_status)
                                                <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i>
                                            {{ __('Paid') }}
                                        </span>
                                            @else
                                                <span class="badge badge-warning">
                                            <i class="fas fa-spinner"></i>
                                            {{ __('Pending') }}
                                        </span>
                                            @endif
                                        </td>
                                        <td>{{ $order->trx }}</td>
                                        <td>{{ convert_money_direct($order->amount, $order->currency, user_currency(), true) }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>
                                            {{ convert_money_direct($order->amount * $order->quantity, $order->currency, user_currency(), true) }}
                                        </td>
                                        <td>{{ convert_money_direct($order->charge, $order->currency, user_currency(), true) }}</td>
                                        <td>{{ $order->reference_code }}</td>
                                        <td>{{ $order->gateway->name ?? null }}</td>
                                        <td>{{ formatted_date($order->created_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-body pb-0">
                                {{ $orders->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="text-center mt-5">
                                    <div class="mb-3">
                                        <img src="{{ asset('user/img/icons/empty.svg') }}">
                                    </div>
                                    <h3 class="text-dark">{{ __("No Transactions Found") }}</h3>
                                    <p class="text-dark text-sm card-text">{{ __("We couldn't find any transactions to this website") }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
@endpush
