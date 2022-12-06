@extends('layouts.user.master')

@section('title', __('Website Integration Documentation'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Website Integration') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.websites.create') }}" class="btn btn-sm btn-neutral">
        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New Website') }}
    </a>
    <a href="{{ route('user.plans.create') }}" class="btn btn-sm btn-neutral">
        <i class="fas fa-file"></i>
        {{ __('Documentation') }}
    </a>
@endsection

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-12">
                                <h3 class="font-weight-bolder">{{__('Integrating Website Payment')}}</h3>
                            </div>
                        </div>
                        <div class="align-item-sm-center flex-sm-nowrap text-left">
                            <p class="text-xs mb-1">
                                {{ __('Receiving money on your website is now easy with simple integration at a fee of 2% per transaction.') }}
                                {{__('This document will introduce you to all the basic information you need to better understand our technologies. To start receiving payment on your website, or you need to do is copy the html form code below to your website page')}}</p>
                            <div class="row">
                                <div class="col">
                                    <figure class="highlight">
                                        <pre class="language-html">
                                        <code class="language-html">
    &lt;form method="POST" action="{{ route('api.merchant.store') }}" &gt;
        &lt;input type="hidden" name="token" value="MERCHANT_KEY" /&gt;
        &lt;input type="hidden" name="public_key" value="PUBLIC_KEY" /&gt;
        &lt;input type="hidden" name="callback_url" value="https://example.com/success" /&gt;
        &lt;input type="hidden" name="reference_code" value="REF_000001" /&gt;
        &lt;input type="hidden" name="amount" value="10000" /&gt;
        &lt;input type="hidden" name="email" value="user@test.com" /&gt;
        &lt;input type="hidden" name="first_name" value="John" /&gt;
        &lt;input type="hidden" name="last_name" value="Doe" /&gt;
        &lt;input type="hidden" name="title" value="Payment For Products" /&gt;
        &lt;input type="hidden" name="description" value="The description of entire payments" /&gt;
        &lt;input type="hidden" name="quantity" value="10" /&gt;
        &lt;input type="hidden" name="currency" value="{{ Auth::user()->currency->code }}" /&gt;
        &lt;input type="submit" value="submit" /&gt;
    &lt;/form&gt;
                                            </code>
                                    </pre>
                                    </figure>
                                    <button
                                        type="button"
                                        class="btn btn-dark clipboard-button"
                                        data-message="{{ __(':name copied to clipboard', ['name' => __('Form element')]) }}"
                                        data-clipboard-text='
<form method="POST" action="{{ route('api.merchant.store') }}" >
    <input type="hidden" name="token" value="MERCHANT_KEY" />
    <input type="hidden" name="public_key" value="{{ Auth::user()->public_key ?? 'PUBLIC_KEY' }}" />
    <input type="hidden" name="callback_url" value="https://example.com/success" />
    <input type="hidden" name="reference_code" value="REF_000001" />
    <input type="hidden" name="amount" value="500" />
    <input type="hidden" name="email" value="user@test.com" />
    <input type="hidden" name="first_name" value="John" />
    <input type="hidden" name="last_name" value="Deo" />
    <input type="hidden" name="title" value="Payment For Products" />
    <input type="hidden" name="description" value="The description of entire payments" />
    <input type="hidden" name="quantity" value="5" />
    <input type="hidden" name="currency" value="{{ Auth::user()->currency->code }}" />
    <input type="submit" value="submit" />
</form>'
                                        title="Copy code"
                                    >
                                        <i class="fas fa-clipboard"></i>
                                        {{__('COPY CODE')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 font-weight-bolder">{{__('Using Postman')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <h3 class="font-weight-bolder">Create Payment Request</h3>
                            @php
                            $url=url('/');
                            @endphp
                           <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" data-target="#curl" type="button" role="tab" aria-controls="home" aria-selected="true">cUrl</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#php" type="button" role="tab" aria-controls="profile" aria-selected="false">Php</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#nodejs" type="button" role="tab" aria-controls="profile" aria-selected="false">NodeJs - Request</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" data-target="#python" type="button" role="tab" aria-controls="contact" aria-selected="false">Python</a>
  </li>
</ul>

<div class="tab-content mt-4" id="myTabContent">
<div class="tab-pane fade show active" id="curl" role="tabpanel" aria-labelledby="home-tab">
<pre class="language-markup" tabindex="0">
curl --location --request POST {{$url}}'/api/payment/create' \
--form 'token="MERCHANT_KEY"' \
--form 'public_key="PUBLIC_KEY"' \
--form 'callback_url="yourodmain.com/redirect"' \
--form 'reference_code="ref_1"' \
--form 'amount="10"' \
--form 'email="test@email.com"' \
--form 'first_name="jhone "' \
--form 'last_name="doe"' \
--form 'title="test payment"' \
--form 'description="payment description"' \
--form 'quantity="1"' \
--form 'currency="USD"'
</pre>
</div>
  <div class="tab-pane fade" id="php" role="tabpanel" aria-labelledby="profile-tab">
      <pre class="language-markup" tabindex="1">

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => {{ $url }}'/api/payment/create',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
    'token' => 'MERCHANT_KEY',
    'public_key' => 'PUBLIC_KEY',
    'callback_url' => 'yourodmain.com/redirect',
    'reference_code' => 'ref_1',
    'amount' => '10',
    'email' => 'test@email.com',
    'first_name' => 'jhone ',
    'last_name' => 'doe',
    'title' => 'test payment',
    'description' => 'payment description',
    'quantity' => '1',
    'currency' => 'USD'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

                                       </pre>
  </div>
  <div class="tab-pane fade" id="nodejs" role="tabpanel" aria-labelledby="contact-tab">
      <pre class="language-markup" tabindex="2">
<code class="language-markup">
var request = require('request');
var options = {
  'method': 'POST',
  'url': {{ $url }}'/api/payment/create',
  'headers': {
  },
  formData: {
    'token': 'MERCHANT_KEY',
    'public_key': 'PUBLIC_KEY',
    'callback_url': 'https://yourdomain.com/success',
    'reference_code': 'ref_1',
    'amount': '10',
    'email': 'test@email.com',
    'first_name': 'jhone ',
    'last_name': 'doe',
    'title': 'test payment',
    'description': 'payment description',
    'quantity': '1',
    'currency': 'USD'
  }
};
request(options, function (error, response) {
  if (error) throw new Error(error);
  console.log(response.body);
});
</code></pre>

  </div>
  <div class="tab-pane fade" id="python" role="tabpanel" aria-labelledby="contact-tab">
       <pre class="language-markup" tabindex="3">
<code class="language-markup">
import requests

url = {{ $url }}"/api/payment/create"

payload={'token': 'MERCHANT_KEY',
'public_key': 'PUBLIC_KEY',
'callback_url': 'https://yourdomain.com/success',
'reference_code': 'ref_1',
'amount': '10',
'email': 'test@email.com',
'first_name': 'jhone ',
'last_name': 'doe',
'title': 'test payment',
'description': 'payment description',
'quantity': '1',
'currency': 'USD'}
files=[

]
headers = {}

response = requests.request("POST", url, headers=headers, data=payload, files=files)

print(response.text)


</code></pre>
  </div>


</div>
                        </div>

                        <h3 class="font-weight-bolder">{{__('Successful Json Callback')}}</h3>
                        <pre>
                        <code>
    {
        "message": "Order Created Successfully",
        "status": "success",
        "redirect": "https://example.com/merchant/1/0fc073ef-73e9-42f1-9ebe-ca3383d1b37a",
        "data": {
            "user_id": 3,
            "website_id": 1,
            "currency_id": 4,
            "reference_code": "REF_000002",
            "amount": "1000",
            "quantity": "5",
            "meta": {
                "title": "Payment for product purchasing",
                "first_name": "John",
                "last_name": "Deo",
                "description": "The description of entire payments",
                "callback_url": "https://example.com/success",
                "ip_address": "127.0.0.1",
                "user-agent": "PostmanRuntime/7.29.2"
            },
            "uuid": "0fc073ef-73e9-42f1-9ebe-ca3383d1b37a",
            "updated_at": "2022-08-22T05:47:04.000000Z",
            "created_at": "2022-08-22T05:47:04.000000Z",
            "id": 1
        }
    }
                        </code>
                    </pre>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 font-weight-bolder">{{__('Verifying payment')}}</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-sm">{{__('Depending on your callback url is not fully secure, ensure you verify payment with our api before going further.')}}</p>
                        <pre>
                        <code>
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, '{{url('/')}}/api/payment/merchant/verify/{REFERENCE_KEY}/{SECRET_KEY}');
    $result = curl_exec($ch);
    curl_close($ch);
    $obj=json_decode($result, true);
    //Verify Payment
    if (array_key_exists("data", $obj)  && ($obj["status"] == "success")) {
        echo 'success';
    }
                        </code>
                    </pre>
                        <p class="text-sm text-dark mb-3">
                            <button
                                type="button"
                                class="btn btn-dark clipboard-button"
                                data-message="{{ __(':name copied to clipboard', ['name' => __('Verify payment')]) }}"
                                data-clipboard-text='
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, fadse);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, '{{url('/')}}/api/payment/merchant/verify/{REFERENCE_KEY}/{SECRET_KEY}');
    $result = curl_exec($ch);
    curl_close($ch);
    $obj=json_decode($result, true);
    //Verify Payment
    if (array_key_exists("data", $obj) && ($obj["status"] == "success")) {
        echo "success";
    }'
                                title="Copy code"
                            >
                                <i class="fas fa-clipboard"></i>
                                {{__('COPY CODE')}}
                            </button>
                        </p>
                        <h3 class="mb-0 font-weight-bolder">{{__('Successful Json Callback')}}</h3>
                        <pre>
                        <code>
    {
    "message": "The payment status is paid",
    "status": "success",
    "data": {
        "id": 1,
        "uuid": "e020c9cb-b35e-4ec7-97bb-5020bc5b5066",
        "user_id": 2,
        "website_id": 1,
        "currency_id": 1,
        "gateway_id": 3,
        "trx": "tr_CAK8r7eY5z",
        "reference_code": "REF-000001",
        "amount": 100,
        "charge": -28,
        "rate": 1,
        "quantity": 5,
        "meta": {
            "ip": "127.0.0.1",
            "title": "Payment For Products",
            "last_name": "Adhikary",
            "first_name": "Bishwajit",
            "user-agent": "PostmanRuntime/7.29.2",
            "description": "test description",
            "callback_url": "http://example.com/callback"
        },
        "paid_at": "2022-08-07 19:26:25",
        "payment_status": 1,
        "created_at": "2022-08-07T13:23:52.000000Z",
        "updated_at": "2022-08-07T13:26:25.000000Z",
        "website": {
            "id": 1,
            "user_id": 2,
            "merchant_name": "Julie Little",
            "token": "2YY3YQfcZbCOOnb8V5GvCAVR77AujpVf",
            "email": "fyze@mailinator.com",
            "mode": 1,
            "message": "Asperiores vel volup",
            "created_at": "2022-08-07T13:08:56.000000Z",
            "updated_at": "2022-08-07T13:21:25.000000Z"
        }
    }
}
                        </code>
                    </pre>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 font-weight-bolder">{{__('Requirements')}}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush">
                            <thead class="">
                            <tr>
                                <th>{{__('S/N')}}</th>
                                <th>{{__('Value')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Required')}}</th>
                                <th>{{__('Description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{__('1.')}}</td>
                                <td>{{__('token')}}</td>
                                <td>{{__('string')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("Used to authorize a transaction") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('2.')}}</td>
                                <td>{{__('callback_url')}}</td>
                                <td>{{__('url')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("This is a callback endpoint you provide ") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('3.')}}</td>
                                <td>{{__('reference_code')}}</td>
                                <td>{{__('string')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("This is the merchant reference tied to a transaction") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('5.')}}</td>
                                <td>{{__('amount')}}</td>
                                <td>{{__('int [Above 0.50 cents]')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("Cost of Item Purchased") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('6.')}}</td>
                                <td>{{__('email')}}</td>
                                <td>{{__('string')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("Email of Client making payment") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('7.')}}</td>
                                <td>{{__('first_name')}}</td>
                                <td>{{__('string, max:100')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("First name of Client making payment") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('8.')}}</td>
                                <td>{{__('last_name')}}</td>
                                <td>{{__('string, max:100')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("last name of Client making payment") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('9.')}}</td>
                                <td>{{__('title')}}</td>
                                <td>{{__('string, max:255')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("Title of transaction") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('10.')}}</td>
                                <td>{{__('description')}}</td>
                                <td>{{__('string, max:1000')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("Description of what transaction is for") }}</td>
                            </tr>
                            <tr>
                                <td>{{__('11.')}}</td>
                                <td>{{__('currency')}}</td>
                                <td>{{__('string')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("This is the currency the transaction list should come in :code", ['code' => Auth::user()->currency->code]) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('12.')}}</td>
                                <td>{{__('quantity')}}</td>
                                <td>{{__('int')}}</td>
                                <td>{{__('Yes')}}</td>
                                <td>{{ __("Quantity of Item being paid for") }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
@endpush
