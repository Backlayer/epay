@extends('layouts.backend.app')

@section('title', __('Media'))

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Media Lists') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('login') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Media Lists') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.medias.delete') }}" method="POST" class="ajaxform_with_reload">
                            @csrf
                            <div class="card-body">
                                <div class="float-left">
                                    <div class="input-group mb-3">
                                        <select class="form-control selectric mr-3" tabindex="-1" name="status"
                                                aria-describedby="submit-button">
                                            <option selected disabled>{{ __('Select Action') }}</option>
                                            <option value="delete">{{ __('Delete Permanently') }}</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-lg basicbtn" id="submit-button">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive gallery">
                                    <table class="table table-striped">
                                        <tbody>
                                        <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('URL') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($posts as $media)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" name="id[]"
                                                               class="custom-control-input" value="{{ $media->id }}"
                                                               id="media-{{ $media->id }}">
                                                        <label for="media-{{ $media->id }}"
                                                               class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="gallery-item" data-image="{{ asset($media->url) }}" data-title="{{ $media->url }}"></div>
                                                </td>
                                                <td>
                                                    {{ asset($media->url) }}
                                                </td>
                                                <td>{{ $media->created_at->toDateString() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-left">
                                    {{ $posts->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush
