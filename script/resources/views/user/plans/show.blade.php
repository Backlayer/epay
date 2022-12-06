@extends('layouts.user.master')

@section('title', __('Subscribers'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Subscribers') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.plans.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $plan->name }}
                    </h3>
                </div>
                <div class="card-body">
                    @if($subscribers->count() > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <div>
                                        <table class="table align-items-center">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Amount') }}</th>
                                                <th>{{ __('Charge') }}</th>
                                                <th>{{ __('Subscriber') }}</th>
                                                <th>{{ __('Expire At') }}</th>
                                                <th>{{ __('Auto Renew') }}</th>
                                                <th>{{ __('Renew') }}</th>
                                                <th>{{ __('Created At') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="list">
                                            @foreach($subscribers as $subscriber)
                                                <tr>
                                                    <td>{{ convert_money_direct($subscriber->amount, $subscriber->currency, user_currency(), true) }}</td>
                                                    <td>{{ convert_money_direct($subscriber->charge, $subscriber->currency, user_currency(), true) }}</td>
                                                    <td>{{ $subscriber->subscriber->name }}</td>
                                                    <td @class(['text-danger' => $subscriber->expire_at < now()])>
                                                        {{ formatted_date($subscriber->expire_at) }}
                                                    </td>
                                                    <td>
                                                        @if($subscriber->is_auto_renew)
                                                            <span class="badge badge-pill badge-success">
                                                                <i class="fas fa-check"></i>
                                                                {{ __("Yes") }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-pill badge-warning">
                                                                <i class="fas fa-times-circle"></i>
                                                                {{ __("No") }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $subscriber->times }}
                                                    </td>
                                                    <td>
                                                        {{ formatted_date($subscriber->created_at) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $subscribers->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="text-center mt-8">
                                    <div class="mb-3">
                                        <img src="{{ asset('user/img/icons/empty.svg') }}">
                                    </div>
                                    <h3 class="text-dark">{{ __('No Subscription Plan Found') }}</h3>
                                    <p class="text-dark text-sm card-text">{{ __("We couldn't find any Subscription Plan to this account") }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
@endpush
