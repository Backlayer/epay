@extends('layouts.user.master')

@section('title', __('Merchant'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Website') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.websites.index') }}" class="btn btn-sm btn-neutral"> {{ __('View List') }} </a>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="mb-0 font-weight-bolder">{{ __('Edit Website') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.websites.update', $website->id) }}" method="post" class="ajaxform_instant_reload">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="merchant_name" class="form-control" placeholder="{{ __("Website Name") }}" required="" value="{{ $website->merchant_name }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control select" name="mode" required="">
                            <option value="">{{ __('Select Mode') }}</option>
                            <option @selected($website->mode == 1) value="1">{{ __('Live') }}</option>
                            <option @selected($website->mode == 0) value="0">{{ __('Test') }}</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" placeholder="{{ __("Send Notifications To") }}" value="{{ $website->email }}">
                        <span class="form-text text-xs">{{ __('If provided, this email address will get transaction notification') }}</span>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <textarea class="form-control" type="text" name="message" rows="3" spellcheck="false" placeholder="{{ __("Message After Payment") }}">{{ $website->message }}</textarea>
                    </div>
                </div>
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-neutral submit-btn">{{ __("Update Merchant") }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
