@extends('layouts.backend.app', [
    'prev' => route('admin.stores.index')
])

@section('title', __('Store Edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.stores.update', $store->id) }}" method="post" class="ajaxform_with_redirect" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Store Name') }}</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ __("The name of your store") }}" value="{{ $store->name }}" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Shipping Status') }}</label>
                                <select class="form-control custom-select" name="shipping_status" required="">
                                    <option @selected($store->shipping_status == 1) value="1">{{ __('Active') }}</option>
                                    <option @selected($store->shipping_status == 0) value="0">{{ __('Disabled') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>{{ __('Store Logo') }} <span class="text-warning">{{ __('Recomend (150/50)') }}</span></label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Delivery Note') }}</label>
                                <select class="form-control custom-select" name="note_status" required="">
                                    <option @selected($store->note_status == 0) value="0">{{ __("Disabled") }}</option>
                                    <option @selected($store->note_status == 1) value="1">{{ __("Required") }}</option>
                                    <option @selected($store->note_status == 2) value="2">{{ __("Optional") }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Product Type') }}</label>
                                <select class="form-control custom-select" name="product_type" required="">
                                    <option @selected($store->product_type == 0) value="0">{{ __("Physical") }}</option>
                                    <option @selected($store->product_type == 1) value="1">{{ __("Digital") }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Status') }}</label>
                                <select class="form-control custom-select" name="status" required="">
                                    <option @selected($store->status == 0) value="0">{{ __("Desabled") }}</option>
                                    <option @selected($store->status == 1) value="1">{{ __("Active") }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Store Description') }}</label>
                                <textarea type="text" name="description" class="form-control">{{ $store->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-block basicbtn">{{ __('Update Store') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
