@extends('layouts.backend.app', [
    'prev'=> route('admin.payment-gateways.index')
])

@section('title', __('Payment Gateway Edit'))

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Edit '. $gateway->name) }}</h4>
            </div>
            <form method="POST" action="{{ route('admin.payment-gateways.update', $gateway->id) }}" class="ajaxform">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="name">{{ __('Name') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="name" id="name" value="{{ $gateway->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="logo">{{ __('Logo') }}</label>
                        <div class="col-sm-12 col-md-7">

                            <input type="file" id="logo" class="form-control" name="logo">
                            @if ($gateway->logo != '')
                            <img src="{{ asset($gateway->logo) }}" height="30" alt="" class="image-thumbnail mt-2">
                            @endif
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
                                      
                                    >
                                        {{ $currency->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="code">{{ __('Code') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" id="code" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="rate"> {{ __('Rate') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input type="text" class="form-control" id="rate" readonly>
                        </div>
                    </div>
                    @if($gateway->is_auto == 1)
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="test_mode">{{ __('Sandbox Mode') }}</label>
                        <div class="col-sm-12 col-md-7">

                            <select class="form-control selectric" name="test_mode" id="test_mode">
                                <option value="1" {{ $gateway->test_mode == 1 ? 'selected' : '' }}>{{ __('Enable') }}</option>
                                <option value="0" {{ $gateway->test_mode == 0 ? 'selected' : '' }}>{{ __('Disable') }}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="min_amount">{{ __("Minimum Amount") }}</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text symbol"></span>
                                </div>
                                <input type="number" name="min_amount" id="min_amount" step="any" value="{{ $gateway->min_amount }}" class="form-control" placeholder="{{ __("Minimum transaction amount") }}" required>
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
                                <input type="number" name="max_amount" id="max_amount" step="any" value="{{ $gateway->max_amount }}" class="form-control" placeholder="{{ __("Maximum transaction amount") }}" required>
                            </div>
                        </div

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="charge">{{ __('Charge') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="charge" id="charge" value="{{ $gateway->charge ?? 0 }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="status"> {{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-7">
                             <select class="form-control selectric" name="status" id="status">
                                    <option value="1" {{ $gateway->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                    <option value="0" {{ $gateway->status == 0 ? 'selected' : '' }}>{{ __('Deactivate') }}</option>
                              </select>
                        </div>
                    </div>
                    @if($gateway->is_auto == 0)

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 required" for="payment_instruction">{{ __('Payment Instruction') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" name="payment_instruction" id="payment_instruction" required>{{ $gateway->data }}</textarea>
                        </div>
                    </div>
                    @else
                    @php $info = json_decode($gateway->data) @endphp
                     @foreach ($info ?? [] as $key => $cred)
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ ucwords(str_replace("_", " ", $key)) }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="data[{{ $key }}]" value="{{ $cred }}">
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('script')
    <script>
        "use strict";
        $('#currency').val({{$gateway->currency_id}})
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
