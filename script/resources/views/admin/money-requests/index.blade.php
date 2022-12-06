@extends('layouts.backend.app')

@section('title', __('Money requests'))

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Requests') }}</h4>
                    </div>
                    <div class="card-body total-deposits">
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
                        <h4>{{ __('Completed Requests') }}</h4>
                    </div>
                    <div class="card-body completed-deposits">
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
                        <h4>{{ __('Pending Requests') }}</h4>
                    </div>
                    <div class="card-body pending-deposits">
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
                        <h4>{{ __('Rejected Requests') }}</h4>
                    </div>
                    <div class="card-body rejected-deposits">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Money requests') }}</h4>
                    <form action="{{ route('admin.money-requests.index') }}" class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by sender') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('S/N') }}</th>
                                    <th>{{ __('Sender') }}</th>
                                    <th>{{ __('Receiver') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td><a href="{{ url('admin/customers', $request->sender_id) }}">{{ $request->sender->name ?? '' }}</a></td>
                                        <td><a href="{{ url('admin/customers', $request->receiver_id) }}">{{ $request->receiver->name ?? '' }}</a></td>
                                        <td>{{ $request->sender_currency->symbol . $request->amount }}</td>
                                        <td>{{ formatted_date($request->created_at) }}</td>
                                        <td>
                                            @if ($request->status == 2)
                                                <span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i> {{ __('PENDING') }}</span>
                                            @elseif ($request->status == 1)
                                                <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('APPROVED') }}</span>
                                            @else
                                                <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> {{ __('CANCLED') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.money-requests.show', $request->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $requests->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-request-money-url" value="{{ route('admin.get-request-money') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalRequestMoney()
    </script>
@endpush
