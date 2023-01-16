@extends('layouts.user.master')

@section('title', __('Update Api Keys'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Update Api Keys') }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h3 class="mb-0 font-weight-bolder">{{ __("API Keys") }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.api-keys.store') }}" method="post" class="ajaxform_instant_reload">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-xs text-uppercase">{{__("Public Key") }}</span>
                                    </div>
                                    <input type="text" name="public_key" class="form-control" value="{{ auth()->user()->public_key }}" readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text clipboard-button" data-clipboard-text="{{ auth()->user()->public_key }}" data-message="{{ __("Public key copied to clipboard") }}">
                                            <i class="fas fa-copy"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-xs text-uppercase">{{ __("Secret Key") }}</span>
                                    </div>
                                    <input type="text" name="secret_key" class="form-control" placeholder="{{ __("Secret Key") }}" value="{{ auth()->user()->secret_key }}" readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text clipboard-button" data-clipboard-text="{{ auth()->user()->secret_key }}" data-message="{{ __("Secret key copied to clipboard") }}">
                                            <i class="fas fa-copy"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-sm submit-button">{{ __("Generate New Keys") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
@endpush
