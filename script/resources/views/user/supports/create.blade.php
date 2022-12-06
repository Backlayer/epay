@extends('layouts.user.master')

@section('title', __('Open Support Ticket'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Open ticket') }}</li>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">{{ __("New Ticket") }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.supports.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{ __("Subject") }}</label>
                            <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" name="subject" class="form-control" placeholder="{{ __("Enter subject") }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 required">{{ __('Reference') }}</label>
                            <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" name="reference_code" class="form-control" placeholder="{{ __("Transaction reference number") }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{ __("Priority") }}</label>
                            <div class="col-lg-10">
                                <select class="form-control select" name="priority" required>
                                    <option value="Low">{{ __("Low") }}</option>
                                    <option value="Medium">{{ __("Medium") }}</option>
                                    <option value="High">{{ __("High") }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{ __("Type") }}</label>
                            <div class="col-lg-10">
                                <select class="form-control select" name="type" required>
                                    <option value="subscription">{{ __("Subscription") }}</option>
                                    <option value="money_transfer">{{ __("Money Transfer") }}</option>
                                    <option value="request_money">{{ __("Request Money") }}</option>
                                    <option value="settlement">{{ __("Settlement") }}</option>
                                    <option value="store">{{ __("Store") }}</option>
                                    <option value="single_charge">{{ __("Single Charge") }}</option>
                                    <option value="donation">{{ __("Donation") }}</option>
                                    <option value="invoice">{{ __("Invoice") }}</option>
                                    <option value="charges">{{ __("Charges") }}</option>
                                    <option value="bank_transfer">{{ __("Bank transfer") }}</option>
                                    <option value="deposit">{{ __("Deposit") }}</option>
                                    <option value="others">{{ __("Others") }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{ __("Details") }}</label>
                            <div class="col-lg-10">
                                <textarea name="details" class="form-control" rows="6" required placeholder="{{ __("Description") }}"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{ __("Select Images for attachment") }} <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="customFileLang" name="image[]" accept="image/*" multiple required>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-sm submit-button">{{ __("Save") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
