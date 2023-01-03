@extends('layouts.backend.app', [
  'button_name' => 'Create New',
  'button_link' => route('admin.signup-fields.create')
])

@section('title', __('Fields for Signup'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <caption></caption>

                        <thead>
                            <tr>
                                <th>{{ __('Label') }}</th>
                                <th style="width: 200px">{{ __('Type') }}</th>
                                <th style="width: 130px">{{ __('Is Required?') }}</th>
                                <th style="width: 130px">{{ __('Is Active?') }}</th>
                                <th style="width: 130px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($signupFields ?? [] as $signupField)
                            <tr>
                                <td>{{ $signupField->label }}</td>
                                <td>{{ $signupField->type }}</td>
                                <td>{!! $signupField->IsRequiredLabel !!}</td>
                                <td>{!! $signupField->IsActiveLabel !!}</td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.signup-fields.edit', $signupField->id) }}">
                                            <i class="fa fa-edit"></i>
                                            {{ __('Edit') }}
                                        </a>

                                        <a
                                            href="javascript:void(0)"
                                            class="dropdown-item has-icon delete-confirm"
                                            data-action="{{ route('admin.signup-fields.destroy', $signupField->id) }}"
                                            data-method="DELETE"
                                        >
                                            <i class="fa fa-trash"></i>
                                            {{ __('Delete') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $signupFields->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
