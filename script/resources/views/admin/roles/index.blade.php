@extends('layouts.backend.app')

@section('title', __("Roles"))

@section('content')
    <div class="row">
        @foreach($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>{{ __("Total :count users", ['count' => $role->users_count]) }}</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                @foreach($role->users->take(5) as $user)
                                    <li class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ avatar($user) }}" alt="{{ $user->name }}">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{ $role->name }}</h4>
                                <a href="{{ route('admin.roles.edit', $role->id) }}">
                                    <small class="fw-bolder">{{ __("Edit Role") }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img src="{{ asset('admin/img/faq-illustrations.svg') }}" class="img-fluid mt-2" alt="Image" width="85">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="{{ route('admin.roles.create') }}">
                                <span class="btn btn-primary mb-1 waves-effect waves-float waves-light">{{ __("Add New Role") }}</span>
                            </a>
                            <p class="mb-0">{{ __("Add role, if it does not exist") }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
