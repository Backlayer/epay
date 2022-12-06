@extends('layouts.backend.app',[
     'prev'=> route('admin.settings.website.teams.index')
])

@section('title', __('Create Teams'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform_with_reset" method="post" action="{{ route('admin.settings.website.teams.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="lang" class="required">{{ __('Language') }}</label>
                            <select name="lang" id="lang" class="form-control" data-control="select2" data-placeholder="Select Language" required>
                                <option></option>
                                @foreach($languages->value as $key => $lang)
                                    <option value="{{ $key }}" @selected($key == current_locale())>{{ $lang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="icon" class="required">{{ __('Image') }}</label>
                            {{ mediasection([
                                 'input_name' => 'image',
                                 'input_id' => 'image',
                                 'preview_class' => 'image',
                             ]) }}
                        </div>

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Name') }}</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="designation" class="required">{{ __('Designation') }}</label>
                            <input type="text" name="designation" id="designation" class="form-control" required>
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
@section('modal')
    {{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
@endpush
