@extends('layouts.user.master')

@section('title', __('Kyc Documents'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Kyc Documents') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.kyc-verifications.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    @foreach($kyc_methods as $key => $method)
                    <li class="nav-item">
                        <a
                            @class(['nav-link mb-sm-3 mb-md-0', 'active' => $loop->first])
                            id="tabs-icons-text-1-tab"
                            data-toggle="tab"
                            href="#tab_content{{ $key }}"
                            role="tab"
                            aria-controls="tabs-icons-text-1"
                            aria-selected="{{ $loop->first ? "true" : "false" }}"
                        >
                            {{ $method->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card">
                @if ($kyc_methods->count() > 0)
                    <div class="card-body">
                        <div class="tab-content">
                            @foreach($kyc_methods as $key => $method)
                                <div
                                    @class(['tab-pane fade', 'show active' => $loop->first])
                                    id="tab_content{{ $key }}"
                                    role="tabpanel"
                                    aria-labelledby="tab{{ $key }}"
                                >
                                    <form action="{{ route('user.kyc-verifications.store') }}" method="post" class="ajaxform_instant_reload" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="method" value="{{ $method->id }}">
                                        @foreach($method->fields as $index => $field)
                                            @if($field['type'] == 'textarea')
                                                <div class="form-group">
                                                    <label for="fields_{{ $loop->index }}" class="required">{{ $field['label'] }}</label>
                                                    <textarea
                                                        name="fields[{{ $field['label'] }}]"
                                                        id="fields_{{ $loop->index }}"
                                                        class="form-control h-25"
                                                        required
                                                    ></textarea>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label for="fields_{{ $loop->index }}" class="required">{{ $field['label'] }}</label>
                                                    <input
                                                        type="{{ $field['type'] }}"
                                                        name="fields[{{ $field['label'] }}]"
                                                        id="fields_{{ $loop->index }}"
                                                        class="form-control"
                                                        @if($field['type'] == 'file')
                                                            accept=".jpg,.jpeg,.png"
                                                        @endif
                                                        required
                                                    >
                                                </div>
                                            @endif
                                        @endforeach

                                        <div class="form-group">
                                            <label for="note-{{ $loop->index }}">{{ __('Note') }}</label>
                                            <textarea
                                                name="note"
                                                id="note-{{ $loop->index }}"
                                                class="form-control h-25"
                                            ></textarea>
                                        </div>

                                        <button class="btn btn-primary submit-button">
                                            <i class="fas fa-save"></i>
                                            {{ __('Save') }}
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{ __('No Kyc Methods Found') }}
                @endif
            </div>
        </div>
    </div>
@endsection
