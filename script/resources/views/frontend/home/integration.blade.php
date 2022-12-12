@if(isset($data['headings']['heading.integration']))
    @php
        $heading = $data['headings']['heading.integration'];
    @endphp
    <!-- Sass Business Area -->
    <div class="sass-business-area section-padding-100-50">
        <div class="container">
            <div class="row align-items-center">
                <!-- Sass text -->
                <div class="col-lg-5">
                    <div class="sass-text mb-50">
                        <h6>{{ $heading['short_title'] ?? null }}</h6>
                        <h2>{{ $heading['title'] ?? null }}</h2>
                        <p>{{ $heading['description'] ?? null }}</p>
                        <a class="hero-btn two mt-50" href="{{ $heading['button_url'] ?? null }}">
                            {{ $heading['button_text'] ?? null }}
                        </a>
                    </div>
                </div>

                <!-- Sass Tab Card Area -->
                <div class="col-lg-7">
                    <div class="sass-tab-card-area mb-50">
                        <ul class="nav nav-pills mb-4 tab-button-area justify-content-center" id="pills-tab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-curl" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">cUrl</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-nodejs" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">NodeJs - Request</button>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-ruby" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Ruby</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-python-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-python" type="button" role="tab" aria-controls="pills-python"
                                        aria-selected="false">Python</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-php-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-php" type="button" role="tab" aria-controls="pills-php"
                                        aria-selected="false">Php</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-java-tab" data-bs-toggle="pill"
                                        data-bs-target="#html" type="button" role="tab" aria-controls="pills-java"
                                        aria-selected="false">HTML</button>
                            </li>

                        </ul>
                        @php
                        $url=url('/');
                        @endphp
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-curl" role="tabpanel"
                                 aria-labelledby="pills-home-tab" tabindex="0">
                                <figure class="code-demo-card highlight">
                                 
                                        <pre class="language-markup text-white" tabindex="0">
                                          
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

                                </figure>
                            </div>

                            <div class="tab-pane fade show" id="pills-php" role="tabpanel"
                                 aria-labelledby="pills-home-tab" tabindex="0">
                                <figure class="code-demo-card highlight">
                                 
                                        <pre class="language-markup text-white" tabindex="0">
                                          
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

                                </figure>
                            </div>


                            <div class="tab-pane fade" id="html" role="tabpanel"
                                 aria-labelledby="pills-profile-tab" tabindex="0">
                                <figure class="code-demo-card highlight">
                                        <pre class="language-markup" tabindex="0">
                                            <code class="language-markup text-white">
{{ 
'<form method="POST" action="'.$url.'/api/payment/merchant/create" >
        <input type="hidden" name="token" value="MERCHANT_KEY" />
        <input type="hidden" name="public_key" value="PUBLIC_KEY" />
        <input type="hidden" name="callback_url" value="https://yourdomain.com/success" />
        <input type="hidden" name="reference_code" value="UNIQUE_REF_ID" />
        <input type="hidden" name="amount" value="100" />
        <input type="hidden" name="email" value="user@test.com" />
        <input type="hidden" name="first_name" value="John" />
        <input type="hidden" name="last_name" value="Doe" />
        <input type="hidden" name="title" value="Payment For Products" />
        <input type="hidden" name="description" value="The description of entire payments" />
        <input type="hidden" name="quantity" value="1" />
        <input type="hidden" name="currency" value="USD" />
        <input type="submit" value="submit" />
</form>' 
}}
                                           </code>
                                       </pre>
                                </figure>
                            </div>

                                 <div class="tab-pane fade" id="pills-nodejs" role="tabpanel"
                                 aria-labelledby="pills-profile-tab" tabindex="0">
                                <figure class="code-demo-card highlight">
                                        <pre class="language-markup" tabindex="0">
<code class="language-markup text-white">
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
                                </figure>
                            </div>
                            <div class="tab-pane fade" id="pills-ruby" role="tabpanel"
                                 aria-labelledby="pills-profile-tab" tabindex="0">
                                <figure class="code-demo-card highlight">
                                        <pre class="language-markup" tabindex="0">
<code class="language-markup text-white">
require "uri"
require "net/http"

url = URI({{ $url }}"/api/payment/create")

http = Net::HTTP.new(url.host, url.port);
request = Net::HTTP::Post.new(url)
form_data = [['token', 'MERCHANT_KEY'],['public_key', 'PUBLIC_KEY'],['callback_url', 'https://yourdomain.com/success'],['reference_code', 'ref_1'],['amount', '10'],['email', 'test@email.com'],['first_name', 'jhone '],['last_name', 'doe'],['title', 'test payment'],['description', 'payment description'],['quantity', '1'],['currency', 'USD']]
request.set_form form_data, 'multipart/form-data'
response = http.request(request)
puts response.read_body

</code></pre>
                                </figure>
                            </div>

 <div class="tab-pane fade" id="pills-python" role="tabpanel"
                                 aria-labelledby="pills-profile-tab" tabindex="0">
                                <figure class="code-demo-card highlight">
                                        <pre class="language-markup" tabindex="0">
<code class="language-markup text-white">
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
                                </figure>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sass Business Area -->
@else

@endif
