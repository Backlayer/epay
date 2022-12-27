@extends('layouts.backend.app')

@section('title', __('About Page Settings'))

@section('content')
    <section class="section">
        <div class="section-body">
            <form action="{{ route('admin.settings.website.about.update') }}" class="ajaxform" method="POST">
                @csrf
                @method("PUT")
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('About Page Settings') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $about->title ?? null }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea id="description" name="description" class="form-control">{{ $about->description ?? null }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image" class="required">{{ __('Image') }}</label>
                                    {{ mediasection([
                                        'input_name' => 'image',
                                        'preview' => $about->image,
                                        'value' => $about->image
                                    ]) }}
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
