@extends('layouts.backend.app')

@section('title','Update Terms of Service')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform_with_redirect" method="post" action="{{ route('admin.settings.website.term.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="content" class="required">{{ __('Content') }}</label>
                            <textarea name="content" id="content" class="summernote" required>{{ $term->content ?? null }}</textarea>
                        </div>

                        <button class="btn btn-primary basicbtn">
                            <i class="fas fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
@endpush
