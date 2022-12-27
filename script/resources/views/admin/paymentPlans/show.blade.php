@extends('layouts.backend.app', [
    'prev' => route('admin.payment-plans.index')
])

@section('title', __('Payment Plans Details'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Author') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Interval') }}</th>
                                    <th>{{ __('Features') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $plan->owner->name ?? '' }}</td>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->amount }}</td>
                                    <td>{{ $plan->interval }}</td>
                                    <td>
                                        @foreach ($plan->features as $feature)
                                            <li>{{ $feature['title'] }}</li>
                                        @endforeach
                                    </td>
                                    <td>{{ formatted_date($plan->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('admin.payment-plans.show', $plan->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Is Auto Renew') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Subscribed At') }}</th>
                                    <th>{{ __('Expire At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td>{{ currency_format($subscriber->amount, currency:$subscriber->currency) }}</td>
                                    <td>{{ currency_format($subscriber->charge, currency:$subscriber->currency) }}</td>
                                    <td>{{ $subscriber->charge }}</td>
                                    <td>
                                        <div class="badge badge-{{ $subscriber->is_auto_renew ? 'success':'warning' }}">
                                            {{ $subscriber->is_auto_renew ? __('Yes'):__('No') }}
                                        </div>
                                    </td>
                                    <td>{{ $subscriber->subscriber->name ?? '' }}</td>
                                    <td>{{ $subscriber->subscriber->email ?? '' }}</td>
                                    <td>{{ formatted_date($subscriber->created_at) }}</td>
                                    <td>{{ formatted_date($subscriber->expire_at) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
