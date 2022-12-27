@extends('layouts.backend.app')

@section('title', __('Logo Setting'))


@section('content')
    <section class="section">
        <div class="section-body">
            <form action="{{ route('admin.settings.website.logo.update') }}" class="ajaxform" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Logo Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="background_image">{{ __('Logo') }}</label>
                                    {{ mediasection([
                                        'input_id' => 'logo',
                                        'input_name' => 'logo',
                                        'preview_class' => 'logo',
                                        'preview' => $option->logo ?? null,
                                        'value' => $option->logo ?? null
                                    ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="background_image">{{ __('Favicon') }}</label>
                                    {{ mediasection([
                                        'input_id' => 'favicon',
                                        'input_name' => 'favicon',
                                        'preview_class' => 'favicon',
                                        'preview' => $option->favicon ?? null,
                                        'value' => $option->favicon ?? null
                                    ]) }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('Save & Changes') }}</button>
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

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js ') }}"></script>
@endpush


