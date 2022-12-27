@extends('layouts.backend.app', [
    'prev' => route('admin.kyc-requests.index')
])

@section('title', __('KYC Documents'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ get_gravatar($kycRequest->user->email) }}" alt="" class="card-img">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>
                                        <a href="{{ route('admin.customers.show', $kycRequest->user->id) }}">{{ $kycRequest->user->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <td>{{ $kycRequest->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Phone') }}</th>
                                    <td>{{ $kycRequest->user->phone }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('KYC Verified At') }}</th>
                                    <td>
                                        @if($kycRequest->user->kyc_verified_at)
                                            {{ formatted_date($kycRequest->user->kyc_verified_at) }}
                                        @else
                                            <span class="text-danger">{{ __('Not yet verified!') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                        <tr>
                            <th>{{ __('Current Status') }}</th>
                            <th>
                                @if($kycRequest->status == 0)
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif($kycRequest->status == 1)
                                    <span class="badge badge-primary">{{ __('Approved') }}</span>
                                @elseif($kycRequest->status == 2)
                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                @elseif($kycRequest->status == 3)
                                    <span class="badge badge-dark">{{ __('Re-Submitted') }}</span>
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th>{{ __('Submitted At') }}</th>
                            <th>{{ formatted_date($kycRequest->created_at) }}</td>
                        </tr>
                        @if ($kycRequest->status == 2)
                        <tr>
                            <th>{{ __('Rejected At') }}</th>
                            <th>{{ formatted_date($kycRequest->rejected_at) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="text-center">
                                <h4>
                                    {{ __('Documents') }}
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Label') }}</th>
                            <th>{{ __('Value') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kycRequest->data as $label => $value)
                            <tr>
                                <th>{{ $label }}</th>
                                <td>
                                    @if(Storage::disk(config('filesystems.default'))->exists(str($value)->remove('storage/')))
                                        <div class="gallery">
                                            <div class="gallery-item" data-image="{{ asset($value) }}" data-title="{{ $label }}"></div>
                                        </div>
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="btn-group w-100">
                        @if($kycRequest->status !== 1)
                            <button
                                class="btn btn-primary confirm-action"
                                data-action="{{ route('admin.kyc-requests.store', ['request' => $kycRequest->id, 'status' => 'approve']) }}"
                                data-method="POST"
                            >
                                <i class="fas fa-check-circle"></i>
                                {{ __('Approve') }}
                            </button>

                            <button
                                class="btn btn-danger confirm-action"
                                data-action="{{ route('admin.kyc-requests.store', ['request' => $kycRequest->id, 'status' => 'reject']) }}"
                                data-method="POST"
                            >
                                <i class="fas fa-times-circle"></i>
                                {{ __('Reject') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('script')
    <script src="{{ asset('plugins/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush
