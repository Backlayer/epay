@extends('layouts.backend.app', [
    'prev'=> route('admin.page.index')
])

@section('title', __('Edit Page'))

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit Page') }}</h4>
                </div>

                @php
                    $info = json_decode($page_edit->page->value);
                @endphp
                <form method="POST" action="{{ route('admin.page.update', $page_edit->id) }}"
                      enctype="multipart/form-data" class="ajaxform">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Page Title') }}</label>
                            <input type="text" class="form-control" placeholder="Page Title" required name="page_title"
                                   value="{{ $page_edit->title }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Page excerpt') }}</label>
                            <textarea name="page_excerpt" cols="30" rows="10"
                                      class="form-control">{{ $info->page_excerpt }}</textarea>
                        </div>
                        <div class="from-group row mb-2">
                            <label >{{ __('Meta Keywords ') }} </label>
                            <div class="col-lg-12">
                                <textarea name="metatag" cols="30" rows="10" class="form-control">{{ $info->metatag ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="from-group row mb-2">
                            <label>{{ __('Meta Description ') }} </label>
                            <div class="col-lg-12">
                                <textarea name="metadescription" cols="30" rows="10" class="form-control">{{ $info->metadescription ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Page Content') }}</label>
                            <textarea name="page_content" class="summernote">{{ $info->page_content }}</textarea>
                        </div>
                    </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="single-area">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-publish">
                            <button type="submit"
                                    class="btn btn-primary btn-lg float-right w-100 basicbtn">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="btn-publish">
                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control ">
                                <option
                                    value="1" {{ ($page_edit->status == 1) ? 'selected' : '' }}>{{ __('Active') }}</option>
                                <option
                                    value="0" {{ ($page_edit->status == 0) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
@endpush
