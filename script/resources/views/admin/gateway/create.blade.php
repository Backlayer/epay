@extends('layouts.backend.app', [
    'prev' => route('admin.payment-gateways.index'),
])

@section('title', __('Create New Gateway'))

@section('content')
    <form action="{{ route('admin.payment-gateways.store') }}" method="POST" class="ajaxform_with_redirect repeater">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="name">
                                {{ __('Name') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="logo">
                                {{ __('Logo') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" id="logo" class="form-control" name="logo" accept="image/*"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="currency">
                                {{ __('Currency') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="currency" id="currency">
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}" data-rate="{{ $currency->rate }}"
                                            data-code="{{ $currency->code }}" data-symbol="{{ $currency->symbol }}">
                                            {{ $currency->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                {{ __('Code') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" id="code" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                {{ __('Rate') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" id="rate" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="is_auto">
                                {{ __('Auto Approved') }}
                            </label>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center">
                                <input class="form-check-input gateways" name="is_auto" type="checkbox" value="1"
                                    id="is_auto">
                            </div>
                        </div>
                        <div class="form-group row mb-4 d-none">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="data">
                                {{ __('Data object used by the Gateway') }}
                            </label>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center">
                                <json-editor indent="4"></json-editor>
                                <textarea name="data" id="data" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="min_amount">
                                {{ __('Minimum Amount') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text symbol"></span>
                                    </div>
                                    <input type="number" name="min_amount" id="min_amount" step="any"
                                        class="form-control" placeholder="{{ __('Minimum transaction amount') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="min_amount">
                                {{ __('Maximum Amount') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text symbol"></span>
                                    </div>
                                    <input type="number" name="max_amount" id="max_amount" step="any"
                                        class="form-control" placeholder="{{ __('Maximum transaction amount') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="charge">
                                {{ __('Charge') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" step="any" class="form-control" name="charge" id="charge"
                                    value="0" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="status">
                                {{ __('Status') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="status" id="status">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="instructions">
                                {{ __('Payment Instruction') }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote" name="instructions" id="instructions"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary basicbtn">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Document Fields') }}</h4>

                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-repeater-create>
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body overflow-auto repeaters h-100" data-repeater-list="fields">
                        <div class="form-group">
                            <div class="input-group row mx-0">
                                <h5 class="col-4 col-form-label">{{ __('Label') }}</h5>
                                <h5 class="col-4 col-form-label">{{ __('Type') }}</h5>
                                <h5 class="col-2 col-form-label">{{ __('Is Required?') }}</h5>
                                <h5 class="col-2 col-form-label">{{ __('Action') }}</h5>
                            </div>
                        </div>

                        <div class="form-group" data-repeater-item>
                            <div class="input-group row mx-0">
                                <input type="text" name="label" class="form-control col-4"
                                    placeholder="{{ __('Enter input label') }}" aria-label="" required>

                                <select name="type" class="form-control col-4" required>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ ucwords($type) }}</option>
                                    @endforeach
                                </select>

                                <div class="form-check col-2 d-flex align-items-center justify-content-center">
                                    <input class="form-check-input gateways" name="isRequired" type="checkbox"
                                        value="true" id="checkDefault">
                                </div>

                                <div class="input-group-append col-2">
                                    <button type="button" class="btn btn-danger" data-repeater-delete>
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqueryrepeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/json-editor.js') }}"></script>
    <script src="{{ asset('admin/pages/gateway.js') }}"></script>
    <script>
        "use strict";

        setText();
        
        $('#currency').on('change', function() {
            setText()
        });

        if (window.JSON_Editor) {
            $(window.JSON_Editor).on('keyup', function() {
                const value = $(this).text()

                $('#data').val(value)
            })
        }

        $('#is_auto').on('change', function() {
            const container = $('#data').parent().parent()

            if ($(this).is(':checked')) {
                container.removeClass('d-none')
            } else {
                $('#data').val('')
                $(window.JSON_Editor).html('')

                container.addClass('d-none')
            }
        })

        function setText() {
            const rate = $('#currency').find(':selected').data('rate');
            const code = $('#currency').find(':selected').data('code');
            const symbol = $('#currency').find(':selected').data('symbol');

            $('#rate').val(rate)
            $('#code').val(code)
            $('.symbol').html(symbol)
        }
    </script>
@endpush
