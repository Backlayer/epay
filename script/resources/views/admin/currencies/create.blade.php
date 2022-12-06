@extends('layouts.backend.app', [
    'prev' => route('admin.currencies.index'),
])

@section('title', __('Create Currency'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.currencies.store') }}" method="post" class="ajaxform_with_redirect">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Enter currency name') }}" required>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="country_name" class="required">{{ __('Select Country') }}</label>
                                <select id="country_name" name="country_name" class="form-control select2" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code" class="required">{{ __('Code') }}</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="{{ __('Enter currency code') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="rate" class="required">{{ __('Rate') }}</label>
                            <input type="number" name="rate" id="rate" class="form-control" placeholder="{{ __('Enter currency rate') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="symbol" class="required">{{ __('Symbol') }}</label>
                            <input type="text" name="symbol" id="symbol" class="form-control" placeholder="{{ __('Enter currency symbol') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="position" class="required">{{ __('Position') }}</label>
                            <select name="position" id="position" class="form-control" data-control="select2" required>
                                <option value="left">{{ __('Left') }}</option>
                                <option value="right">{{ __('Right') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control" data-control="select2" required>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inative') }}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary basicbtn float-right">
                            <i class="fas fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
