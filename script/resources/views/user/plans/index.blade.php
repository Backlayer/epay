@extends('layouts.user.master')

@section('title', __('Plans'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Subscription Payment') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.plans.create') }}" class="btn btn-sm btn-neutral">
        {{ __('Create New Plan') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($plans->count() > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <div>
                                        <table class="table align-items-center">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                                <th>{{ __('Active/Expired') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('URL') }}</th>
                                                <th>{{ __('Created At') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="list">
                                            @foreach($plans as $plan)
                                                <tr>
                                                    <td>{{ $plan->name }}</td>
                                                    <td>{{ convert_money_direct($plan->amount, $plan->currency, user_currency(), true) }}</td>
                                                    <td>{{ $plan->active_count }}/{{ $plan->expired_count }}</td>
                                                    <td>
                                                        @if($plan->status)
                                                            <span class="badge badge-pill badge-success">
                                                                <i class="fas fa-check"></i>
                                                                {{ __("Active") }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-pill badge-warning">
                                                                <i class="fas fa-spinner"></i>
                                                                {{ __("Inactive") }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="hidden" id="clip{{ $loop->index }}" value="{{ route('frontend.plan.index', $plan->uuid) }}">
                                                        <span class="link" data-clipboard-target="#clip{{ $loop->index }}">
                                                            <i class="fas fa-clipboard" ></i>
                                                            {{ str(route('frontend.plan.index', $plan->uuid))->limit(50) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ formatted_date($plan->created_at) }}</td>
                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                <a class="dropdown-item" href="{{ route('user.plans.show', $plan->id) }}">
                                                                    <i class="fas fa-exchange-alt"></i>
                                                                    {{ __("Subscribers") }}
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('user.plans.edit', $plan->id) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                    {{ __("Edit") }}
                                                                </a>
                                                                <a class="dropdown-item confirm-action"
                                                                   href="#"
                                                                   data-action="{{ route('user.plans.disable', $plan->id) }}"
                                                                   data-icon="fas fa-ban"
                                                                >
                                                                    <i class="fas fa-ban"></i>
                                                                    {{ __('Disable') }}
                                                                </a>
                                                                <a class="dropdown-item confirm-action" href="#"
                                                                   data-action="{{ route('user.plans.destroy', $plan->id) }}"
                                                                   data-method="DELETE"
                                                                   data-icon="fas fa-trash"
                                                                >
                                                                    <i class="fas fa-trash"></i>
                                                                    {{ __("Delete") }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

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
