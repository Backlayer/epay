@extends('layouts.frontend.master')

@section('title', __('Purchase payment'))

@section('body')
<div class="single-product-page-area">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset($gateway->logo) }}" alt="" height="100">
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button class="btn btn-primary mt-4 col-12 btn-lg w-100" id="rzp-button1">{{ __('Pay Now') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ url('razorpay/status')}}" method="POST" hidden>
    <input type="hidden" value="{{csrf_token()}}" name="_token"/>
    <input type="text" class="form-control" id="rzp_paymentid" name="rzp_paymentid">
    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
    <button type="submit" id="rzp-paymentresponse" hidden class="btn btn-primary"></button>
</form>
<input type="hidden" value="{{ $response['razorpayId'] }}" id="razorpayId">
<input type="hidden" value="{{ $response['amount'] }}" id="amount">
<input type="hidden" value="{{ $response['currency'] }}" id="currency">
<input type="hidden" value="{{ $response['name'] }}" id="name">
<input type="hidden" value="{{ $response['description'] }}" id="description">
<input type="hidden" value="{{ $response['orderId'] }}" id="orderId">
<input type="hidden" value="{{ $response['name'] }}" id="name">
<input type="hidden" value="{{ $response['email'] }}" id="email">
<input type="hidden" value="{{ $response['contactNumber'] }}" id="contactNumber">
<input type="hidden" value="{{ $response['address'] }}" id="address">
@endsection

@push('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        "use strict";
        /*------------------------------
                Razorpay Intergration
            --------------------------------*/
        var logo = document.getElementById('logo');
        var options = {
            "key": $('#razorpayId').val(), // Enter the Key ID generated from the Dashboard
            "amount": $('#amount').val(), // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": $('#currency').val(),
            "name": $('#name').val(),
            "description": $('#description').val(),
            "image": logo, // You can give your logo url
            "order_id": $('#orderId').val(), //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response){
                // After payment successfully made response will come here
                // send this response to Controller for update the payment response
                // Create a form for send this data
                // Set the data in form
                document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
                document.getElementById('rzp_orderid').value = response.razorpay_order_id;
                document.getElementById('rzp_signature').value = response.razorpay_signature;

                // // Let's submit the form automatically
                document.getElementById('rzp-paymentresponse').click();
            },
            "prefill": {
                "name": $('#name').val(),
                "email": $('#email').val(),
                "contact": $('#contactNumber').val()
            },
            "notes": {
                "address": $('#address').val()
            },
            "theme": {
                "color": "#F37254"
            }
        };
        var rzp1 = new Razorpay(options);
        window.onload = function(){
            document.getElementById('rzp-button1').click();
        };

        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }

    </script>
@endpush
