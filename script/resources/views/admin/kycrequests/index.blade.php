@extends('layouts.backend.app')

@section('title', __('KYC Requests'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="col-sm-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == null ? 'active' : '' }} " href="{{ route('admin.kyc-requests.index') }}">
                            {{ __('All') }}<span class="badge {{ request('status') == null ? 'badge-white' : 'badge-primary' }} ">{{ $all }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == "1" ? 'active' : '' }} " href="{{ route('admin.kyc-requests.index', ['status' => 1]) }}">
                            {{ __('Approved') }}<span class="badge {{ request('status') == "1" ? 'badge-white' : 'badge-primary' }} ">{{ $approved }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == "0" ? 'active' : '' }} " href="{{ route('admin.kyc-requests.index', ['status' => "0"]) }}">
                            {{ __('Pending') }}<span class="badge {{ request('status') == "0" ? 'badge-warning' : 'badge-warning' }} ">{{ $pending }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == "2" ? 'active' : '' }} " href="{{ route('admin.kyc-requests.index', ['status' => "2"]) }}">
                            {{ __('Rejected') }}<span class="badge {{ request('status') == "2" ? 'badge-danger' : 'badge-danger' }} ">{{ $rejected }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == "3" ? 'active' : '' }} " href="{{ route('admin.kyc-requests.index', ['status' => "3"]) }}">
                            {{ __('Re-Submitted') }}<span class="badge {{ request('status') == "3" ? 'badge-dark' : 'badge-dark' }} ">{{ $reSubmitted }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('KYC Requests') }}</h4>
            <form class="card-header-form">
                <div class="input-group">
                    <input type="text" name="src" value="{{ request('src') }}" class="form-control" placeholder="{{ __('Search by invoice or user') }}"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.kyc-requests.destroy.mass') }}" class="ajaxform_with_mass_delete">
                @csrf
                @if($requests->count() > 0)
                    <div class="float-left">
                        <button class="btn btn-danger btn-lg basicbtn mass-delete-btn" id="submit-button" style="display: none;">
                            <i class="fas fa-trash"></i>
                            {{ __('Delete') }}
                        </button>
                    </div>

                    <div class="clearfix mb-3"></div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center pt-2">
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup"
                                               data-checkbox-role="dad" class="custom-control-input"
                                               id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>{{ __('Method') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Note') }}</th>
                                <th>{{ __('Documents') }}</th>
                                <th class="text-right">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="id[]" id="request-{{ $request->id }}"
                                                   class="custom-control-input checked_input"
                                                   value="{{ $request->id }}" data-checkboxes="mygroup">
                                            <label for="request-{{ $request->id }}" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{ $request->method->title }}</td>
                                    <td>
                                        <a href="{{ route('admin.customers.show', $request->user->id) }}">{{ $request->user->name }}</a>
                                    </td>
                                    <td>
                                        @if($request->status == 0)
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @elseif($request->status == 1)
                                            <span class="badge badge-primary">{{ __('Approved') }}</span>
                                        @elseif($request->status == 2)
                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                        @elseif($request->status == 3)
                                            <span class="badge badge-dark">{{ __('Re-Submitted') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $request->note }}</td>
                                    <td>{{ count($request->data) }}</td>
                                    <td class="text-right">
                                        <button
                                            class="btn btn-primary dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            {{ __('Action') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a
                                                href="{{ route('admin.kyc-requests.show', $request->id) }}"
                                                class="dropdown-item has-icon"
                                            >
                                                <i class="fas fa-eye"></i>
                                                {{ __('View') }}
                                            </a>

                                            @if($request->status !== 1)
                                            <a
                                                href="javascript:void(0)"
                                                class="dropdown-item has-icon text-primary confirm-action"
                                                data-action="{{ route('admin.kyc-requests.store', ['request' => $request->id, 'status' => 'approve']) }}"
                                                data-method="POST"
                                            >
                                                <i class="fas fa-check-circle"></i>
                                                {{ __('Approve') }}
                                            </a>

                                            <a
                                                href="javascript:void(0)"
                                                class="dropdown-item has-icon text-danger confirm-action"
                                                data-action="{{ route('admin.kyc-requests.store', ['request' => $request->id, 'status' => 'reject']) }}"
                                                data-method="POST"
                                            >
                                                <i class="fas fa-times-circle"></i>
                                                {{ __('Reject') }}
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $requests->links('') }}
                    </div>
                @else
                    <x-data-not-found :message="__('No requests available yet')"/>
                @endif
            </form>
        </div>
        <div class="card-footer">
            <div class="card-footer">
                {{ $requests->appends(request()->all())->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
