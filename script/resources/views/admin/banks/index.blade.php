@extends('layouts.backend.app')

@section('title', __('Bank Supported'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h5>{{ __('Bank Supported') }}</h5>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bank-modal"><i class="fa fa-plus"
                            aria-hidden="true"></i> {{ __('Add Bank') }}</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>{{ __('S/N') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Currency') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks ?? [] as $bank)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->code }}</td>
                                <td>{{ $bank->currency->name }}</td>
                                <td>{{ formatted_date($bank->created_at) }}</td>
                                <td>{{ formatted_date($bank->updated_at) }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a class="btn text-warning btn-sm edit-bank" href="#" data-id="{{ $bank->id }}" data-name="{{ $bank->name }}" data-code="{{ $bank->code }}" data-currency="{{ $bank->currency_id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn text-danger delete-confirm btn-sm" href="javascript:void(0)" data-action="{{ route('admin.banks.destroy', $bank->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 {{ $banks->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="bank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title">@lang('Add Bank')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.banks.store') }}" method="post" class="ajaxform_with_reload bank-form">
                        @csrf

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="name" class="form-control" placeholder="Name" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="code" class="form-control" maxlength="5" placeholder="Code" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <select class="form-control" name="currency_id" required="">
                                    <option value="">@lang('Select Country')</option>
                                    @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-success btn-block basicbtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title">@lang('Edit Bank')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.banks.index') }}" method="post" class="ajaxform_with_reload bank-edit-form">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="name" class="form-control" placeholder="Name" required="" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="code" class="form-control" maxlength="5" placeholder="Code" required="" id="code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <select class="form-control" name="currency_id" required="" id="currency_id">
                                    <option value="">@lang('Select Country')</option>
                                    @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-success btn-block basicbtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
