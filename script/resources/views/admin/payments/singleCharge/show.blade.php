@extends('layouts.backend.app', [
    'prev' => route('admin.transactions.index')
])

@section('title', __('Transaction'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            @empty($orders)
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="text-center mt-8">
                            <div class="mb-3">
                                <img width="10%" src="{{ asset('user/img/icons/empty.svg') }}">
                            </div>
                            <h3 class="text-dark">{{ __('No Transactions Found') }}</h3>
                            <p class="text-dark text-sm card-text">{{ __("We couldn't find any single charge orders") }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header">
                                <h4>{{ __("Transactions") }}</h4>
                                <form class="card-header-form">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="{{ __("Search") }}" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{ __("Invoice No") }}</th>
                                            <th>{{ __("TRX ID") }}</th>
                                            <th>{{ __("From") }}</th>
                                            <th>{{ __("Amount") }}</th>
                                            <th>{{ __("Charge") }}</th>
                                            <th>{{ __('Payment Status') }}</th>
                                            <th>{{ __("Created At") }}</th>
                                            <th>{{ __("Action") }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list" style="min-height: 200px">
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td>{{ $order->trx }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>
                                                    {{ currency_format($order->amount, 'icon', $order->currency->symbol) }}
                                                </td>
                                                <td>
                                                    {{ currency_format($order->charge, 'icon', $order->currency->symbol) }}
                                                </td>
                                                <td>{!! $order->PaymentStatus !!}</td>
                                                <td>{{ formatted_date($order->created_at) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.payments.single-charge.order', [$singleCharge->id, $order->id]) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $orders->links('vendor/pagination/bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
    </div>
@endsection
