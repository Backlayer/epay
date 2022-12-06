@extends('layouts.backend.app', [
    'prev' => route('admin.payment-gateways.index')
])

@section('title', __('Create New Gateway'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-12">
                    <h4>{{ __('Create New Payment Gateway') }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.payment-gateways.store') }}" class="ajaxform_with_reset">
                @csrf
                    <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="name">{{ __('Name') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="logo">{{ __('Logo') }}</label>
                        <div class="col-sm-12 col-md-7">
                             <input type="file" id="logo" class="form-control" name="logo" accept="image/*" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="currency">{{ __('Currency') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="currency" id="currency">
                               @foreach($currencies as $currency)
                                    <option
                                        value="{{ $currency->id }}"
                                        data-rate="{{ $currency->rate }}"
                                        data-code="{{ $currency->code }}"
                                        data-symbol="{{ $currency->symbol }}"
                                    >{{ $currency->name }}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Code') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" id="code" readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Rate') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" id="rate" readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="min_amount">{{ __("Minimum Amount") }}</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text symbol"></span>
                                </div>
                                <input type="number" name="min_amount" id="min_amount" step="any" class="form-control" placeholder="{{ __("Minimum transaction amount") }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="min_amount">{{ __("Maximum Amount") }}</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text symbol"></span>
                                </div>
                                <input type="number" name="max_amount" id="max_amount" step="any" class="form-control" placeholder="{{ __("Maximum transaction amount") }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="charge">{{ __('Charge') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" step="any" class="form-control" name="charge" id="charge" value="0" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="status">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-7">

                           <select class="form-control selectric" name="status" id="status">
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Inactive') }}</option>
                           </select>
                        </div>
                    </div>

                     <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="instruction">{{ __('Payment Instruction') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" name="instruction" id="instruction" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary basicbtn">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        "use strict";
        setText();
        $('#currency').on('change', function(){
            setText()
        });

        function setText() {
            var rate = $('#currency').find(':selected').data('rate');
            var code = $('#currency').find(':selected').data('code');
            var symbol = $('#currency').find(':selected').data('symbol');
            $('#rate').val(rate)
            $('#code').val(code)
            $('.symbol').html(symbol)
        }
    </script>
@endpush
