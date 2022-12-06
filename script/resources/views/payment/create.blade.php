@extends('layouts.user.blank')

@section('title', __('Purchase payment'))

@section('body')

@php
    $store = Session::get('store');
    $shipping = Session::get('shipping')['amount'] ?? 0;
@endphp

<div class="container py-5 product-payment">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Select a payment method') }}</h2>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        @foreach($gateways as $key => $gateway)
                            <li class="nav-item mt-2">
                                <a
                                    @class(['nav-link', 'active' => $loop->first])
                                    id="tab_{{ $key }}"
                                    data-toggle="tab"
                                    href="#tab_{{ $key }}_content"
                                    role="tab"
                                    aria-controls="{{ $key }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                >
                                    <img src="{{ $gateway->logo }}" alt="{{ str($gateway->name)->upper() }}" width="80">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content mt-4" id="myTabContent2">
                        @foreach($gateways as $key => $gateway)
                            <div
                                @class(['tab-pane fade show', 'active' => $loop->first])
                                id="tab_{{ $key }}_content"
                                role="tabpanel"
                                aria-labelledby="tab_{{ $key }}"
                            >
                                @php
                                    $total = convert_money(Cart::instance('shopping_'.$store->id)->subtotal() + $shipping, $store->user->currency) * $gateway->currency->rate
                                @endphp

                                <form action="{{ route('frontend.checkout.make-payment', $gateway->id) }}" method="post" class="ajaxform_with_redirects" enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <th>{{ __('Gateway Name') }}</th>
                                            <td>{{ str($gateway->name)->ucfirst() }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Gateway Currency') }}</th>
                                            <td>{{ $gateway->currency->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Total price') }}</th>
                                            <td>
                                                {{ currency_format($total, currency:$gateway->currency) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Gateway Charge') }}</th>
                                            <td>
                                                {{ currency_format($gateway->charge, currency:$gateway->currency) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>{{ __('Gateway Rate') }}</th>
                                            <td>
                                                {{ currency_format($gateway->currency->rate, currency:$gateway->currency) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Payable') }} ({{ $gateway->currency->code }})</th>
                                            <td @class(['inr' => $gateway->currency->code == 'INR'])>
                                                {{ currency_format($total + $gateway->charge, currency:$gateway->currency) }}
                                            </td>
                                        </tr>

                                        @if ($gateway->phone_required == 1)
                                            <tr>
                                                <th>
                                                    <label for="phone" class="required">{{ __('Phone Number') }}</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('Enter your phone number') }}" required>
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($gateway->image_accept == 1)
                                            <tr>
                                                <th>
                                                    <label for="screenshot" class="required">
                                                        {{ __('Upload Attachment') }}
                                                    </label>
                                                </th>
                                                <td>
                                                    <input type="file" name="screenshot" accept=".jpg,.png,.jpeg" class="form-control" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="comment">
                                                        {{ __('Payment Instructions') }}
                                                    </label>
                                                </th>
                                                <td>
                                                    <textarea class="form-control h-100" name="comment" id="" cols="30" rows="10"></textarea>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-end">
                                        <div class="col text-right">
                                            <button type="submit" class="mt-3 site-btn">
                                                <i class="fas fa-hand-holding-usd"></i>
                                                {{ __('Pay')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
