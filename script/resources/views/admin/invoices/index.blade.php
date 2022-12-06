@extends('layouts.backend.app')

@section('title', __('Invoices'))

@section('content')

    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Invoices') }}</h4>
                    </div>
                    <div class="card-body invoices">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Invoice Items') }}</h4>
                    </div>
                    <div class="card-body total_items">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Items Quantity') }}</h4>
                    </div>
                    <div class="card-body total_quantity">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __("Invoices") }}</h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="{{ __("Search by user") }}" value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __("Invoice No") }}</th>
                                <th>{{ __("Sender") }}</th>
                                <th>{{ __("Receiver") }}</th>
                                <th>{{ __("Due") }}</th>
                                <th>{{ __("Is Sent") }}</th>
                                <th>{{ __("Amount") }}</th>
                                <th>{{ __("Discount") }}</th>
                                <th>{{ __("Tax") }}</th>
                                <th>{{ __("Quantity") }}</th>
                                <th>{{ __("Item Name") }}</th>
                                <th>{{ __("Transactions") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>
                                        <a href="{{ url('admin/customers', $invoice->owner_id) }}">{{ $invoice->owner->name ?? '' }}</a>
                                    </td>
                                    <td>{{ $invoice->customer_email }}</td>
                                    <td>{{ formatted_date($invoice->due_date) }}</td>
                                    <td>
                                        @if($invoice->is_sent)
                                            <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i>
                                            {{ __("Yes") }}
                                        </span>
                                        @else
                                            <span class="badge badge-danger">
                                            <i class="fas fa-times-circle"></i>
                                            {{ __("No") }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ convert_money_direct($invoice->amount, $invoice->currency, default_currency(), true) }}</td>
                                    <td>{{ __(":percentage %", ['percentage' => $invoice->discount]) }}</td>
                                    <td>{{ __(":percentage %", ['percentage' => $invoice->tax]) }}</td>
                                    <td>{{ $invoice->quantity }}</td>
                                    <td>{{ $invoice->item_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $invoices->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-invoices-url" value="{{ route('admin.get-invoices') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalInvoices()
    </script>
@endpush
