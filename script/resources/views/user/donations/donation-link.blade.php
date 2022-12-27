@extends('layouts.user.master')

@section('title', __('Payment link'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Donation') }}</li>
@endsection

@section('actions')
    <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#single-charge">
        {{ __('Create Payment Link') }}
    </button>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="text-center mt-8">
                        <div class="mb-3">
                            <img src="{{ asset('user/img/icons/empty.svg') }}">
                        </div>
                        <h3 class="text-dark">{{ __('No Payment Link Found') }}</h3>
                        <p class="text-dark text-sm card-text">{{ __("We couldn't find any single charge page to this account") }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>

    @push('modal')
        <div class="modal fade" id="single-charge" tabindex="-1" role="dialog" aria-labelledby="modal-form"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 font-weight-bolder">{{ __("Create New Payment Link") }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="https://boomchart.io/boompay_multi/user/single_charge" method="post" id="modal-details">
                            <input type="hidden" name="_token" value="n3tY8swSZuKls1NzPGDq6a9kJmSZ2l8S2gLerQBF">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" placeholder="{{ __("Payment link name") }}"
                                        required="">
                                    <span class="form-text text-xs">{{ __("Single Charge allows you to create payment links for your customers, Transaction Charge is 2.3% per transaction") }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">£</span>
                                        </span>
                                        <input type="number" step="any" class="form-control" name="amount"
                                            placeholder="0.00">
                                    </div>
                                    <span class="form-text text-xs">{{ __("Leave empty to allow customers enter desired amount") }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <textarea type="text" name="description" placeholder="Description" rows="4" class="form-control"
                                        required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="redirect_url" class="form-control"
                                        placeholder="https://your-domain.com">
                                    <span class="form-text text-xs">{{ __("Redirect after payment - Optional") }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-neutral btn-block" form="modal-details">{{ __("Create Link") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endsection
