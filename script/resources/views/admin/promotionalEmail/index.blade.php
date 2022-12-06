@extends('layouts.backend.app')

@section('title', __('Promotional Email'))

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __("Send email to all users") }}</h5>

            <form action="{{ route('admin.promotional-email.send-email') }}" method="post" class="ajaxform_with_reset">
                @csrf
                <div class="form-group">
                    <label for="subject" class="required">{{ __("Subject") }}</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __("Enter subject") }}" required>
                </div>

                <div class="form-group">
                    <label for="message" class="required">{{ __("Message") }}</label>
                    <textarea name="message" id="message" class="summernote" placeholder="{{ __("Enter message") }}" required></textarea>
                </div>

                <button class="btn btn-primary float-right submit-button basicbtn">
                    <i class="fas fa-paper-plane"></i>
                    {{ __("Send") }}
                </button>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
@endpush
