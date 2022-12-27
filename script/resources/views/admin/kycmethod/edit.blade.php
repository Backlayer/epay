@extends('layouts.backend.app', [
     'prev' => url()->previous()
])

@section('title', __('Create Kyc Verification Method'))

@section('content')
    <form action="{{ route('admin.kyc-method.update', $kycMethod->id) }}" method="POST" class="ajaxform_with_redirect repeater">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image" class="required">{{ __('Image') }}</label>
                            {{ mediasection(['input_name' => 'image', 'input_id' => 'image', 'preview' => $kycMethod->image, 'value' => $kycMethod->image]) }}
                        </div>
                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $kycMethod->title }}"
                                   placeholder="{{ __('Enter Title') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image_accept" class="required">{{ __('Image Accept') }}</label>
                            <select name="image_accept" id="image_accept" class="form-control" data-control="select2" required>
                                <option value="1" @selected($kycMethod->image_accept == 1)>{{ __('Yes') }}</option>
                                <option value="0" @selected($kycMethod->image_accept == 0)>{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="required">{{ __('Status:') }}</label>
                            <select name="status" id="status" class="form-control" data-control="select2" required>
                                <option value="1" @selected($kycMethod->status == 1)>{{ __('Active') }}</option>
                                <option value="0" @selected($kycMethod->status == 0)>{{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary basicbtn float-right">
                            <i class="fas fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Document Fields') }}</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-repeater-create>
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body overflow-auto repeaters" data-repeater-list="fields" style="max-height: 588px; height: 588px">
                        @if($kycMethod->fields > 0)
                            @foreach($kycMethod->fields as $field)
                                <div class="form-group" data-repeater-item>
                                    <div class="input-group">
                                        <input type="text" name="label" class="form-control" value="{{ $field['label'] }}" placeholder="{{ __('Enter input label') }}" aria-label="" required>
                                        <select name="type" class="form-control" aria-label="" required>
                                            @foreach($types as $type)
                                                <option value="{{ $type }}" @selected($field['type'] == $type)>{{ ucwords($type) }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger" data-repeater-delete>
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-group" data-repeater-item>
                                <div class="input-group">
                                    <input type="text" name="label" class="form-control" placeholder="{{ __('Enter input label') }}" aria-label="" required>
                                    <select name="type" class="form-control" aria-label="" required>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}">{{ ucwords($type) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" data-repeater-delete>
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{ mediasingle() }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection


@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqueryrepeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('admin/pages/kyc.js') }}"></script>
@endpush
