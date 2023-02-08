@extends('layouts.user.master')

@section('title', __('Create Single Charge'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Single Charge') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.single-charges.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.single-charges.store') }}" method="post" class="ajaxform_instant_reload">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="title">{{ __('Payment Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="{{ __('Payment Title') }}" required>
                            </div>
                            <span class="form-text text-xs">
                                {{ __('Single Charge allows you to create payment links for your customers, Transaction Charge is :percentage per transaction', ['percentage' => $charge['type'] == 'percentage' ? $charge['rate'] . '%' : convert_money_direct($charge['rate'], default_currency(), user_currency(), true)]) }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">{{ __('Amount') }}</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">{{ user_currency()->symbol }}</span>
                            </span>
                            <input type="number" step="any" class="form-control" name="amount" placeholder="0.00">
                        </div>
                        <span
                            class="form-text text-xs">{{ __('Leave empty to allow customers enter desired amount') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="customer_name">{{ __('Customer Name') }}</label>
                        <input type="text" name="customer_name" id="customer_name" maxlength="100"
                            placeholder="{{ __('Customer Name') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea type="text" name="description" id="description" placeholder="{{ __('Description') }}" rows="4"
                            class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="redirect_url">{{ __('Redirect URL') }}</label>
                        <input type="text" name="redirect_url" class="form-control" placeholder="https://example.com">
                        <span class="form-text text-xs">{{ __('Redirect after payment - Optional') }}</span>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-neutral btn-block submit-button">
                            {{ __('Create Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
