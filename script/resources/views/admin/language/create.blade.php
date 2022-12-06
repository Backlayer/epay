@extends('layouts.backend.app',[
    'prev'=> route('admin.language.index')
])

@section('title', __('Create Language'))

@section('content')
    <form action="{{ route('admin.language.store') }}" method="POST" class="ajaxform_with_redirect">
        @csrf
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Language Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="language_code" class="required">{{ __('Select Language') }}</label>
                            <select name="language_code" id="language_code" class="form-control selectric" required>
                                @foreach($countries as $row)
                                    <option value="{{ $row['code'] }}">{{ $row['name'] }} -- {{ $row['nativeName'] }} -- ( {{ $row['code'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-area">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-publish">
                                <button type="submit" class="btn btn-primary col-12 basicbtn">
                                    <i class="fa fa-save"></i> {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/selectric.css') }}">
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/jquery.selectric.min.js') }}"></script>
@endsection

