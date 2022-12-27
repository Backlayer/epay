@extends('layouts.backend.app')

@section('title', __('Payment Plans'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('User plans') }}</h4>
                    <form action="{{ route('admin.payment-plans.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by name / Interval / amount') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Author') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Interval') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->owner->name ?? '' }}</td>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->amount }}</td>
                                        <td>{{ $plan->interval }}</td>
                                        <td>{{ formatted_date($plan->created_at) }}</td>
                                        <td>
                                            <a href="{{ route('admin.payment-plans.show', $plan->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $plans->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
