@extends('layouts.user.master')

@section('title', __('Charges'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Charges') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card search-table">
                <div class="card-header">
                    <h4></h4>
                    <form action="{{ route('user.charges.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Amount / Reason") }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive pb-3">
                    <table class="table table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Service Charge') }}</th>
                                <th>{{ __('Reason') }}</th>
                                <th>{{ __('Created') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($charges as $charge)
                                <tr>
                                    <td>{{ $charge->invoice_no }}</td>
                                    <td>{{ currency_format($charge->charge, currency:user_currency()) }}</td>
                                    <td>{{ $charge->reason }}</td>
                                    <td>{{ formatted_date($charge->created_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $charges->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">
                                {{ currency_format($total_charges, currency:user_currency()) }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h3 class="card-title text-uppercase text-muted mb-0">{{ __('Total Charges') }}</h3>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
