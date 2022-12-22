@extends('layouts.user.blank')

@section('title', $invoice->item_name)

@section('body')
    <div class="main-content">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __("Payment Information") }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-3">
                                        <thead>
                                        <th>{{ __("Item Name") }}</th>
                                        <th>{{ __("Amount") }}</th>
                                        <th>{{ __("Quantity") }}</th>
                                        <th>{{ __("Sub Total") }}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($invoice->items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ currency_format($item->amount, currency: $invoice->currency) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ currency_format($item->subtotal, currency: $invoice->currency) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-3">
                                        <tbody>
                                        <tr>
                                            <th>{{ __('Sub Total') }}</th>
                                            <td>{{ currency_format($invoice->items_sum_subtotal, currency: $invoice->currency) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Discount') }}</th>
                                            <td>{{ __(':percentage %', ['percentage' => number_format($invoice->discount, 2)]) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Tax') }}</th>
                                            <td>{{__(':percentage %', ['percentage' => number_format($invoice->tax, 2)]) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Total') }}</th>
                                            <td>
                                                {{ currency_format($amount, currency: $invoice->currency) }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('frontend.invoice.gateway', [$invoice->uuid]) }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="card bg-gradient-danger border-0">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                        @if(Auth::check())
                                                        <img src="{{ avatar() }}" alt="" class="rounded-circle" width="50">
                                                        @else
                                                        <i class="fas fa-user"></i>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    @if(Auth::check())
                                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                                                        {{ __('My Wallet') }}
                                                    </h5>
                                                    <span class="h2 font-weight-bold mb-0 text-white">
                                                        {{ currency_format(Auth::user()->wallet, currency: user_currency()) }}
                                                    </span>
                                                    @else
                                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                                                            {{ __('Hello, Guest') }}
                                                        </h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="card-title font-weight-bold mb-2">
                                        {{ str($invoice->item_name)->upper() }}
                                    </h4>
                                    <div class="mb-2">
                                        <small>{!! __("by :name at :datetime", ['name' => '<b>'.$invoice->owner->name.'</b>', 'datetime' => '<b>'.formatted_date($invoice->created_at, 'd M, Y - h:i A').'</b>']) !!}</small>
                                    </div>

                                    <div class="form-group text-center">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-future">{{ $invoice->currency->symbol  }}</span>
                                            </div>
                                            <input class="form-control" type="number" name="amount" value="{{ round($amount, 2, PHP_ROUND_HALF_ODD) }}" @if($amount) readonly @endif>
                                        </div>
                                    </div>

                                    @if(!$invoice->is_paid)
                                        <div class="row align-items-center">
                                            @foreach($gateways as $gateway)
                                                <div class="col-md-4">
                                                    <div class="custom-control shadow-sm custom-radio image-checkbox">
                                                        <input type="radio" name="gateway" id="{{ str($gateway->name)->slug('_') }}" value="{{ $gateway->id }}" class="custom-control-input">
                                                        <label class="custom-control-label d-flex justify-content-center align-items-center" for="{{ str($gateway->name)->slug('_') }}">
                                                            <img src="{{ $gateway->logo }}" alt="#" class="img-fluid" width="80">
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <button class="btn btn-dark mt-2">
                                            {{ __("Pay Now") }}
                                        </button>
                                    @else
                                        <div class="text-center">
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i>
                                                {{ __('Paid') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
