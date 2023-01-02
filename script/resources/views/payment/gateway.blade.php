@extends('layouts.user.blank')

@section('body')
    <div class="main-content">
        <div class="container pt-lg-7 pt-md-2 mb-0">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="card bg-gradient-white">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <img src="{{ $gateway->logo }}" alt="{{ $gateway->name }}" style="height: 150px; width: auto;" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <h6 class="h2 d-inline-block mb-0">{{ __('Payment Instructions') }}</h6>
                                <small class="text-mute text-danger d-block">{{ __('Use the following information to make your payment') }}</small>

                                <table class="table table-bordered mb-4">
                                    <tbody class="list">
                                        <tr>
                                            <th>{{ __("Gateway Name") }}</th>
                                            <td>{{ ucwords($gateway->name) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Gateway Currency") }}</th>
                                            <td>{{ $gateway->currency->name }} ({{ $gateway->currency->code }})</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Amount") }}</th>
                                            <td>
                                                @if($source->currency_id !== $gateway->currency_id)
                                                    {{ currency_format($amount, currency: $source->currency) }}  =
                                                @endif

                                                @if(Auth::check())
                                                    {{ convert_money_direct($amount, $singleCharge->currency, $gateway->currency, true) }}
                                                @else
                                                    {{ currency_format($amount, $gateway->currency) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Gateway Charge") }}</th>
                                            <td>
                                                {{ currency_format($gateway->charge, currency: $gateway->currency) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Total') }}</th>
                                            <td>
                                                @php
                                                    $source->amountForGateway = convert_money_direct($amount, $source->currency, $gateway->currency);
                                                @endphp
                                                {{ currency_format($gateway->charge + $source->amountForGateway, currency: $gateway->currency) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                @if ($gateway->instructions)
                                <div class="card-body">
                                    {!! $gateway->instructions !!}
                                </div>
                                @endif

                                <form action="{{ route($formRoute, [$source->uuid, $gateway->id]) }}" method="post" role="form" class="form-light form" enctype="multipart/form-data">
                                    @csrf

                                    @if(isset($gateway->fields) && count($gateway->fields) || !Auth::check() || $gateway->phone_required == 1 || $gateway->image_accept == 1)
                                        <h6 class="h2 d-inline-block mb-0">{{ __('Enter your payment details below') }}</h6>
                                        <small class="text-mute text-danger d-block">{{ __('These data must be completed after making your payment') }}</small>

                                        <div class="card-body">
                                        @unless(Auth::check())
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your full name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your email address" required>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($gateway->phone_required == 1)
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                                    </div>
                                                    <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone ?? null }}" class="form-control" placeholder="Your Phone Number" >
                                                </div>
                                            </div>
                                        @endif

                                        @if ($gateway->image_accept == 1)
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-image"></i></span>
                                                    </div>
                                                    <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/jpeg,image/jpg,image/png" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-sticky-note"></i></span>
                                                    </div>
                                                    <textarea name="comment" id="comment" class="form-control" placeholder="Payment Instruction"></textarea>
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($gateway->fields) && count($gateway->fields))
                                            @foreach($gateway->fields as $index => $field)
                                                @php
                                                    $required = isset($field['isRequired']) && $field['isRequired']
                                                        ? 'required'
                                                        : '';
                                                @endphp

                                                @if($field['type'] == 'textarea')
                                                    <div class="form-group">
                                                        <label for="fields_{{ $loop->index }}" class="{{ $required }}">
                                                            {{ $field['label'] }}
                                                        </label>
                                                        <textarea
                                                            name="fields[{{ $field['label'] }}]"
                                                            id="fields_{{ $loop->index }}"
                                                            class="form-control h-25"
                                                            {{ $required }}
                                                        ></textarea>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label for="fields_{{ $loop->index }}" class="{{ $required }}">
                                                            {{ $field['label'] }}
                                                        </label>
                                                        <input
                                                            type="{{ $field['type'] }}"
                                                            name="fields[{{ $field['label'] }}]"
                                                            id="fields_{{ $loop->index }}"
                                                            class="form-control"
                                                            @if($field['type'] == 'file')
                                                                accept=".jpg,.jpeg,.png,.pdf"
                                                            @endif
                                                            {{ $required }}
                                                        />

                                                        @if($field['type'] == 'tel')
                                                            <small class="form-text text-danger">
                                                                {{ __('The phone number must contain the country code: Example: +584145551212') }}
                                                            </small>
                                                        @endif.
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        </div>
                                    @endif

                                    <button class="btn btn-block btn-dark">
                                        {{ __('Continue') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('css')
    <style>
        label.required::after {
            content: '*';
            color: var(--danger);
        }
    </style>
@endpush
