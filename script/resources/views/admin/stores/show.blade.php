@extends('layouts.backend.app')

@section('title', __('View money request'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Sender currency') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $request->sender_currency->symbol . $request->amount }}</td>
                                    <td>{{ $request->sender_currency->symbol . $request->charge }}</td>
                                    <td>{{ $request->sender_currency->name ?? '' }}</td>
                                    <td>{{ formatted_date($request->created_at) }}</td>
                                    <td>
                                        @if ($request->status == 2)
                                            <span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i> {{ __('PENDING') }}</span>
                                        @elseif ($request->status == 1)
                                            <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('APPROVED') }}</span>
                                        @else
                                            <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> {{ __('CANCLED') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h5>{{ __("Sender Infos") }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>{{ __('Sender Name') }}</th>
                                <td>{{ $request->sender->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Sender Email') }}</th>
                                <td>{{ $request->sender->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Sender Phone') }}</th>
                                <td>{{ $request->sender->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Image') }}</th>
                                <td><img width="30" class="rounded-circle" src="{{ asset($request->sender->avatar ?? '') }}" alt=""></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h5>{{ __("Receiver Infos") }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>{{ __('Receiver Name') }}</th>
                                <td>{{ $request->receiver->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Receiver Email') }}</th>
                                <td>{{ $request->receiver->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Receiver Phone') }}</th>
                                <td>{{ $request->receiver->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Image') }}</th>
                                <td><img width="30" class="rounded-circle" src="{{ asset($request->receiver->avatar ?? '') }}" alt=""></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
