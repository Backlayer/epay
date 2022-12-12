@extends('layouts.user.master')

@section('title', __('Subscription'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Subscription') }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>{{ __("Plan") }}</th>
                            <td>{{ $subscription->plan->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __("Owner") }}</th>
                            <td>{{ $subscription->plan->owner->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __("Amount") }}</th>
                            <td>{{ currency_format($subscription->amount + $subscription->charge, currency: $subscription->currency) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __("Expire At") }}</th>
                            <td>{{ formatted_date($subscription->expire_at) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __("Renewed") }}</th>
                            <td>{{ __(":times times", ['times' => $subscription->times ?? 0]) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __("Auto Renew") }}</th>
                            <td>
                                @if($subscription->is_auto_renew)
                                    <span class="badge badge-success">{{ __("Yes") }}</span>
                                    <a href="{{ route('user.subscription.auto-renew', $subscription->id) }}" class="btn btn-sm btn-primary confirm-action">
                                        {{ __('Disable Now') }}
                                    </a>
                                @else
                                    <span class="badge badge-danger">{{ __("No") }}</span>
                                    <a href="{{ route('user.subscription.auto-renew', $subscription->id) }}" class="btn btn-sm btn-danger confirm-action">
                                        {{ __('Enable Now') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
