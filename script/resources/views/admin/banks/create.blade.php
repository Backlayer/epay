@extends('layouts.backend.app', [
    'prev' => route('admin.banks.index')
])

@section('title', __('Add Bank'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.banks.store') }}" method="post" class="ajaxform_with_redirect">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __("Enter bank name") }}" required>
                        </div>
                        <div class="form-group">
                            <label for="code" class="required">{{ __('Code') }}</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="{{ __("Enter bank code") }}" required>
                        </div>
                        <div class="form-group">
                            <label for="country" class="required">{{ __('Country') }}</label>
                            <select name="country" id="country" class="form-control" required>
                                <option selected disabled>{{ __("Select Country") }}</option>
                                @foreach($countries as $currencyId => $country)
                                    <option value="{{ $currencyId }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
