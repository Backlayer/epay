@extends('layouts.backend.app', [
    'prev' => route('admin.settings.charges.index'),
])

@section('title', __('Income Charges'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.settings.charges.update') }}" method="post" class="ajaxform_with_redirect">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_money_charge_type" class="required">{{ __('Money Request Charge Type') }}</label>
                                    <select name="request_money_charge_type" id="request_money_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['request_money_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_money_charge_rate" class="required">{{ __('Money Request Charge Rate') }}</label>
                                    <input type="number" step="any" name="request_money_charge_rate" id="request_money_charge_rate" value="{{ $charges['request_money_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="withdraw_charge_type" class="required">{{ __('Money Withdraw Charge Type') }}</label>
                                    <select name="withdraw_charge_type" id="withdraw_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['withdraw_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="withdraw_charge_rate" class="required">{{ __('Money Withdraw Charge Rate') }}</label>
                                    <input type="number" step="any" name="withdraw_charge_rate" id="withdraw_charge_rate" value="{{ $charges['withdraw_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transfer_charge_type" class="required">{{ __('Money Transfer Charge Type') }}</label>
                                    <select name="transfer_charge_type" id="transfer_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['transfer_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transfer_charge_rate" class="required">{{ __('Money Transfer Charge Rate') }}</label>
                                    <input type="number" step="any" name="transfer_charge_rate" id="transfer_charge_rate" value="{{ $charges['transfer_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transaction_charge_type" class="required">{{ __('Bank Transaction Charge Type') }}</label>
                                    <select name="transaction_charge_type" id="transaction_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['transaction_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transaction_charge_rate" class="required">{{ __('Bank Transaction Charge Rate') }}</label>
                                    <input type="number" step="any" name="transaction_charge_rate" id="transaction_charge_rate" value="{{ $charges['transaction_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single_payment_charge_type" class="required">{{ __('Single Payment Charge Type') }}</label>
                                    <select name="single_payment_charge_type" id="single_payment_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['single_payment_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single_payment_charge_rate" class="required">{{ __('Single Payment Charge Rate') }}</label>
                                    <input type="number" step="any" name="single_payment_charge_rate" id="single_payment_charge_rate" value="{{ $charges['single_payment_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="donation_charge_type" class="required">{{ __('Donation Charge Type') }}</label>
                                    <select name="donation_charge_type" id="donation_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['donation_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="donation_charge_rate" class="required">{{ __('Donation Charge Rate') }}</label>
                                    <input type="number" step="any" name="donation_charge_rate" id="donation_charge_rate" value="{{ $charges['donation_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_charge_type" class="required">{{ __('Invoice Charge Type') }}</label>
                                    <select name="invoice_charge_type" id="invoice_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['invoice_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_charge_rate" class="required">{{ __('Invoice Charge Rate') }}</label>
                                    <input type="number" step="any" name="invoice_charge_rate" id="invoice_charge_rate" value="{{ $charges['invoice_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_plan_charge_type" class="required">{{ __('User Plan Charge Type') }}</label>
                                    <select name="user_plan_charge_type" id="user_plan_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['user_plan_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_plan_charge_rate" class="required">{{ __('User Plan Charge Rate') }}</label>
                                    <input type="number" step="any" name="user_plan_charge_rate" id="user_plan_charge_rate" value="{{ $charges['user_plan_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="merchant_charge_type" class="required">{{ __('Website/Merchant Charge Type') }}</label>
                                    <select name="merchant_charge_type" id="merchant_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['merchant_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="merchant_charge_rate" class="required">{{ __('Website/Merchant Charge Rate') }}</label>
                                    <input type="number" step="any" name="merchant_charge_rate" id="merchant_charge_rate" value="{{ $charges['merchant_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qr_payment_charge_type" class="required">{{ __('QR Payment Charge Type') }}</label>
                                    <select name="qr_payment_charge_type" id="qr_payment_charge_type" class="form-control" data-control="select2" required>
                                        @foreach ($types as $type => $title)
                                            <option value="{{ $type }}" @selected(($charges['qr_payment_charge']['type'] ?? null) == $type )>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qr_payment_charge_rate" class="required">{{ __('QR Payment Charge Rate') }}</label>
                                    <input type="number" step="any" name="qr_payment_charge_rate" id="qr_payment_charge_rate" value="{{ $charges['qr_payment_charge']['rate'] ?? null }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary basicbtn float-right">
                            <i class="fas fa-save"></i>
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
