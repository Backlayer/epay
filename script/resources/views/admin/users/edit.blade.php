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
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                                   placeholder="{{ __('Enter full name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                                   placeholder="{{ __('Enter email address') }}" required>
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
