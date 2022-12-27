@extends('layouts.backend.app', [
    'prev' => route('admin.users.index')
])

@section('title', __('Create User'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Create User') }}</h4>
                </div>
                <div class="card-body overflow-auto" style="max-height: 600px">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="ajaxform_with_redirect">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Enter full name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Enter email address') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required">{{ __('Phone') }}</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="{{ __('Enter phone number') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="required">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" min="8" placeholder="{{ __('Enter password') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control" data-control="select2" required>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary float-right basicbtn">
                                <i class="fas fa-save"> </i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";
        $('#plan').on('change.select2', function(e){
            var id = $(this).val();

            if(id === ""){
                $('#plan-dependent-inputs').hide();
                $('#gateway').val(null).trigger('change');
                $('#trx').val(null);

                $('#gateway').attr('required', false);
                $('#trx').attr('required', false);
                $('#paid_status').attr('required', false);
                $('#payment_status').attr('required', false);
            }else {
                $('#plan-dependent-inputs').show();
                $('#gateway').attr('required', true);
                $('#trx').attr('required', true);
                $('#paid_status').attr('required', true);
                $('#payment_status').attr('required', true);
            }
        })
    </script>
@endpush
