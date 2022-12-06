@extends('layouts.backend.app')

@section('title', __('Profile Settings'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                </div>
                <div class="col-md-6">
                    <form method="post" class="ajaxform" action="{{ route('admin.update-general') }}">
                        @csrf
                        <h4 class="mb-20">{{ __('Edit General Settings') }}</h4>
                        <div class="custom-form">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                       placeholder="{{ __('Enter User\'s Name') }}" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" name="email" id="email" class="form-control" required
                                       placeholder="Enter Email" value="{{ Auth::user()->email }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary basicbtn">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form method="post" class="ajaxform_with_reset" action="{{ route('admin.update-password') }}">
                        @csrf
                        <h4 class="mb-20">{{ __('Change Password') }}</h4>
                        <div class="custom-form">
                            <div class="form-group">
                                <label for="current_password">{{ __('Current Password') }}</label>
                                <input type="password" name="current_password" id="current_password" class="form-control"
                                       placeholder="{{ __('Enter Current Password') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="{{ __('Enter New Password') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Confirmation Password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                       placeholder="{{ __('Enter Confirmation Password') }}" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary basicbtn">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
