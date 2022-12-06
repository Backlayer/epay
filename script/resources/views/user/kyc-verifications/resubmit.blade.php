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
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Resubmit') }}</h4>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <form action="{{ route('user.kyc-verifications.resubmit.update', $kycRequest->id) }}" method="post" class="ajaxform_instant_reload" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @foreach($kycRequest->fields ?? [] as $index => $field)
                                @if($field['type'] == 'textarea')
                                    <div class="form-group">
                                        <label for="fields_{{ $loop->index }}" class="required">{{ $field['label'] }}</label>
                                        <textarea
                                            name="fields[{{ $field['label'] }}]"
                                            id="fields_{{ $loop->index }}"
                                            class="form-control h-25"
                                            required
                                        >{{ $kycRequest->data[$field['label'] ?? null] ?? null }}</textarea>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="fields_{{ $loop->index }}" class="required">{{ $field['label'] }}</label>
                                        @if($field['type'] == 'file')
                                            <a href="{{ asset($kycRequest->data[$field['label'] ?? null] ?? null) }}" target="_blank">{{ __('Old Image') }}</a>
                                        @endif
                                        <input
                                            type="{{ $field['type'] }}"
                                            name="fields[{{ $field['label'] }}]"
                                            id="fields_{{ $loop->index }}"
                                            class="form-control"
                                            value="{{ $field['type'] !== 'file' ? $kycRequest->data[$field['label'] ?? null] : null}}"
                                            @if($field['type'] == 'file')
                                                accept=".jpg,.jpeg,.png"
                                            @endif
                                            required
                                        >
                                    </div>
                                @endif
                            @endforeach

                            <div class="form-group">
                                <label for="note">{{ __('Note') }}</label>
                                <textarea
                                    name="note"
                                    id="note"
                                    class="form-control h-25"
                                >{{ $kycRequest->note }}</textarea>
                            </div>

                            <button class="btn btn-primary basicbtn">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
