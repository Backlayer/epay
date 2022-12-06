@extends('layouts.user.master')

@section('title', __('Physical product edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Product create') }}</li>
@endsection

@section('actions')
<a href="{{ route('user.physical-products.index', ['action' => 'products']) }}" class="btn btn-sm btn-neutral"><i class="fa fa-eye" aria-hidden="true"></i> {{ __('View list') }}</a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.physical-products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ __("The name of your product") }}" required="" value="{{ $product->name }}">
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label>{{ __("Category") }}</label>
                                <select class="form-control custom-select" name="category_id" required="">
                                    <option value="">{{ __("Select Category") }}</option>
                                    @foreach ($categories as $categoiry)
                                    <option @selected($categoiry->id == $product->category_id) value="{{ $categoiry->id }}">{{ $categoiry->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label>{{ __('Price') }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </div>
                                    <input type="number" step="any" name="price" class="form-control pl-2" required="" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label>{{ __("Quantity") }}</label>
                                <input type="number" name="quantity" class="form-control" required="" value="{{ $product->quantity }}">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label>{{ __("Image") }}</label>
                                <input type="file" name="image" class="form-control" value="1">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="store">{{ __("Select Store") }}</label>
                                <select name="store_ids[]" id="store" data-toggle="select" multiple>
                                    @foreach ($stores as $store)
                                    <option @selected(in_array($store->id, $storeids->toArray())) value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 mb-4 summernote-css">
                                <label for="description">{{ __("Description") }}</label>
                                <textarea name="description" id="description" class="summernote" placeholder="{{ __("Product description") }}">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __("Update Product") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('user/vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
<script src="{{ asset('user/vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
@endpush
