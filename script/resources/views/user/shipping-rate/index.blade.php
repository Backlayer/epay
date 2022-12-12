@extends('layouts.user.master')

@section('title', __('Shipping Regions & Rate'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __(' Shipping Regions & Rate') }}</li>
@endsection

@section('actions')
    <a data-toggle="modal" data-target="#new-shipping" href="" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> {{ __('New Add Shipping Fee') }}</a>
@endsection

@section('content')
    <div class="row search-table">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-2">
                    <h4></h4>
                    <form action="{{ route('user.shipping-rate.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name/Price">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive py-3">
                    <table class="table table-flush">
                        <thead>
                            <tr>
                                <th>{{ __('S / N') }}</th>
                                <th>{{ __('Region') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippings as $shipping)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $shipping->region }}</td>
                                <td>{{ currency_format($shipping->amount, currency:user_currency()) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-shipping" data-shipping="{{ $shipping }}" data-url="{{ request()->url() }}" href="#"><i class="fas fa-edit mr-1"></i>  {{ __('Edit') }}</a>

                                            <a class="dropdown-item confirm-action" href="#"
                                                data-action="{{ route('user.shipping-rate.destroy', $shipping->id) }}"
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
                        {{ $shippings->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('modal')
        <div class="modal fade" id="new-shipping" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-0 pb-0">
                        <h3 class="modal-title font-weight-bolder">{{ __('Create Shipping fee') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.shipping-rate.store') }}" method="post" class="ajaxform_instant_reload">
                            @csrf

                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{ __('Region') }}</label>
                                <div class="col-lg-12">
                                    <input type="text" name="region" class="form-control" placeholder="{{ __("Dhaka, Bangladesh") }}" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" placeholder="0.00" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __('Create Shipping Fee') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-shipping" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-0 pb-0">
                        <h3 class="modal-title font-weight-bolder">{{ __('Edit Shipping fee') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="ajaxform_instant_reload edit-shipping-form">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{ __('Region') }}</label>
                                <div class="col-lg-12">
                                    <input type="text" name="region" id="region" class="form-control" placeholder="{{ __("Dhaka, Bangladesh") }}" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="0.00" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __('Update Shipping') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    <input type="hidden" value="{{ route('user.shipping-rate.index') }}" id="shipping-url">
@endsection
