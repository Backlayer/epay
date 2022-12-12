@extends('layouts.backend.app')

@section('title', __('Edit Role'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-5">
                    <h3>{{ __("Edit Role") }}</h3>
                    <span>{{ __("Set role permissions") }}</span>
                </div>

                <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="row ajaxform_with_redirect">
                    @csrf
                    @method('PUT')

                    <div class="col-12 form-group">
                        <label for="name" class="required">{{ __("Role Name") }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" placeholder="{{ __("Enter role name") }}" autofocus required>
                    </div>

                    <div class="col-12">
                        <h4 class="mt-2 pt-50">{{ __("Role Permissions") }}</h4>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td class="text-nowrap fw-bolder">
                                        {{ __("Administrator Access") }}
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Allows a full access to the system">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll">{{ __('Select All') }}</label>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($groups as $key => $group)
                                    <tr>
                                        <td class="text-nowrap fw-bolder">{{ $key }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach($group as $permission)
                                                    <div class="custom-control custom-checkbox mr-3 me-lg-5">
                                                        <input type="checkbox"
                                                               name="permissions[]"
                                                               value="{{ $permission->id }}"
                                                               class="custom-control-input"
                                                               id="id_{{ $permission->id }}"
                                                               @checked($role->hasPermissionTo($permission->name))
                                                        >
                                                        <label class="custom-control-label" for="id_{{ $permission->id }}">
                                                            {{ str($permission->name)->explode('-')->last() }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary me-1 basicbtn">{{ __("Submit") }}</button>
                            <button type="reset" class="btn btn-outline-secondary ">
                                {{ __("Discard") }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
