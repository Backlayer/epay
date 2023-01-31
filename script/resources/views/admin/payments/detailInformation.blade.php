<div class="row p-4 justify-content-between">
    <div class="d-flex flex-column col-3">
        <div class="d-flex flex-column align-self-start">
            <h5 class="mx-4 mb-2">{{ __('Gateway Name') }}</h5>
            <span class="mx-4 mb-2">{{ $gateway->name }}</span>
        </div>
    </div>
    <div class="d-flex flex-column align-self-start col-9">
        <h5>{{ __('Payment Details') }}</h5>

        @if($payment->fields && count($payment->fields))
        <div class="row">
            @foreach($payment->fields as $index => $field)
            <div class="col-6">
                <div class="form-group">
                    <label for="fields_{{ $loop->index }}">{{ $field['label'] }}</label>

                    <div
                        id="fields_{{ $loop->index }}"
                        class="form-control form-control-static h-25"
                    >
                    @if($field['type'] === 'file')
                        <a href="{{ url($payment->data[$field['label']]) }}" target="_blank" class="d-block">{{ __('View Document') }}</a>
                    @else
                        {{ $payment->data[$field['label']] }}
                    @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
