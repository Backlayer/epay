@extends('layouts.user.master')

@section('title', __('Transactions'))

@section('actions')
    <a href="{{ route('user.single-charges.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

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
                            <p class="text-dark text-sm card-text">{{ __("We couldn't find any single charge page to this account") }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0">
                                <h3 class="mb-0">{{ __("Transactions") }}</h3>
                            </div>
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{ __("Invoice No") }}</th>
                                        <th>{{ __("TRX ID") }}</th>
                                        <th>{{ __("Title") }}</th>
                                        <th>{{ __("From") }}</th>
                                        <th>{{ __("Amount") }}</th>
                                        <th>{{ __("Charge") }}</th>
                                        <th>{{ __("Status") }}</th>
                                        <th>{{ __("Created At") }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list" style="min-height: 200px">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->invoice_no }}</td>
                                            <td>{{ $order->trx }}</td>
                                            <td>{{ $order->donation->title }}</td>
                                            <td>{{ $order->name }}[{{ $order->email }}]</td>
                                            <td>
                                                {{ currency_format($order->amount, 'icon', $order->currency->symbol) }}
                                            </td>
                                            <td>
                                                {{ currency_format($order->charge, 'icon', $order->currency->symbol) }}
                                            </td>
                                            <td>
                                                @if($order->status)
                                                    <span class="badge badge-pill badge-success">{{ __("Success") }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">{{ __("Failed") }}</span>
                                                @endif
                                            </td>
                                            <td>{{ formatted_date($order->created_at) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{ $orders->links('vendor/pagination/bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
    </div>
@endsection
