@extends('layouts.backend.app')

@section('title', __('Assign Role'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <h3>{{ __("Assign Role To User") }}</h3>
                    </div>

                    <form action="{{ route('admin.assign-role.store') }}" method="post" class="row ajaxform_with_redirect">
                        @csrf

                        <div class="col-12 form-group">
                            <label for="user" class="required">{{ __("User") }}</label>
                            <select name="user" id="user" data-placeholder="{{ __('Select User') }}" required>

                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="role" class="required">{{ __("Role") }}</label>
                            <select name="roles[]" id="role" data-control="select2" data-placeholder="{{ __('Select Role') }}" multiple required>
                                <option></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary me-1 basicbtn">{{ __("Submit") }}</button>
                            <button type="reset" class="btn btn-outline-secondary">
                                {{ __("Discard") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="searchUrl" value="{{ route('admin.assign-role.search') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/pages/assign-role.js') }}"></script>
@endpush
