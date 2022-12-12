@extends('layouts.user.master')

@section('title', __('Invoice'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Invoice') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.invoices.create') }}" class="btn btn-sm btn-neutral">
        {{ __('Create Invoice') }}
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 invoices">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Invoices') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($invoices->count() > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{ __("Invoice No") }}</th>
                                            <th>{{ __("Recipient") }}</th>
                                            <th>{{ __("Sub Total") }}</th>
                                            <th>{{ __('Discount') }}</th>
                                            <th>{{ __('Tax') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Is Paid') }}</th>
                                            <th>{{ __('Due Date') }}</th>
                                            <th>{{ __("Created At") }}</th>
                                            <th>{{ __("Action") }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->invoice_no }}</td>
                                                <td>{{ $invoice->customer_email }}</td>
                                                <td>{{ currency_format($invoice->items_sum_subtotal, currency: $invoice->currency) }}</td>
                                                <td>{{ __(':percentage %', ['percentage' => $invoice->discount]) }}</td>
                                                <td>{{ __(':percentage %', ['percentage' => $invoice->tax]) }}</td>
                                                <td>{{ currency_format($invoice->total, currency: $invoice->currency) }}</td>
                                                <td>
                                                    @if($invoice->is_paid)
                                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('Paid') }}</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger"><i class="fas fa-spinner"></i> {{ __('Unpaid') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ formatted_date($invoice->due_date) }}</td>
                                                <td>{{ formatted_date($invoice->created_at) }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('user.invoices.edit', $invoice->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                                {{ __("Edit") }}
                                                            </a>
                                                            <a class="dropdown-item confirm-action"
                                                               href="#"
                                                               data-icon="fas fa-trash"
                                                               data-action="{{ route('user.invoices.destroy', $invoice->id) }}"
                                                               data-method="DELETE"
                                                            >
                                                                <i class="fas fa-trash"></i>
                                                                {{ __("Delete") }}
                                                            </a>
                                                            <input type="hidden" id="clip{{ $loop->index }}" value="{{ route('frontend.invoice.index', $invoice->uuid) }}">
                                                            <button class="dropdown-item" data-clipboard-target="#clip{{ $loop->index }}">
                                                                <i class="fas fa-clipboard" ></i>
                                                                {{ __('Copy to Clipboard') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{ $invoices->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="text-center mt-8">
                            <div class="mb-3">
                                <img src="{{ asset('user/img/icons/empty.svg') }}">
                            </div>
                            <h3 class="text-dark">{{ __('No Invoice Found') }}</h3>
                            <p class="text-dark text-sm card-text">{{ __("We couldn't find any invoice to this account") }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <input type="hidden" id="get-invoices-url" value="{{ route('user.get-invoices') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
    <script>
        getTotalInvoices()
    </script>
@endpush
