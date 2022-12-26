@extends('layouts.backend.app', [
    'prev' => route('admin.invoices.index')
])

@section('title', __('Invoice'))

<?php $quantity = 0; $invoice->loadSum('items', 'subtotal'); ?>

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row p-4 justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row align-self-start">
                            <span class="mx-4 mb-2 font-weight-bold">{{ __('Invoice No') }}:</span>
                            <span>{{ $invoice->invoice_no }}</span>
                        </div>
                        <div class="d-flex flex-row align-self-start">
                            <ul>
                                <li><span class="mr-2 font-weight-bold">{{ __('Trx') }}:</span> {{ $invoice->trx ?? 'N/A' }}</li>
                                <li><span class="mr-2 font-weight-bold">{{ __('Status:') }}</span> {!! $invoice->PaymentStatus !!}</li>
                                @if($invoice->isPaid)
                                <li><span class="mr-2 font-weight-bold">{{ __('Paid At') }}:</span> {{ formatted_date($invoice->paid_at) }}</li>
                                @endif
                                <li><span class="mr-2 font-weight-bold">{{ __('Created At') }}:</span> {{ formatted_date($invoice->created_at)  }}</li>
                                <li><span class="mr-2 font-weight-bold">{{ __('Due Date') }}:</span> {{ formatted_date($invoice->due_date) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-self-start">
                        <div class="d-flex flex-row">
                            <span class="mx-4 mb-2 font-weight-bold">{{ __('Owner') }}:</span>
                            <span>{{ $invoice->owner->name }}</span>
                        </div>
                        <div class="d-flex flex-row align-self-start">
                            <span class="mx-4 mb-2 font-weight-bold">{{ __('Customer Email') }}:</span>
                            <span>{{ $invoice->customer_email }}</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive px-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Invoice Name') }}</th>
                                <th scope="col">{{ __('Amount') }}</th>
                                <th scope="col">{{ __('Quantity') }}</th>
                                <th scope="col">{{ __('Sub Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($invoice->items as $item)
                                    <td>{{ $item->name }}</td>
                                    <td>
                                    {{ convert_money_direct($item->amount, $invoice->currency, default_currency(), true)}}
                                    </td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>
                                        {{ convert_money_direct($invoice->items_sum_subtotal, $invoice->currency, default_currency(), true)}}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if($invoice->note)
                 <div class="d-flex px-4 align-items-center">
                     <span class="font-weight-bold">{{ __('Nota') }}:</span>
                     <span class="ml-2">{{ $invoice->note }}</span>
                 </div>
                @endif
                <div class="w-100 d-flex justify-content-sm-center justify-content-md-center justify-content-lg-end">
                    <div class="p-4 w-50">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="height:40px">
                                        {{ __('Charge') }}
                                    </th>
                                    <td style="height:40px">:</td>
                                    <td style="height:40px">{{ convert_money_direct($invoice->charge, $invoice->currency, default_currency(), true) }}</td>
                                </tr>
                                <tr>
                                    <th style="height:40px">
                                        {{ __('Tax') }}
                                    </th>
                                    <td style="height:40px">:</td>
                                    @if($invoice->tax)
                                      <td style="height:40px">{{ __(":percentage %", ['percentage' => $invoice->tax]) }}</td>
                                    @else
                                      <td style="height:40px">{{ __(":percentage %", ['percentage' => 0]) }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th style="height:40px">
                                        {{ __('Discount') }}
                                    </th>
                                    <td style="height:40px">:</td>
                                    @if($invoice->discount)
                                        <td style="height:40px">{{ __(":percentage %", ['percentage' => $invoice->discount]) }}</td>
                                    @else
                                        <td style="height:40px">{{ __(":percentage %", ['percentage' => 0]) }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th style="height:40px">
                                        {{ __('Total') }}
                                    </th>
                                    <td style="height:40px">:</td>
                                    <td style="height:40px">{{ convert_money_direct($invoice->total, $invoice->currency, default_currency(), true)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($invoice->status_paid === '1')
                <form action="{{ route('admin.invoices.confirm', $invoice->id) }}" method="post" class="ajaxform_instant_reload_after_confirm d-inline p-4">
                    @csrf

                    <button class="btn btn-success float-right submit-button submit-btn">
                        <i class="fas fa-check"></i>

                        {{ __('Confirm Payment') }}
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
