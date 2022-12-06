@extends('layouts.frontend.master')

@section('title', __('Purchase payment'))

@section('body')
<div class="single-product-page-area mt-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="px-4">
                            <div class="text-center">
                                <img src="{{ asset($gateway->logo) }}" alt="" height="100">
                            </div>

                            <form action="{{ url('stripe/payment') }}" method="post" id="payment-form" class="paymentform p-4">
                                @csrf
                                <div class="form-row">
                                    <label for="card-element">
                                        {{ __('Credit or debit card') }}
                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-4" id="submit_btn">{{ __('Submit Payment') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="publishable_key" value="{{ $Info['publishable_key'] }}">

@endsection

@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        "use strict";
        var stripe_key = $('#publishable_key').val();
        var publishable_key = stripe_key;
        // Create a Stripe client.
        var stripe = Stripe(publishable_key);

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endpush
