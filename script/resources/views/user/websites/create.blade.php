@extends('layouts.user.master')

@section('title', __('Merchant'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Add New Website') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.websites.index') }}" class="btn btn-sm btn-neutral"> <i class="fa fa-list" aria-hidden="true"></i> {{ __('View List') }} </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">{{ __('Add New Website') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.websites.store') }}" method="post" class="ajaxform_instant_reload">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="merchant_name" class="required">{{ __('Merchant Name') }}</label>
                                    <input type="text" name="merchant_name" id="merchant_name" class="form-control" placeholder="{{ __('Merchant Name') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="model" class="required">{{ __('Website Mode') }}</label>
                                <select class="form-control select" name="mode" id="mode" required>
                                    <option disabled selected>{{ __('Mode') }}</option>
                                    <option value="1">{{ __('Live') }}</option>
                                    <option value="0">{{ __('Test') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label for="email">{{ __('Contact Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __("Send Notifications To") }}">
                                <span class="form-text text-xs">{{ __('If provided, this email address will get transaction notification') }}</span>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea class="form-control" type="text" name="message" rows="3" spellcheck="false" placeholder="{{ __("Message After Payment") }}"></textarea>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-neutral submit-btn submit-button">{{ __("Create Merchant") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
