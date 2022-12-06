@extends('layouts.user.blank')

@section('title', __('PayStack Payment'))

@section('body')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset($gateway->logo) }}" alt="" height="100">
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button class="btn btn-primary mt-4 col-12 w-100 btn-lg"
                            id="payment_btn">{{ __('Pay Now') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" class="status" action="{{ route('user.paystack.status') }}">
        @csrf
        <input type="hidden" name="ref_id" id="ref_id">
        <input type="hidden" value="{{ $Info['currency'] }}" id="currency">
        <input type="hidden" value="{{ $Info['amount'] }}" id="amount">
        <input type="hidden" value="{{ $Info['public_key'] }}" id="public_key">
        <input type="hidden" value="{{ $Info['email'] ?? Auth::user()->email }}" id="email">
    </form>
@endsection


@push('script')
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        "use strict";

        $('#payment_btn').on('click', () => {
            payWithPaystack();
        });
        payWithPaystack();

        function payWithPaystack() {
            var amont = $('#amount').val() * 100;
            let handler = PaystackPop.setup({
                key: $('#public_key').val(), // Replace with your public key
                email: $('#email').val(),
                amount: amont,
                currency: $('#currency').val(),
                ref: 'ps_{{ Str::random(15) }}',
                onClose: function() {
                    payWithPaystack();
                },
                callback: function(response) {
                    $('#ref_id').val(response.reference);
                    $('.status').submit();
                }
            });
            handler.openIframe();
        }
    </script>
@endpush
