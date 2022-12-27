@extends('layouts.user.master')

@section('title', __('Merchant'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Website Integration') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.websites.create') }}" class="btn btn-sm btn-neutral">
        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New Website') }}
    </a>
    <a href="{{ route('user.websites.documentation') }}" class="btn btn-sm btn-neutral">
        <i class="fas fa-file"></i>
        {{ __('Documentation') }}
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                @if ($websites->count() > 0)
                    <div class="table-responsive py-3 ">
                        <table class="table table-flush" id="table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ __('S/N') }}</th>
                                <th>{{ __('Merchant name') }}</th>
                                <th>{{ __('Merchant Key') }}</th>
                                <th>{{ __('Notify email') }}</th>
                                <th>{{ __('Mode') }}</th>
                                <th>{{ __('Message') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($websites as $website)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $website->merchant_name }}</td>
                                    <td>
                                    <span data-clipboard-text="{{ $website->token }}" class="clipboard-button"
                                          data-message="{{ __(':name key copied to clipboard', ['name' => $website->merchant_name]) }}">
                                        {{ $website->token }}
                                        <i class="fas fa-clipboard"></i>
                                    </span>
                                    </td>
                                    <td>{{ $website->email }}</td>
                                    <td>
                                        @if ($website->mode == 1)
                                            <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('LIVE') }}</span>
                                        @else
                                            <span class="badge badge-pill badge-warning"><i class="fa fa-times"></i> {{ __('TEST') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($website->message, 50, '...') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm" type="button" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if(!$website->mode)
                                                    <a class="dropdown-item confirm-action" href="#"
                                                       data-action="{{ route('user.websites.live', $website->id) }}"
                                                       data-method="POST"
                                                       data-icon="fas fa-check"
                                                    >
                                                        <i class="fas fa-check mr-1"></i>
                                                        {{ __("Live Now") }}
                                                    </a>
                                                @endif
                                                <a class="dropdown-item"
                                                   href="{{ route('user.websites.show', $website->id) }}">
                                                    <i class="fas fa-exchange-alt mr-1"></i>
                                                    {{ __('Transactions') }}
                                                </a>
                                                @if(!$website->mode)
                                                    <a class="dropdown-item"
                                                       href="{{ route('user.websites.test-transactions', $website->id) }}">
                                                        <i class="fas fa-exchange-alt mr-1"></i>
                                                        {{ __('Test Transactions') }}
                                                    </a>
                                                @endif
                                                <a class="dropdown-item"
                                                   href="{{ route('user.websites.edit', $website->id) }}">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    {{ __('Edit') }}
                                                </a>

                                                <a class="dropdown-item confirm-action" href="#"
                                                   data-action="{{ route('user.websites.destroy', $website->id) }}"
                                                   data-method="DELETE"
                                                   data-icon="fas fa-trash"
                                                >
                                                    <i class="fas fa-trash mr-1"></i>
                                                    {{ __("Delete") }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-body pb-0">
                            {{ $websites->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="text-center mt-5">
                                <div class="mb-3">
                                    <img src="{{ asset('user/img/icons/empty.svg') }}">
                                </div>
                                <h3 class="text-dark">{{ __("No Website Found") }}</h3>
                                <p class="text-dark text-sm card-text">{{ __("We couldn't find any website to this account") }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>
@endpush
