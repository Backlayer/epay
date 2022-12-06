@extends('layouts.user.master')

@section('title', __('Categories'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Categories list') }}</li>
@endsection

@section('actions')
    <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-sm btn-neutral"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add new category') }}</a>
@endsection

@section('content')
    <div class="row search-table">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-2">
                    <h4></h4>
                    <form action="{{ route('user.categories.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Category name") }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-flush">
                    <thead>
                        <tr>
                            <th>{{ __('S / N') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ formatted_date($category->created_at) }}</td>
                            <td>
                                <a href="javascript:void(0)" class="text-warning edit-category" data-category="{{ $category }}"><i class="fas fa-edit mr-1"></i></a>

                                <a class="confirm-action text-danger" href="#" data-action="{{ route('user.categories.destroy', $category->id) }}" data-method="DELETE" data-icon="fas fa-trash" >
                                    <i class="fas fa-trash mr-1"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-body pb-0">
                    {{ $categories->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @push('modal')
    <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <h3 class="mb-0 font-weight-bolder">{{ __('Add category') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.categories.store') }}" method="post" class="ajaxform_instant_reload">
                        @csrf

                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{ __('Name') }}</label>
                            <div class="col-lg-12">
                                <input type="text" name="title" class="form-control" placeholder="{{ __("Name of Category") }}" required="">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __('Create Category') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <h3 class="mb-0 font-weight-bolder">{{ __('Edit category') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.categories.index') }}" method="post" class="ajaxform_instant_reload edit-category-form">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{ __('Name') }}</label>
                            <div class="col-lg-12">
                                <input type="text" name="title" class="form-control category-title" placeholder="{{ __("Name of category") }}" required="">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-block submit-btn">{{ __('Update category') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endpush
@endsection
