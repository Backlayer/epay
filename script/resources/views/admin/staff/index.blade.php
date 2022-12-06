@extends('layouts.backend.app', [
    'button_name' => __("Add Staff"),
    'button_link' => route('admin.staff.create')
])

@section('title', __('Staff'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Staff List') }}</h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="src" value="{{ request('src') }}" class="form-control"
                                   placeholder="{{ __('Search user') }}"/>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if($staff->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Registered At')}}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($staff as $key => $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{collect($user->roles)->map(fn($role) => $role->name)->implode(',') }}</td>
                                        <td>
                                            @if($user->status ==1)
                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                            @elseif($user->status == 2)
                                                <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('Banned') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ formatted_date($user->created_at) }}
                                            <br>
                                            {{ $user->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a
                                                    class="dropdown-item has-icon"
                                                    href="{{ route('admin.staff.edit', $user->id) }}"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                    {{ __('Edit') }}
                                                </a>

                                                <a
                                                    href="javascript:void(0)"
                                                    class="dropdown-item has-icon delete-confirm"
                                                    data-action="{{ route('admin.staff.destroy', $user->id) }}"
                                                    data-method="DELETE"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                    {{ __('Delete') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $staff->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @else
                        <x-data-not-found
                            :message="__('Staff Not Found')"
                            :button_name="__('Add Staff')"
                            :button_link="route('admin.staff.create')"
                            button_icon="fas fa-plus"
                        />
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
@endpush

