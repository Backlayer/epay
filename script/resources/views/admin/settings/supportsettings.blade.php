@extends('layouts.backend.app')

@section('title', __('Support Settings'))

@section('content')
    <section class="section">

        <div class="section-body">
            <form action="{{ route('admin.support-setting.update') }}" class="ajaxform" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Support Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">{{ __('Support Icon') }}</label>
                                    {{ mediasection([
                                        'input_id' => 'icon',
                                        'input_name' => 'icon',
                                        'preview_class' => 'icon',
                                        'preview' => $support->icon ?? null,
                                        'value' => $support->icon ?? null
                                    ]) }}
                                </div>
                            </div>

                            <div class="col-md-6 repeater">
                                <div class="form-group">
                                    <label for="title" class="required">{{ __('Title') }}</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $support->title ?? null }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="default_price" class="required">{{ __('Default Price') }}</label>
                                    <input type="number" id="default_price" name="default_price" min="1" step="any" class="form-control" value="{{ $support->default_price ?? null }}" required>
                                </div>

                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label for="">{{ __("Amount Counters") }}</label>
                                        <button class="btn btn-primary btn-sm rounded-circle" type="button" data-repeater-create>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="row" data-repeater-list="amounts">
                                        @if($support->amounts)
                                            @foreach($support->amounts ?? [] > 0 as $counter)
                                                <div class="col-sm-6" data-repeater-item>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="amount" class="form-control counter" value="{{ $counter }}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-danger" type="button" data-repeater-delete>
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-sm-6" data-repeater-item>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="amount" class="form-control counter" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm btn-danger" type="button" data-repeater-delete>
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 float-right">
                            {{ __('Save & Changes') }}
                        </button>
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


