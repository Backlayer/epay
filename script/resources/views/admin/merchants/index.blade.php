@extends('layouts.backend.app')

@section('title', __('Merchants'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __("Merchants") }}</h4>
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
                                
                                <th>{{ __("Site Name") }}</th>
                                <th>{{ __("Merchant") }}</th>

                                <th>{{ __("Orders") }}</th>
                                <th>{{ __("Receiver Email") }}</th>
                                <th>{{ __("Created At") }}</th>
                                <th><i class="fas fa-exchange-alt"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($merchants as $merchant)
                                <tr>
                                    
                                    <td>{{ $merchant->merchant_name ?? '' }}</td>
                                    <td><a href="{{ url('admin/customers/'.$merchant->user_id ?? '') }}">{{ $merchant->user->name ?? '' }}</a></td>
                                    <td>{{ number_format($merchant->orders_count) }}</td>
                                    <td>{{ $merchant->email }}</td>
                                    <td>{{ formatted_date($merchant->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('admin.merchants.log', $merchant->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $merchants->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
