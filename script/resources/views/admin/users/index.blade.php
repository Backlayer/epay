@extends('layouts.backend.app', [
    'button_name' => __('Add User'),
    'button_link' => route('admin.users.create')
])

@section('title', __('Users'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Customer List') }}</h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="src" value="{{ request('src') }}" class="form-control" placeholder="{{ __('Search user') }}"/>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                   @if($users->count() > 0)

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>{{ __('Photo') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Registered At')}}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr class="text-center">
                                        <td>
                                            <figure class="avatar mr-2">
                                                <img src="{{ $user->avatar ? asset($user->avatar) : get_gravatar($user->email) }}" alt="{{ $user->name }}">
                                            </figure>
                                        </td>
                                        <td class="text-left">{{$user->name}}</td>
                                        <td class="text-left">{{$user->email}}</td>
                                        <td>{{ currency_format($user->sales_sum_amount) }}</td>
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
                                                    href="{{ route('admin.users.show', $user->id) }}"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                    {{ __('View') }}
                                                </a>

                                                <a
                                                    class="dropdown-item has-icon"
                                                    href="{{ route('admin.users.edit', $user->id) }}"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                    {{ __('Edit') }}
                                                </a>

                                                <a
                                                    class="dropdown-item has-icon confirm-action"
                                                    href="javascript:void(0)"
                                                    data-action="{{ route('admin.users.login', $user->id) }}"
                                                    data-method="POST"
                                                >
                                                    <i class="fa fa-key"></i>
                                                    {{ __('Login') }}
                                                </a>

                                                <a
                                                    href="javascript:void(0)"
                                                    class="dropdown-item has-icon delete-confirm"
                                                    data-action="{{ route('admin.users.destroy', $user->id) }}"
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
                            {{ $users->appends(request()->all())->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @else
                       <x-data-not-found
                            :message="__('User Not Found')" :button_name="__('Add User')"
                            :button_link="route('admin.users.create')"
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

