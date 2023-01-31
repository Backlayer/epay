@extends('layouts.user.master')

@section('title', __('Received Requests'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Requests') }}</li>
@endsection

@section('actions')
    <!--a class="btn btn-sm btn-neutral" href="{{ route('user.request-money.index') }}">
        <i class="fas fa-arrow-alt-circle-up"></i> {{ __('Sended List') }}
    </-a-->
    <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modal-formx">
        <i class="fa fa-plus" aria-hidden="true"></i>
        {{ __('Create Request') }}
    </button>
@endsection

@php
    $option = get_option('charges');
@endphp

@section('content')

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-deposits">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Requests') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 completed-deposits">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Completed Requests') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 pending-deposits">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Pending Requests') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 rejected-deposits">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Rejected Requests') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row search-table">
        <div class="col-md-12">
            @if ($requests->count() > 0 || request('search'))
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-1">
                            <h4>
                                <div class="btn-group">
                                    <a class="btn {{ Route::is('user.request-money.index') ? 'btn-facebook':'btn-primary' }}" href="{{ route('user.request-money.index') }}"><i class="fas fa-arrow-alt-circle-up"></i> {{ __('Sended List') }}</a>
                                    <a class="btn {{ Route::is('user.received-request.index') ? 'btn-facebook':'btn-primary' }}" href="{{ route('user.received-request.index') }}"><i class="fas fa-arrow-alt-circle-down"></i> {{ __('Received List') }}</a>
                                </div>
                            </h4>
                            <form action="{{ route('user.received-request.index') }}" class="card-header-form">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Email / Name") }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('S/N') }}</th>
                                        <th>{{ __('From') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            @php
                                                $request_amount = convert_money($request->amount, $request->sender_currency ?? '') * user_currency()->rate;
                                            @endphp
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $request->sender->email ?? '' }}</td>
                                            <td>
                                                {{ currency_format($request_amount, currency:user_currency()) }}
                                            </td>
                                            <td>{{ formatted_date($request->created_at) }}</td>
                                            <td>
                                                @if ($request->status == 2)
                                                    <span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i> {{ __('PENDING') }}</span>
                                                @elseif ($request->status == 1)
                                                    <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('APPROVED') }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> {{ __('CANCELED') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item view-money-request" href="#" data-request="{{ $request }}" data-amount="{{ currency_format($request_amount, currency:user_currency()) }}" data-date="{{ formatted_date($request->created_at) }}"><i class="far fa-eye mr-1 text-primary"></i>  {{ __('View') }}</a>

                                                        @if ($request->sender_id != auth()->id() && $request->status == 2)
                                                        <a class="dropdown-item confirm-action" data-action="{{ route('user.request-money.approved', $request->id) }}" data-method="GET" data-icon="fas fa-external-link-square-alt" href="#">
                                                            <i class="fas fa-external-link-square-alt mr-1 text-success"></i>
                                                            {{ __('Send') }}
                                                            {{ currency_format($request_amount, currency:user_currency()) }}
                                                        </a>

                                                        <a class="dropdown-item confirm-action" data-action="{{ route('user.request-money.cancel', $request->id) }}" data-method="GET" data-icon="fas fa-ban" href="#">
                                                            <i class="far fa-window-close mr-1 text-danger"></i>
                                                            {{ __('Cancel') }}
                                                        </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-body pb-0">
                                {{ $requests->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="text-center mt-8">
                        <div class="mb-3">
                            <img src="{{ asset('user/img/icons/empty.svg') }}">
                        </div>
                        <h3 class="text-dark">{{ __("No Money Request") }}</h3>
                        <p class="text-dark text-sm card-text">{{ __("We couldn't find any payouts money request to this account") }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('modal')
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 font-weight-bolder">{{ __('Send money request') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.request-money.store') }}" method="post" id="modal-details" class="ajaxform_instant_reload">
                            @csrf

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="email" name="email" class="form-control" placeholder="{{ __("Email") }}" required="">
                                    <span class="form-text text-xs">{{ __('Make sure he/she have an account on') }} {{ env('APP_NAME') }}, {{ __('Transfer charge is') }} {{ $option['request_money_charge']['rate'] }}% + {{ currency_format($option['transaction_charge']['rate'], currency:user_currency()) }} {{ __('per transaction. Charge will be taken from sender') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                        </span>
                                        <input type="number" step="any" class="form-control" name="amount"
                                            placeholder="0.00" id="amount" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-neutral btn-block submit-btn" form="modal-details">{{ __('Send Request') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="view-money-request" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-0">
                        <h3 class="mb-0 font-weight-bolder">{{ __('View money request') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th><b>{{ __("Date") }}</b></th>
                                <td class="request-date">{{ __('Demo') }}</td>
                            </tr>
                            <tr>
                                <th><b>{{ __("Status") }}</b></th>
                                <td class="request-status">{{ __('Demo') }}</td>
                            </tr>
                            <tr>
                                <th><b>{{ __("Amount") }}</b></th>
                                <td class="request-amount">{{ __('Demo') }}</td>
                            </tr>
                        </table>
                        <div class="row mb-2">
                            <div class="col text-center">
                                <img class="sender-avatar rounded-circle" width="70" src="" alt="">
                            </div>
                        </div>
                        <h4>{{ __('Sender information') }}</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th><b>{{ __("Name") }}</b></th>
                                <td class="sender-name">{{ __('Demo') }}</td>
                            </tr>
                            <tr>
                                <th><b>{{ __("Phone") }}</b></th>
                                <td class="sender-phone">{{ __('Demo') }}</td>
                            </tr>
                            <tr>
                                <th><b>{{ __("Email") }}</b></th>
                                <td class="sender-email">{{ __('Demo') }}</td>
                            </tr>
                        </table>

                        <div class="row mb-2">
                            <div class="col text-center">
                                <img class="receiver-avatar rounded-circle" width="70" src="" alt="">
                            </div>
                        </div>
                        <h4>{{ __('Receiver information') }}</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th><b>{{ __("Name") }}</b></th>
                                <td class="receiver-name">{{ __('Demo') }}</td>
                            </tr>
                            <tr>
                                <th><b>{{ __("Phone") }}</b></th>
                                <td class="receiver-phone">{{ __('Demo') }}</td>
                            </tr>
                            <tr>
                                <th><b>{{ __("Email") }}</b></th>
                                <td class="receiver-email">{{ __('Demo') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    <input type="hidden" id="get-request-money-url" value="{{ route('user.get-request-money') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        getTotalRequestMoney()
    </script>
@endpush
