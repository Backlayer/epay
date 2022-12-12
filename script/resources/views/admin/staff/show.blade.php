@extends('layouts.backend.app', [
    'prev' => route('admin.customers.index')
])

@section('title', __('Customer Profile'))

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column">
                        <figure class="avatar avatar-lg">
                            <img
                                src="{{ $customer->avatar ? asset($customer->avatar) : get_gravatar($customer->email) }}"
                                alt="{{ $customer->name }}"
                            >
                        </figure>

                        <h3 class="mt-3 mx-auto">{{ $customer->name }}</h3>

                        <ul class="list-group mt-4">
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Account ID') }}</div>
                                <div class="font-weight-light">{{ $customer->id }}</div>
                            </li>

                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Customername') }}</div>
                                <div class="font-weight-light"><span>@</span>{{ $customer->username }}</div>
                            </li>
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Email') }}</div>
                                <div class="font-weight-light">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#sendEmailModal">
                                        {{ $customer->email }} <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Account Status') }}</div>
                                <div class="font-weight-light">
                                    @if($customer->status == 1)
                                       <span class="badge badge-primary">{{ __('Active') }}</span>
                                    @elseif($customer->status == 0)
                                        <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                    @elseif($customer->status == 2)
                                        <span class="badge badge-danger">{{ __('Banned') }}</span>
                                    @endif
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Email Verified At') }}</div>
                                <div class="font-weight-light">
                                   {{ formatted_date($customer->email_verified_at) }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


