@extends('layouts.user.blank')

@section('title', __('Make Payment'))

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset($gateway->logo) }}" alt="" height="100">
                </div>
                <form action="#" method="post" name="payuForm" id="payment_form">
                    @csrf
                    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                    <input type="hidden" id="salt" value="{{ $Info['salt'] }}" />
                    <input type="hidden" name="key" id="key" value="{{ $Info['key'] }}" />
                    <input type="hidden" name="hash" id="hash" value="{{ $Info['hash'] }}" />
                    <input type="hidden" name="txnid" id="txnid" value="{{ $Info['txnid'] }}" />
                    <input type="hidden" name="amount" id="amount" value="{{ $Info['amount'] }}" />
                    <input type="hidden" name="firstname" id="firstname" value="{{ $Info['firstname'] }}" />
                    <input type="hidden" name="email" id="email" value="{{ $Info['email'] }}" />
                    <input type="hidden" name="phone" id="mobile" value="{{ $Info['phone'] }}" />
                    <input type="hidden" name="productinfo" id="productinfo" value="{{ $Info['productinfo'] }}" />
                    <input type="hidden" name="surl" id="surl" value="{{ $Info['surl'] }}" />
                    <input type="hidden" name="furl" id="furl" value="{{ $Info['furl'] }}" />
                    <div class="card-footer bg-white">
                        <input type="submit" class="btn btn-primary mt-4 col-12 w-100 btn-lg" value="Submit"
                            onclick="launchBOLT(); return false;" />
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('script')
    @if ($Info['test_mode'] == true)
        <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt- color="e34524"
            bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
    @else
        <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524"
            bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
    @endif
    <script>
        "use strict";
        launchBOLT();

        function launchBOLT() {
            var salt = $('#salt').val();
            var surl = $('#surl').val();
            bolt.launch({
                key: $('#key').val(),
                txnid: $('#txnid').val(),
                hash: $('#hash').val(),
                amount: $('#amount').val(),
                firstname: $('#firstname').val(),
                email: $('#email').val(),
                phone: $('#mobile').val(),
                productinfo: $('#productinfo').val(),
                udf5: $('#udf5').val(),
                surl: $('#surl').val(),
                furl: $('#surl').val(),
                mode: 'dropout'
            }, {
                responseHandler: function(BOLT) {
                    console.log(BOLT.response.txnStatus);
                    if (BOLT.response.txnStatus != 'CANCEL') {
                        // Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                        var fr = '<form action=\"' + surl + '\" method=\"post\">' +
                            '<input type=\"hidden\" name=\"key\" value=\"' + BOLT.response.key + '\" />' +
                            '<input type=\"hidden\" name=\"salt\" value=\"' + salt + '\" />' +
                            '<input type=\"hidden\" name=\"txnid\" value=\"' + BOLT.response.txnid + '\" />' +
                            '<input type=\"hidden\" name=\"amount\" value=\"' + BOLT.response.amount + '\" />' +
                            '<input type=\"hidden\" name=\"productinfo\" value=\"' + BOLT.response.productinfo +
                            '\" />' +
                            '<input type=\"hidden\" name=\"firstname\" value=\"' + BOLT.response.firstname +
                            '\" />' +
                            '<input type=\"hidden\" name=\"email\" value=\"' + BOLT.response.email + '\" />' +
                            '<input type=\"hidden\" name=\"udf5\" value=\"' + BOLT.response.udf5 + '\" />' +
                            '<input type=\"hidden\" name=\"mihpayid\" value=\"' + BOLT.response.mihpayid +
                            '\" />' +
                            '<input type=\"hidden\" name=\"status\" value=\"' + BOLT.response.status + '\" />' +
                            '<input type=\"hidden\" name=\"hash\" value=\"' + BOLT.response.hash + '\" />' +
                            '</form>';
                        var form = jQuery(fr);
                        jQuery('body').append(form);
                        form.submit();
                    }
                },
                catchException: function(BOLT) {
                    alert(BOLT.message);
                }
            });
        }
    </script>
@endpush
