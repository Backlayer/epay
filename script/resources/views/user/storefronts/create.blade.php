@extends('layouts.user.master')

@section('title', __('Store fronts'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Store fronts create') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.storefronts.index') }}" class="btn btn-sm btn-neutral"><i class="fas fa-list"></i> {{ __('View list') }}</a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.storefronts.store') }}" method="post" class="ajaxform_instant_reload" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Store Name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ __("The name of your store") }}" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Shipping Status') }}</label>
                                    <select class="form-control custom-select" name="shipping_status" required="">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Disabled') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>{{ __('Store Logo') }} <span class="text-warning">{{ __('Recomend (150/50)') }}</span></label>
                                <input type="file" name="image" class="form-control" required="">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Delivery Note') }}</label>
                                    <select class="form-control custom-select" name="note_status" required="">
                                        <option value="0">{{ __("Disabled") }}</option>
                                        <option value="1">{{ __("Required") }}</option>
                                        <option value="2">{{ __("Optional") }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Product Type') }}</label>
                                    <select class="form-control custom-select" name="product_type" required="">
                                        <option value="0">{{ __("Physical") }}</option>
                                        <option value="1">{{ __("Digital") }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Store Description') }}</label>
                                    <textarea type="text" name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __('Create Store') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
