@extends('layouts.backend.app', [
    'prev' => url()->previous()
])

@section('title', __('Create Fields for Signup'))

@section('content')
    <form action="{{ route('admin.signup-fields.store') }}" method="POST" class="ajaxform_with_redirect repeater">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="label" class="required">{{ __('Label') }}</label>
                                <input type="text" name="label" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="type" class="required">{{ __('Type') }}</label>
                                <select name="type" class="form-control" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}">{{ ucwords($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 row">
                                <div class="form-group col-6">
                                    <label for="isRequired" class="required">{{ __('Is Required?') }}</label>
                                    <input class="form-check-input mx-4" name="isRequired" type="checkbox" value="true">
                                </div>
                                <div class="form-group col-6">
                                    <label for="isActive" class="required">{{ __('Is Active?') }}</label>
                                    <input class="form-check-input mx-4" name="isActive" type="checkbox" value="true">
                                </div>
                            </div>
                        </div>

                        @include('admin.signupFields.repeater')

                        <button class="btn btn-primary basicbtn float-right">
                            <i class="fas fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
