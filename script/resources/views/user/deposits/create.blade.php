@extends('layouts.user.blank')

@section('title', __('Make Deposits'))

@section('body')
    <div class="container py-5 deposit-payment">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-lg-6">
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
                                        <div class="text-center">
                                            <img src="{{ $gateway->logo }}" alt="{{ str($gateway->name)->upper() }}" width="60" height="30">
                                        </div>
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
                                    <form action="{{ route('user.deposit.make-payment', $gateway->id) }}" method="post" class="ajaxform_with_redirects" enctype="multipart/form-data">
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
                                            @if($gateway->charge)
                                            <tr>
                                                <th>{{ __('Gateway Charge') }}</th>
                                                <td>
                                                    {{ currency_format($gateway->charge, currency:$gateway->currency) }}
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>{{ __('Minimum Transaction Amount') }}</th>
                                                <td>
                                                    {{ currency_format($gateway->min_amount, currency:$gateway->currency) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Maximum Transaction Amount') }}</th>
                                                <td>
                                                    {{ currency_format($gateway->max_amount, currency:$gateway->currency) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Deposit Amount') }}</th>
                                                <td>
                                                    {{ currency_format(convert_money($amount, user_currency()) * $gateway->currency->rate, currency:$gateway->currency) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Gateway Rate') }}</th>
                                                <td>{{ $gateway->currency->symbol . $gateway->currency->rate  }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Payable') }} ({{ $gateway->currency->code }})</th>
                                                <td @class(['inr' => $gateway->currency->code == 'INR'])>
                                                    {{ $gateway->currency->symbol . number_format((convert_money($amount, user_currency()) * $gateway->currency->rate) + $gateway->charge, 2) }}
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
                                                        {{ $gateway->data ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <label for="comment">
                                                            {{ __('Comment') }}
                                                        </label>
                                                    </th>
                                                    <td>
                                                        <textarea class="form-control h-100" name="comment" ></textarea>
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-neutral mt-3 float-right">
                                            <i class="fas fa-hand-holding-usd"></i>
                                            {{ __('Make Payment') }}
                                        </button>
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

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter&display=swap" rel="stylesheet">
@endpush
