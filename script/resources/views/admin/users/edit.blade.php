@extends('layouts.backend.app', [
    'prev' => route('admin.users.index')
])

@section('title', __('Edit User'))


@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit User') }}</h4>
                </div>
                <div class="card-body overflow-auto" style="max-height: 600px">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="ajaxform_with_redirect">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label for="name" class="required">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                                       placeholder="{{ __('Enter full name') }}" required>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                @foreach($user->meta as $meta)
                                    <label for="business_name" class="required">{{ __('Business Name') }}</label>
                                    <input type="text" class="form-control focus-input100" name="business_name" id="business_name"  value="{{ $meta }}" placeholder="{{ __('Enter your business name') }}" required>
                                @endforeach
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label for="email" class="required">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                                       placeholder="{{ __('Enter email address') }}" required>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label for="phone" class="required">{{ __('Phone') }}</label>
                                <input type="tel" class="form-control focus-input100" aria-describedby="phoneNumberHelp"  name="phone" id="phone" placeholder="{{ __('Your phone number') }}" value="{{$user->phone}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="optional">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" min="8" placeholder="{{ __('Enter password') }}">
                            <div class="text-small text-secondary">{{ __('If you do not want to change the password, leave it blank') }}</div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control" data-control="select2" required>
                                <option value="1" @selected($user->status == 1)>{{ __('Active') }}</option>
                                <option value="2" @selected($user->status == 2)>{{ __('Inactive') }}</option>
                            </select>
                        </div>

                        @if(isset($user->fields) && count($user->fields))
                            @foreach($user->fields as $index => $field)
                                @php
                                    $required = isset($field['isRequired']) && $field['isRequired']
                                        ? 'required'
                                        : '';
                                @endphp

                                <div style="margin-bottom: 20px;">
                                    <label for="fields_{{ $loop->index }}" class="col-form-label {{ $required }}">
                                        {{ $field['label'] }}
                                    </label>

                                @if($field['type'] == 'textarea')
                                    <textarea
                                        name="fields[{{ $field['label'] }}]"
                                        id="fields_{{ $loop->index }}"
                                        class="form-control focus-input100"
                                        {{ $required }}
                                    ></textarea>
                                @elseif($field['type'] == 'radio')
                                    @foreach($field['data'] as $index2 => $option)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="fields[{{ $field['label'] }}]"
                                            id="option[{{ $option['label'] }}]"
                                            value="{{ $option['value'] }}"
                                            {{ $required }}>
                                        <label class="form-check-label" for="option[{{ $option['label'] }}]">
                                            {{ $option['label'] }}
                                        </label>
                                    </div>
                                    @endforeach
                                @elseif($field['type'] == 'checkbox')
                                    @foreach($field['data'] as $index2 => $option)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="option[{{ $option['label'] }}]"
                                            id="option[{{ $option['label'] }}]"
                                            value="{{ $option['value'] }}"
                                            {{ $required }}>
                                        <label class="form-check-label" for="option[{{ $option['label'] }}]">
                                            {{ $option['label'] }}
                                        </label>
                                    </div>
                                    @endforeach
                                @elseif($field['type'] == 'select')
                                    <select class="form-control focus-input100"
                                        name="fields[{{ $field['label'] }}]"
                                        id="fields_{{ $loop->index }}"
                                        {{ $required }}>
                                        @foreach($field['data'] as $index2 => $option)
                                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input
                                        type="{{ $field['type'] }}"
                                        name="fields[{{ $field['label'] }}]"
                                        id="fields_{{ $loop->index }}"
                                        class="form-control focus-input100"
                                        @if($field['type'] == 'file')
                                            accept=".jpg,.jpeg,.png,.pdf"
                                        @endif
                                        {{ $required }}
                                    />

                                    @if($field['type'] == 'tel')
                                        <small class="form-text text-danger">
                                            {{ __('The phone number must contain the country code: Example: +584145551212') }}
                                        </small>
                                    @endif
                                @endif
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <button class="btn btn-primary float-right basicbtn">
                                <i class="fas fa-save"> </i>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
