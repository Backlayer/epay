@extends('layouts.backend.app', [
    'prev' => route('admin.taxes.index'),
])

@section('title', __('Create Currency'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.taxes.store') }}" method="post" class="ajaxform_with_redirect">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Enter tax name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="rate" class="required">{{ __('Rate') }} <span id="taxType"></span></label>
                            <input type="number" name="rate" id="rate" class="form-control" placeholder="{{ __('Enter tax rate') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="type" class="required">{{ __('Type') }}</label>
                            <select name="type" id="type" class="form-control" data-control="select2" required>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}">{{ str($type)->ucfirst() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control" data-control="select2" required>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary basicbtn float-right">
                            <i class="fas fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="defaultCurrency" value="{{ __('Fixed in :name', ['name' => default_currency('code')]) }}">
@endsection

@push('script')
    <script>
        "use strict";
        setType();
        $('#type').on('select2:select', function(){
            setType();
        });

        function setType(){
            var type = $('#type').val();
            var defaultCurrency = $('#defaultCurrency').val();

            if(type === "percentage"){
                $('#taxType').html("(%)")
            }else{
                $('#taxType').html("("+defaultCurrency+")")
            }
        }
    </script>
@endpush
