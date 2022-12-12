@extends('layouts.user.master')

@section('title', __('Digital Products'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Digital products list') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.digital-products.create') }}" class="btn btn-sm btn-neutral"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add digital product') }}</a>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h2 font-weight-bold mb-0 total">
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
                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total physical products') }}</h5>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h2 font-weight-bold mb-0 quantity">
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
                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total physical products quantity') }}</h5>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 search-table">
        @if ($products->count() > 0 || request('search'))
        <div class="card">
            <div class="card-header pb-2">
                <h4></h4>
                <form action="{{ route('user.digital-products.index') }}" class="card-header-form">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name/Price">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive py-3 ">
                <table class="table table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('S/N') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Link') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td><img width="40px" class="rounded-circle" src="{{ asset($product->image ?? 'https://via.placeholder.com/50') }}" alt=""></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ currency_format($product->price, currency:user_currency()) }}</td>
                                <td><a href="{{ $product->link }}" target="_blank">{{ Str::limit($product->link,20) }}</a></td>
                                <td>{{ formatted_date($product->created_at) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('user.digital-products.edit', $product->id) }}"><i class="fas fa-edit mr-1"></i>  {{ __('Edit') }}</a>

                                            <a class="dropdown-item confirm-action" href="#"
                                                data-action="{{ route('user.digital-products.destroy', $product->id) }}"
                                                data-method="DELETE"
                                                data-icon="fas fa-trash"
                                            >
                                                <i class="fas fa-trash mr-1"></i>
                                                {{ __("Delete") }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-body pb-0">
                    {{ $products->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
        @else
        <div class="row mt-5 pt-5">
            <div class="col-md-12 mb-5">
                <div class="text-center">
                    <div class="mb-3">
                        <img src="{{ asset('user/img/icons/empty.svg') }}">
                    </div>
                    <h3 class="text-dark">{{ __('No Product Found') }}</h3>
                    <p class="text-dark text-sm card-text">{{ __("We couldn't find any product to this account") }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<input type="hidden" id="get-products-url" value="{{ route('user.get-digital-products') }}">
@endsection

@push('script')
    <script src="{{ asset('user/js/card-data.js') }}"></script>
    <script>
        getTotalProducts()
    </script>
@endpush
