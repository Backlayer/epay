@extends('layouts.user.master')

@section('title', __('Edit Invoice'))

@section('actions')
    <a href="{{ route('user.invoices.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0 font-weight-bolder">{{__('Edit invoice')}}</h3>
            <span class="form-text text-xs">{{ __('Invoice charge is :percentage. Invoice is charged when invoice is paid by client.', ['percentage' => $charge['type'] == 'percentage'? $charge['rate'].'%' : convert_money_direct($charge['rate'], default_currency(), user_currency(), true)]) }}</span>
        </div>
        <div class="card-body">
            <form action="{{route('user.invoices.update', $invoice->id)}}" method="post" class="ajaxform_instant_reload repeater">
                @csrf
                @method('PUT')
                <div data-repeater-list="items">
                    @if($invoice->items)
                        @foreach($invoice->items as $item)
                            <div data-repeater-item>
                                <div class="d-flex justify-content-between mb-2">
                                    <h4 id="item_number">#<span>{{ $loop->index + 1 }}</span></h4>
                                    <button data-repeater-delete class="btn btn-danger btn-sm" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="item_name" class="required">{{__('Service or Product Name')}}</label>
                                        <input type="text" name="item_name" id="item_name" value="{{ $item->name }}" class="form-control" placeholder="{{ __("Enter service or product name") }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="required">{{__('Amount')}}</label>
                                        <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </span>
                                            <input type="text" step="any" oninput="getSubtotal(this)" value="{{ $item->amount }}" class="form-control" name="amount" id="amount" placeholder="{{ __('Amount per item') }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="quantity" class="required">{{__('Quantity')}}</label>
                                        <input type="text" oninput="getSubtotal(this)" name="quantity" id="quantity" {{ $item->quantity }} class="form-control" value="1" required>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>{{__('Subtotal')}}</label>
                                        <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </span>
                                            <input type="text" id="subtotal" class="form-control" value="{{ $item->subtotal }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div data-repeater-item>
                            <div class="d-flex justify-content-between mb-2">
                                <h4 id="item_number">#<span>1</span></h4>
                                <button data-repeater-delete class="btn btn-danger btn-sm" type="button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="item_name" class="required">{{__('Item Name')}}</label>
                                    <input type="text" name="item_name" id="item_name" class="form-control" placeholder="{{ __("Enter invoice title") }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="amount" class="required">{{__('Amount')}}</label>
                                    <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </span>
                                        <input type="text" step="any" oninput="getSubtotal(this)" class="form-control" name="amount" id="amount" placeholder="{{ __('Amount per item') }}" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="quantity" class="required">{{__('Quantity')}}</label>
                                    <input type="text" oninput="getSubtotal(this)" name="quantity" id="quantity" class="form-control" value="1" required>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>{{__('Subtotal')}}</label>
                                    <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </span>
                                        <input type="text" id="subtotal" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{__('Invoice No')}}</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-prepend">
                              <span class="input-group-text">#</span>
                            </span>
                            <input type="text" class="form-control" required value="{{ $invoice->invoice_no }}" >
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{__('Customer Email')}}</label>
                    <div class="col-lg-4">
                        <input type="email" name="customer_email" class="form-control" value="{{ $invoice->customer_email }}" placeholder="{{ __('Enter customer email') }}" required>
                    </div>
                    <label class="col-form-label col-lg-2">{{__('Customer Phone Number')}}</label>
                    <div class="col-lg-4">
                        <input type="tel" name="customer_phone_number" aria-describedby="phoneNumberHelp" class="form-control" value="{{ $invoice->customer_phone_number }}" placeholder="{{ __('Enter customer phone number (optional)') }}">
                        <small id="phoneNumberHelp" class="form-text text-danger">{{ __('The phone number must contain the country code: Example: +584145551212') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{__('Discount')}}</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <input type="number" name="discount" step="any" value="{{ $invoice->discount }}" class="form-control" placeholder="{{ __('Enter discount in percentage') }}">
                            <span class="input-group-append">
                                <span class="input-group-text">%</span>
                            </span>
                        </div>
                    </div>

                    <label class="col-form-label col-lg-2">{{__('Tax')}}</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <input type="number" name="tax" step="any" value="{{ $invoice->tax }}" class="form-control" placeholder="{{ __('Enter tax in percentage') }}">
                            <span class="input-group-append">
                                <span class="input-group-text">%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{__('Notes')}}</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <textarea type="text" class="form-control" rows="3" placeholder="{{ __('Invoice note (Optional)') }}" name="note">{{ $invoice->note }}</textarea>
                        </div>
                    </div>

                    <label class="col-form-label col-lg-2" for="exampleDatepicker">{{__('Due Date')}}</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </span>
                            <input type="text" class="form-control datepicker" name="due_date" value="{{ formatted_date($invoice->due_date, 'm/d/Y') }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <!--
                    <button data-repeater-create class="btn btn-neutral" type="button">
                        <i class="fas fa-cart-plus"></i>
                        {{ __("Add Item") }}
                    </button>
                    -->
                    <button type="submit" class="btn btn-neutral submit-btn">
                        <i class="fas fa-save"></i>
                        {{__('Update Invoice')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('user/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('user/invoice.js') }}"></script>
    <script>
        item = {{ $invoice->items->count() }}
    </script>
@endsection
