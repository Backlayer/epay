 @extends('layouts.user.master')

@section('title', __('Transfer money'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Transfer money') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.transfers.index') }}" class="btn btn-sm btn-neutral"><i class="fa fa-list" aria-hidden="true"></i> {{ __('View list') }}</a>
@endsection

@php
    $option = get_option('charges');
@endphp

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <span class="form-text text-xs">
                        {{ __('Transfer charge is') }}
                        {{ $option['transfer_charge']['type'] == 'fixed' ? currency_format($option['transfer_charge']['rate'], currency:user_currency()) : $option['transfer_charge']['rate'].'%' }} +
                        {{ $option['transaction_charge']['type'] == 'fixed' ? currency_format($option['transaction_charge']['rate'], currency:user_currency()) : $option['transaction_charge']['rate'].'%' }}
                        {{ __('per transaction, If user is not a member of '.env('APP_NAME').', registration will be required to claim money. Money will be refunded within 3 days if user does not claim money.') }}
                    </span>

                    <form action="{{ route('user.transfers.store') }}" method="post" class="ajaxform_instant_reload">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <input type="email" name="email" class="form-control" placeholder="{{ __("Email address") }}" required="">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </span>
                                    <input type="number" step="any" class="form-control" name="amount"  required="" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <select class="form-control select" name="is_beneficiary" required="">
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __("Password") }}" type="password" name="password" required="">
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-neutral btn-block submit-btn">
                                {{ __('Transfer Money') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
