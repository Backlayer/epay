@extends('layouts.backend.app')

@section('title', __('Donations'))

@section('content')

    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Donations') }}</h4>
                    </div>
                    <div class="card-body total-donations">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Active Donations') }}</h4>
                    </div>
                    <div class="card-body active-donations">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Paused Donations') }}</h4>
                    </div>
                    <div class="card-body paused-donations">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __("Donations") }}</h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="{{ __("Search by user") }}" value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{__('Merchant')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Donors')}}</th>
                                <th>{{__('Goal')}}</th>

                                <th>{{__('Status')}}</th>
                                <th>{{__('Created')}}</th>
                                <th>{{__('Updated')}}</th>
                                <th>{{__('Link')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($donationLinks as $donationLink)
                                <tr>
                                    <td><a href="{{ url('admin/customers', $donationLink->user_id) }}">{{ $donationLink->user->business_name ?? $donationLink->user->name ?? __("Deleted") }}</a></td>
                                    <td>{{ $donationLink->title  }}</td>
                                    <td>{{ $donationLink->orders_count  }}</td>
                                    <td>{{ currency_format($donationLink->amount, currency: $donationLink->currency) }}</td>

                                    <td>
                                        @if($donationLink->status)
                                            <span class="badge badge-success">{{ __("Active") }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __("Inactive") }}</span>
                                        @endif
                                    </td>
                                    <td>{{ formatted_date($donationLink->created_at) }}</td>
                                    <td>{{ formatted_date($donationLink->updated_at) }}</td>
                                    <td>
                                    <span
                                        class="clipboard-button"
                                        data-clipboard-text="{{ route('frontend.donation.index', $donationLink->uuid) }}"
                                    >
                                        <i class="fas fa-clipboard"></i>

                                    </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.payments.donations.show', $donationLink->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $donationLinks->links('vendor/pagination/bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-donations-url" value="{{ route('admin.payments.get-donations') }}">
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
    "use strict";
    getTotalDonations()
    </script>
@endpush
