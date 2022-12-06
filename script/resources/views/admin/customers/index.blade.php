@extends('layouts.backend.app')

@section('title', __('Customers'))

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Customers') }}</h4>
                    </div>
                    <div class="card-body total-customers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Active Customers') }}</h4>
                    </div>
                    <div class="card-body active-customers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Paused Customers') }}</h4>
                    </div>
                    <div class="card-body paused-customers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Suspended Customers') }}</h4>
                    </div>
                    <div class="card-body suspend-customers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Customer List') }}</h4>
                    <form action="{{ route('admin.customers.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by name / email') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if($customers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Registered At')}}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $key => $user)
                                    <tr class="text-center">
                                        <td class="text-left">{{$user->name}}</td>
                                        <td class="text-left">{{$user->email}}</td>
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
                                                <a class="dropdown-item has-icon action-confirm" href="javascript:void(0)" data-action="{{ route('admin.customer.login', $user->id) }}" data-icon="success" data-text="You want to login now?">
                                                    <i class="fa fa-sign"></i>
                                                    {{ __('Login') }}
                                                </a>

                                                <a
                                                    class="dropdown-item has-icon"
                                                    href="{{ route('admin.customers.show', $user->id) }}"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                    {{ __('View') }}
                                                </a>

                                                <a
                                                    class="dropdown-item has-icon"
                                                    href="{{ route('admin.customers.edit', $user->id) }}"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                    {{ __('Edit') }}
                                                </a>

                                                <a
                                                    href="javascript:void(0)"
                                                    class="dropdown-item has-icon delete-confirm"
                                                    data-action="{{ route('admin.customers.destroy', $user->id) }}"
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
                            {{ $customers->appends(request()->all())->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @else
                        <x-data-not-found
                            :message="__('Customer Not Found')"
                            button_icon="fas fa-plus"
                        />
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-customers-url" value="{{ route('admin.get-customers') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalCustomers()
    </script>
@endpush

