@extends('layouts.backend.app', [
    'prev' => route('admin.staff.index')
])

@section('title', __('Create Staff'))

@section('content')
    <form action="{{ route('admin.staff.store') }}" method="post" class="ajaxform_with_redirect">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ __("Personal Information") }}</h6>

                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __("Enter name") }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __("Enter email") }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required">{{ __('Phone') }}</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="{{ __("Enter phone") }}" required>
                        </div>

                        <div class="form-group">
                            <label for="username" class="required">{{ __('Username') }}</label>
                            <input type="text" pattern="[A-Za-z0-9]+" name="username" id="username" class="form-control" placeholder="{{ __("Enter username") }}" required>
                        </div>

                        <div class="form-group">
                            <label for="role" class="required">{{ __('Role') }}</label>
                            <select name="role" id="role" data-control="select2" data-hide-search data-placeholder="{{ __("Select Role") }}" required>
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary submit-button w-100">
                            <i class="fas fa-user-plus"></i>
                            {{ __("Create") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
