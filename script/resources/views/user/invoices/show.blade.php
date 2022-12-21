@extends('layouts.user.blank')

@section('body')
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <hr class="d-sm-none" />
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            {{ __('Invoice # :id', ['id' => $invoice->invoice_no]) }}
                                        </div>

                                        <div class="my-2">
                                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                            <span class="text-600 text-90">
                                                {{ __('Issue Date: :date', ['date' => formatted_date($invoice->created_at)]) }}
                                            </span>
                                        </div>

                                        <div class="my-2">
                                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                            <span class="text-600 text-90">
                                                {{ __('Due Date: :date', ['date' => formatted_date($invoice->due_date)]) }}
                                            </span>
                                        </div>

                                        <div class="my-2">
                                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                            <span class="text-600 text-90">{{ __('Status:') }}</span>
                                            @if($invoice->is_paid)
                                                <span class="badge badge-success badge-pill px-25">
                                                    {{ __('Paid') }}
                                                </span>
                                            @else
                                                <span class="badge badge-warning badge-pill px-25">
                                                    {{ __('Unpaid') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="text-95 col-sm-6 align-self-start align-items-end d-sm-flex flex-column justify-content-end">
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">{{ __('To:') }}</span>
                                        <span class="text-600 text-110 text-blue align-middle">{{ $invoice->customer_email }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle"></span>
                                        <span class="text-600 text-110 text-blue align-middle">{{ $invoice->customer_phone_number }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Item') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Sub Total') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice->items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ currency_format($item->amount, currency: $invoice->currency) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ currency_format($item->subtotal, currency: $invoice->currency) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="row mt-5" style="max-width: fit-content;">
                                    <div class="col-md-8">
                                        <p>{{ $invoice->note }}</p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th class="text-left">{{ __('Sub Total') }}</th>
                                                <td>:</td>
                                                <td>{{ currency_format($invoice->items_sum_subtotal, currency: $invoice->currency) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">{{ __('Discount') }}</th>
                                                <td>:</td>
                                                <td>{{ __(':percentage %', ['percentage' => $invoice->discount]) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">{{ __('Tax') }}</th>
                                                <td>:</td>
                                                <td>{{ __(':percentage %', ['percentage' => $invoice->tax]) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">{{ __('Total') }}</th>
                                                <td>:</td>
                                                <td>
                                                    {{ convert_money_direct($total, $invoice->currency, user_currency(), true) }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6"></div>
                                </div>

                                <form action="{{ route('user.invoices.send', $invoice->id) }}" method="post" class="ajaxform_instant_reload">
                                    @csrf
                                    <a href="{{ route('user.invoices.index') }}" class="btn btn-outline-danger">
                                        {{ __('All Invoices') }}
                                    </a>
                                    <button class="btn btn-neutral float-right submit-button submit-btn">
                                        <i class="fas fa-paper-plane"></i>
                                        @if($invoice->is_sent)
                                            {{ __('Resend') }}
                                        @else
                                            {{ __('Send') }}
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
