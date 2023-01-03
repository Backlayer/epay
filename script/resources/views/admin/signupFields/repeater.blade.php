@php
    if (!isset($data)) {
        $data = [];
    }
@endphp

<div class="card-body overflow-auto repeaters h-100 hide" data-repeater-list="data" data-count="{{ count($data) }}">
    <div class="form-group">
        <div class="input-group row mx-0">
            <h5 class="col-5 col-form-label">{{ __('Label') }}</h5>
            <h5 class="col-5 col-form-label">{{ __('Value') }}</h5>
            <h5 class="col-2 col-form-label">
                <button type="button" class="btn btn-primary" data-repeater-create>
                    <i class="fas fa-plus-circle"></i>
                </button>
            </h5>
        </div>
    </div>

@if(count($data) > 0)
    @foreach($data as $field)
    <div class="form-group" data-repeater-item>
        <div class="input-group row mx-0">
            <input type="text" name="label" class="form-control col-5" placeholder="{{ __('Enter input label') }}" value="{{ $field['label'] }}" required>

            <input type="text" name="value" class="form-control col-5" placeholder="{{ __('Enter input value') }}" value="{{ $field['value'] }}" required>

            <div class="input-group-append col-2">
                <button type="button" class="btn btn-danger" data-repeater-delete>
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="form-group" data-repeater-item>
        <div class="input-group row mx-0">
            <input type="text" name="label" class="form-control col-5" placeholder="{{ __('Enter input label') }}" required>

            <input type="text" name="value" class="form-control col-5" placeholder="{{ __('Enter input value') }}" required>

            <div class="input-group-append col-2">
                <button type="button" class="btn btn-danger" data-repeater-delete>
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
@endif
</div>

@push('script')
    <script src="{{ asset('admin/plugins/jqueryrepeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('admin/pages/signup-fields.js') }}"></script>
@endpush
