@if (isset($signupFields) && count($signupFields))
    @foreach ($signupFields as $index => $field)
        @php
            $required = isset($field['isRequired']) && $field['isRequired'] == '1' ? 'required' : '';

            if (isset($data)) {
                $value = @$data[$field['label']];
            } else {
                $value = null;
            }
        @endphp

        <div class="col-md-6 mb-20 form-group">
            <label for="fields_{{ $loop->index }}"
                class="col-form-label {{ $required }}">
                {{ $field['label'] }}
            </label>

            @if ($field['type'] == 'textarea')
                <textarea name="fields[{{ $field['label'] }}]" id="fields_{{ $loop->index }}"
                    class="form-control focus-input100" {{ $required }}>
                    {{ $value }}
                </textarea>
            @elseif($field['type'] == 'radio')
                @foreach ($field['data'] as $index2 => $option)
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            name="fields[{{ $field['label'] }}]"
                            id="option[{{ $option['label'] }}]"
                            value="{{ $option['value'] }}" {{ $required }}
                            @checked($option['value'] == $value)>
                        <label class="form-check-label"
                            for="option[{{ $option['label'] }}]">
                            {{ $option['label'] }}
                        </label>
                    </div>
                @endforeach
            @elseif($field['type'] == 'checkbox')
                @foreach ($field['data'] as $index2 => $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                            name="option[{{ $option['label'] }}]"
                            id="option[{{ $option['label'] }}]"
                            value="{{ $option['value'] }}" {{ $required }}
                            @checked($option['value'] == $value)>
                        <label class="form-check-label"
                            for="option[{{ $option['label'] }}]">
                            {{ $option['label'] }}
                        </label>
                    </div>
                @endforeach
            @elseif($field['type'] == 'select')
                <select class="form-control focus-input100"
                    name="fields[{{ $field['label'] }}]"
                    id="fields_{{ $loop->index }}" {{ $required }}>
                    @foreach ($field['data'] as $index2 => $option)
                        <option value="{{ $option['value'] }}"
                            @selected($option['value'] == $value)>
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <input type="{{ $field['type'] }}"
                    name="fields[{{ $field['label'] }}]"
                    id="fields_{{ $loop->index }}"
                    class="form-control focus-input100"
                    @if ($field['type'] == 'file') accept=".jpg,.jpeg,.png,.pdf" @endif
                    {{ $required }} value="{{ $value }}" />

                @if ($field['type'] == 'tel')
                    <small class="form-text text-danger">
                        {{ __('The phone number must contain the country code: Example: +584145551212') }}
                    </small>
                @endif

                @if ($field['type'] == 'file' && $value)
                    <small class="form-text">
                        <a href="{{ url($value) }}" target="_blank"
                            class="d-block">{{ __('View Document') }}</a>
                    </small>
                @endif
            @endif
        </div>
    @endforeach
@endif
