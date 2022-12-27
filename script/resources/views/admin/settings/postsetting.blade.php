@extends('layouts.backend.app')

@section('title', __('Post Settings'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="{{ route('admin.post-settings.update') }}" class="ajaxform" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Post Settings') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="maximum_recording_time" class="required">{{ __('Maximum Recording Time (In Seconds)') }}</label>
                        <input type="number" id="maximum_recording_time" name="maximum_recording_time" class="form-control"
                               value="{{ $podcast->maximum_recording_time ?? null }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 float-right">
                        {{ __('Save & Changes') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('modal')
    {{ mediasingle() }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js ') }}"></script>
    <script src="{{ asset('admin/plugins/jqueryrepeater/jquery.repeater.min.js') }}"></script>
    <script>
        "use strict";
        $(document).ready(function () {
            $('.repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'amount': "",
                },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                    $(document).on('ready', function () {
                        setIndexes()
                    })
                },
                isFirstItemUndeletable: false
            })
        });
    </script>
@endpush


