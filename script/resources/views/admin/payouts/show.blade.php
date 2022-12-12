@extends('layouts.backend.app', [
    'prev' => url()->previous()
])

@section('title', __('Payouts'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>@lang('Payout info')</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Charge') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                        </thead>
                        <tbody>
                            <td>{{ currency_format($payout->amount, currency:$payout->currency) }}</td>
                            <td>{{ currency_format($payout->charge, currency:$payout->currency) }}</td>
                            <td>
                                @if ($payout->status == 'pending')
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif ($payout->status == 'rejected')
                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                @elseif ($payout->status == 'approved')
                                    <span class="badge badge-success">{{ __('Approved') }}</span>
                                @endif
                            </td>
                            <td>{{ formatted_date($payout->created_at) }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body pt-0 mt-0">
                <h4>@lang('Account Info')</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>{{ __('Account Number') }}</th>
                            <th>{{ __('Account Name') }}</th>
                            <th>{{ __('Account Type') }}</th>
                            <th>{{ __('Routing Number') }}</th>
                        </thead>
                        <tbody>
                            <td>{{ $payout->userbank->data['account_number'] ?? '' }}</td>
                            <td>{{ $payout->userbank->data['account_name'] ?? '' }}</td>
                            <td>{{ $payout->userbank->data['account_type'] ?? '' }}</td>
                            <td>{{ $payout->userbank->data['routing_number'] ?? '' }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body pt-0 mt-0">
                <h4>@lang('Bank info')</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>{{ __('Bank Name') }}</th>
                            <th>{{ __('Bank Code') }}</th>
                        </thead>
                        <tbody>
                            <td>{{ $payout->userbank->bank->name ?? '' }}</td>
                            <td>{{ $payout->userbank->bank->code ?? '' }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
