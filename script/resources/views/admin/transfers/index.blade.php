@extends('layouts.backend.app')

@section('title', __('Transfer money list'))

@section('content')

    <div class="row d-flex justify-content-between">
        <div class="col">
            <div class="card card-statistic-2">
                <div class="card-icon bg-primary m-3">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Transfers') }}</h4>
                    </div>
                    <div class="card-body total-transfers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-statistic-2">
                <div class="card-icon bg-success m-3">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Completed Transfers') }}</h4>
                    </div>
                    <div class="card-body completed-transfers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-statistic-2">
                <div class="card-icon bg-warning m-3">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Pending Transfers') }}</h4>
                    </div>
                    <div class="card-body pending-transfers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-statistic-2">
                <div class="card-icon bg-danger m-3">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Refund Transfers') }}</h4>
                    </div>
                    <div class="card-body refund-transfers">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-statistic-2">
                <div class="card-icon bg-danger m-3">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Cancled Transfers') }}</h4>
                    </div>
                    <div class="card-body cancled-transfers">
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
                    <h4>{{ __('Transfer money') }}</h4>
                    <form action="{{ route('admin.transfers.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by trx id/email/amount') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('S/N') }}</th>
                                    <th>{{ __('Trx') }}</th>
                                    <th>{{ __('Transfer By') }}</th>
                                    <th>{{ __('Transfer To') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfers as $transfer)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $transfer->trx }}</td>
                                    <td>{{ $transfer->user->email }}</td>
                                    <td>{{ $transfer->email }}</td>
                                    <td>{{ $transfer->currency->symbol . number_format($transfer->amount, 2) }}</td>
                                    <td>{{ $transfer->currency->symbol . number_format($transfer->charge, 2) }}</td>
                                    <td>
                                        @if ($transfer->status == 3)
                                            <span class="badge badge-pill badge-success"><i class="fas fa-check"></i>
                                                {{ __('Confirmed') }}</span>
                                        @elseif ($transfer->status == 1)
                                            <span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i>
                                                {{ __('Pending') }}</span>
                                        @elseif ($transfer->status == 2)
                                            <span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i>
                                                {{ __('Accepted') }}</span>
                                        @else
                                            <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i>
                                                {{ __('Cancled') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $transfer->created_at->format('d F, y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $transfers->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-transfers-url" value="{{ route('admin.get-transfers') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalTransfers()
    </script>
@endpush
