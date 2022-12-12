@extends('layouts.backend.app', [
    'prev' => route('admin.invoices.index')
])

@section('title', __('Invoice'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <th width="20%">
                            {{ __('Invoice No') }}
                        </th>
                        <td width="1%">:</td>
                        <td>{{ $invoice->invoice_no }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Trx') }}
                        </th>
                        <td>:</td>
                        <td>{{ $invoice->trx }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Item Name') }}
                        </th>
                        <td>:</td>
                        <td>{{ $invoice->item_name }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Amount') }}
                        </th>
                        <td>:</td>
                        <td>{{ convert_money_direct($invoice->amount, $invoice->currency, default_currency(), true) }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Charge') }}
                        </th>
                        <td>:</td>
                        <td>{{ convert_money_direct($invoice->charge, $invoice->currency, default_currency(), true) }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Tax') }}
                        </th>
                        <td>:</td>
                        <td>{{ __(":percentage %", ['percentage' => $invoice->tax]) }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Discount') }}
                        </th>
                        <td>:</td>
                        <td>{{ __(":percentage %", ['percentage' => $invoice->discount]) }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Quantity') }}
                        </th>
                        <td>:</td>
                        <td>{{ $invoice->quantity }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Customer Email') }}
                        </th>
                        <td>:</td>
                        <td>{{ $invoice->customer_email }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Due Date') }}
                        </th>
                        <td>:</td>
                        <td>{{ formatted_date($invoice->due_date) }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Note') }}
                        </th>
                        <td>:</td>
                        <td>{{ $invoice->note }}</td>
                    </tr>
                    @if($invoice->is_paid)

                        <tr>
                            <th>
                                {{ __('Paid At') }}
                            </th>
                            <td>:</td>
                            <td>{{ formatted_date($invoice->paid_at) }}</td>
                        </tr>
                    @endif

                    <tr>
                        <th>
                            {{ __('Owner') }}
                        </th>
                        <td>:</td>
                        <td>{{ $invoice->owner->name }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Created At') }}
                        </th>
                        <td>:</td>
                        <td>{{ formatted_date($invoice->created_at) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
