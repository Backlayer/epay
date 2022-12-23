@if(!$is_paid)
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
