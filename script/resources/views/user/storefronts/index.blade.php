@extends('layouts.user.master')

@section('title', __('Store fronts'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Store fronts list') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.storefronts.create') }}" class="btn btn-sm btn-neutral"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Create store fronts') }}</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-6">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Stores') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 physical">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Physical Stores') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 digital">
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
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Digital Stores') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row search-table">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-2">
                    <h4></h4>
                    <form action="{{ route('user.storefronts.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Store name2") }}">
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
                                <th>{{ __('S/N') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Shopping status') }}</th>
                                <th>{{ __('Product Tyep') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Copy Link') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td><img width="40px" class="rounded-circle" src="{{ asset($store->image ?? 'https://via.placeholder.com/50') }}" alt=""></td>
                                <td>{{ $store->name }}</td>
                                <td>
                                    @if ($store->shipping_status == 1)
                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('ACTIVE') }}</span>
                                    @else
                                        <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> {{ __('DEACTIVATE') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-primary"><i class="fas fa-check"></i> {{ $store->product_type == 0 ? __('Physical'):__('Digital') }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-{{ $store->status == 0 ? 'danger':'primary' }}"><i class="fas fa-check"></i> {{ $store->status == 0 ? __('Disabled'):__('Active') }}</span>
                                </td>
                                <td>
                                    <input type="hidden" id="clip{{ $loop->index }}" value="{{ route('frontend.store-products', $store->id) }}">
                                    <span class="clipboard-button" data-clipboard-target="#clip{{ $loop->index }}">
                                        <i class="fas fa-link cursor-pointer"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('user.store-products', $store->id) }}"><i class="fas fa-shopping-bag mr-1"></i>  {{ __('Products') }}</a>

                                            <a class="dropdown-item" href="{{ route('user.orders.index', ['store' => $store->id]) }}"><i class="fas fa-shopping-cart mr-1"></i>  {{ __('Orders') }}</a>

                                            <a class="dropdown-item" href="{{ route('user.storefronts.edit', $store->id) }}"><i class="fas fa-edit mr-1"></i>  {{ __('Edit') }}</a>

                                            <a class="dropdown-item confirm-action" href="#"
                                                data-action="{{ route('user.storefronts.destroy', $store->id) }}"
                                                data-method="DELETE"
                                                data-icon="fas fa-trash"
                                            >
                                                <i class="fas fa-trash mr-1"></i>
                                                {{ __("Delete") }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-body pb-0">
                        {{ $stores->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="get-stores-url" value="{{ route('user.get-stores') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        getTotalStores()
    </script>
@endpush
