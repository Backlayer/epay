@extends('layouts.user.blank')

@section('body')
    <div class="main-content">
        <!-- Header -->
        <div class="header py-5 ">
            <div class="container">
                <div class="header-body text-center mb-7">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5 mb-0">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-7">
                    <div class="card card-primary border-0 mb-5">
                        <div class="card-body pt-5 px-5">
                            <div class="text-center text-dark mb-5">
                                <h3 class="text-dark font-weight-bolder">{{__('Default Bank Account')}}</h3>
                                <span class="text-gray text-xs">{{__('Settlements will be paid to this account')}}</span>
                            </div>
                            <form action="{{ route('user.set-bank.store') }}" method="post" class="ajaxform_instant_reload">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <select class="form-control select" name="bank" required>
                                            <option value="">{{__('Select Bank')}}</option>
                                            @foreach($banks as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <select class="form-control select" name="account_type" required>
                                            <option value="" selected disabled>{{ __('Account Type') }}</option>
                                            <option value="individual">{{ __('Individual') }}</option>
                                            <option value="company">{{ __('Company') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="account_number">{{ __('Account Number') }}</label>
                                            <input type="number" name="account_number" id="account_number" class="form-control" placeholder="{{ __('Enter account number') }}"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="account_name">{{ __('Account Name') }}</label>
                                    <input type="text" name="account_name" id="account_name" class="form-control" placeholder="{{ __('Enter account name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="routing_number">{{ __('Routing Number / Sort Code') }}</label>
                                    <input type="number" name="routing_number" id="routing_number" class="form-control" placeholder="{{ __('Enter routing number or sort code') }}"  required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark my-4 btn-block">
                                        {{ __('Save Account') }}
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('logout') }}" method="post" class="text-center" id="logoutForm">
                                @csrf
                                <h3>{{ __("or") }}</h3>
                                <br>
                                <a href="" class="btn btn-white border text-black font-weight-600" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                                    {{ __("Logout") }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
