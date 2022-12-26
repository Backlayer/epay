@extends('layouts.user.master')

@section('title', __('Single Charges'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Single Charge') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.single-charges.create') }}" class="btn btn-sm btn-neutral">
        {{ __('Create Payment Link') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-donations">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Single Charge') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 active-donations">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Active Single Charge') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 paused-donations">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Paused Single Charge') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($charges->count() < 1)
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="text-center mt-5">
                            <div class="mb-3">
                                <img width="100" src="{{ asset('user/img/icons/empty.svg') }}">
                            </div>
                            <h3 class="text-dark">{{ __('No Payment Link Found') }}</h3>
                            <p class="text-dark text-sm card-text">{{ __("We couldn't find any single charge page to this account") }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0">
                                <h3 class="mb-0">{{ __("Payment Links") }}</h3>
                            </div>
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{ __("Title") }}</th>
                                        <th>{{ __("Amount") }}</th>
                                        <th>{{ __('Payment Status') }}</th>
                                        <th>{{ __('Link') }}</th>
                                        <th>{{ __("Created At") }}</th>
                                        <th>{{ __("Action") }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list" style="min-height: 200px">
                                    @foreach($charges as $charge)
                                        <tr>
                                            <td>{{ $charge->title }}</td>
                                            <td class="budget">
                                                {{ currency_format($charge->amount, 'icon', $charge->currency->symbol) }}
                                            </td>
                                            <td>{!! $charge->PaymentStatus !!}</td>
                                            <td>
                                                <input type="hidden" id="clip{{ $loop->index }}" value="{{ route('frontend.single-charge.index', $charge->uuid) }}">
                                                <span class="link" data-clipboard-target="#clip{{ $loop->index }}">
                                                    <i class="fas fa-clipboard" ></i>
                                                    {{ str(route('frontend.single-charge.index', $charge->uuid))->limit(50) }}
                                                </span>
                                            </td>
                                            <td>{{ formatted_date($charge->created_at) }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if ($charge->lastOrder()->status_paid === '0')
                                                        <a class="dropdown-item" href="{{ route('user.single-charges.edit', $charge->id) }}">
                                                            <i class="fas fa-edit fa-fw"></i>
                                                            {{ __("Edit") }}
                                                        </a>
                                                        <a class="dropdown-item confirm-action" href="#"
                                                           data-action="{{ route('user.single-charges.destroy', $charge->id) }}"
                                                           data-method="DELETE"
                                                           data-icon="fas fa-trash"
                                                        >
                                                            <i class="fas fa-trash fa-fw"></i>
                                                            {{ __("Delete") }}
                                                        </a>
                                                        @else
                                                        <a class="dropdown-item d-flex" href="{{ route('user.single-charges.show', $charge->id) }}">
                                                            <i class="fas fa-book fa-fw"></i>
                                                            {{ __("View") }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $charges->links('vendor/pagination/bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <input type="hidden" id="get-single-charge-url" value="{{ route('user.single-charge') }}">
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        getTotalSingleCharge()
    </script>
@endpush
