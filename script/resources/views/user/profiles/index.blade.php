@extends('layouts.user.master')

@section('title', __('Update business profile'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Update business profile') }}</li>
@endsection

@section('content')

    <form action="{{ route('user.profiles.update', auth()->id()) }}" method="post" class="ajaxform">
        @csrf
        @method('put')

        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Full Name') }}</label>
                    <div class="col-lg-10">
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Email') }}</label>
                    <div class="col-lg-10">
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Avatar') }}</label>
                    <div class="col-lg-10">
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Phone') }}</label>
                    <div class="col-lg-10">
                        <input type="number" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Business Name') }}</label>
                    <div class="col-lg-10">
                        <input type="text" name="business_name" class="form-control" value="{{ auth()->user()->meta['business_name'] ?? '' }}" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Address') }}</label>
                    <div class="col-lg-10">
                        <input type="text" name="address" class="form-control" value="{{ auth()->user()->meta['address'] ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Old password') }}</label>
                    <div class="col-lg-10">
                        <input type="password" name="old_password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('New password') }}</label>
                    <div class="col-lg-10">
                        <input type="password" name="new_password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ __('Description') }}</label>
                    <div class="col-lg-10">
                        <textarea type="text" name="description" class="form-control">{{ auth()->user()->meta['description'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-neutral btn-block submit-button"><i class="fas fa-save"></i>
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
