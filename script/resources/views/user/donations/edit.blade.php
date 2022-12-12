@extends('layouts.user.master')

@section('title', __('Edit Donation Payment Link'))

@section('actions')
    <a href="{{ route('user.donations.index') }}" class="btn btn-sm btn-neutral">
        <i class="fa fa-backward" aria-hidden="true"></i>
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.donations.update', $donation->id) }}" method="post" class="ajaxform_instant_reload">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">{{ __("Payment Title") }}</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="{{ __("Payment Title") }}" required value="{{ $donation->title }}">
                                </div>
                                <span class="form-text text-xs">
                                    {{ __("Create a donation page for your customers, Transaction Charge is :percentage per donation", ['percentage' => $charge['type'] == 'percentage'? $charge['rate'].'%' : convert_money_direct($charge['rate'], default_currency(), user_currency(), true)]) }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ __("Goal") }}</label>
                            <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">{{ user_currency()->symbol }}</span>
                                    </span>
                                <input type="number" step="any" class="form-control" name="gaol" placeholder="0.00" required value="{{ $donation->amount }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">{{__('Image')}}</label>
                                <span class="form-text text-xs">{{ __("Recommended Image Size is :size", ['size' => '640x360']) }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __("Description") }}</label>
                            <textarea type="text" name="description" id="description" placeholder="{{ __("Description") }}" rows="4" class="form-control" required="">{{ $donation->description }}</textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-neutral btn-block submit-button">
                                {{ __("Update Link") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
