@extends('layouts.backend.app')

@section('title', __('Products list'))

@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Products') }}</h4>
                    </div>
                    <div class="card-body total">
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
                        <h4>{{ __('Total Physical Products') }}</h4>
                    </div>
                    <div class="card-body physical">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Digital Products') }}</h4>
                    </div>
                    <div class="card-body digital">
                        <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Products list') }}</h4>
                    <form action="{{ route('admin.products.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by store name') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-3 ">
                        <table class="table table-flush" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('S/N') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Store') }}</th>
                                    <th>{{ __('Owner') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Product Type') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    @foreach ($store->products ?? [] as $product)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td><img width="40px" class="rounded-circle" src="{{ asset($product->image ?? 'https://via.placeholder.com/50') }}" alt=""></td>
                                        <td><a href="{{ url('/store',$store->id) }}" target="_blank">{{ $store->name }}</a></td>
                                        <td><a href="{{ url('admin/customers/'.$store->user_id) }}">{{ $store->name }}</a></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <span class="badge badge-pill badge-{{ $store->product_type == 0 ? 'primary':'info' }}"><i class="fas fa-check"></i> {{ $store->product_type == 0 ? __('Physical'):__('Digital') }}</span>
                                        </td>
                                        <td>{{ formatted_date($product->created_at) }}</td>
                                        <td>
                                            <a href="{{ route('frontend.products.show', [$store->id, $product->id]) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-body pb-0">
                            {{ $stores->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-products-url" value="{{ route('admin.get-products') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalProducts()
    </script>
@endpush
