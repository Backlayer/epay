@extends('layouts.backend.app')

@section('title', __('Stores list'))

@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Stores') }}</h4>
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
                        <h4>{{ __('Total Physical Stores') }}</h4>
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
                        <h4>{{ __('Total Digital Stores') }}</h4>
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
                    <h4>{{ __('Stores list') }}</h4>
                    <form action="{{ route('admin.stores.index') }}" class="card-header-form">
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
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('S/N') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Shopping status') }}</th>
                                    <th>{{ __('Product Tyep') }}</th>
                                    <th>{{ __('Copy Link') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>
                                        @if ($store->shipping_status == 1)
                                            <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('ACTIVE') }}</span>
                                        @else
                                            <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> {{ __('DEACTIVE') }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge badge-pill badge-primary"><i class="fas fa-check"></i> {{ $store->product_type == 0 ? __('Physical'):__('Digital') }}</span>
                                    </td>
                                    <td>
                                        <input type="hidden" id="clip{{ $loop->index }}" value="{{ route('frontend.store-products', $store->id) }}">
                                        <span class="clipboard-button" data-clipboard-target="#clip{{ $loop->index }}">
                                            <i class="fas fa-link cursor-pointer"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            {{ __('Action') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a
                                                class="dropdown-item has-icon"
                                                href="{{ route('admin.stores.edit', $store->id) }}"
                                            >
                                                <i class="fa fa-edit"></i>
                                                {{ __('Edit') }}
                                            </a>

                                            <a
                                                href="javascript:void(0)"
                                                class="dropdown-item has-icon delete-confirm"
                                                data-action="{{ route('admin.stores.destroy', $store->id) }}"
                                                data-method="DELETE"
                                            >
                                                <i class="fa fa-trash"></i>
                                                {{ __('Delete') }}
                                            </a>
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
    </div>
    <input type="hidden" id="get-stores-url" value="{{ route('admin.get-stores') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalStores()
    </script>
@endpush
