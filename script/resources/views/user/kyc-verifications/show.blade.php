@extends('layouts.user.master')

@section('title', __('Kyc Documents'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Kyc Documents') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.kyc-verifications.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('Verification Status') }}</th>
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
                                <td>{{ formatted_date($kycRequest->created_at) }}</td>
                            </tr>
                            @if ($kycRequest->status == 2)
                                <tr>
                                    <th>{{ __('Rejected At') }}</th>
                                    <td>{{ formatted_date($kycRequest->rejected_at) }}</td>
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
                            @foreach($kycRequest->data ?? [] as $label => $value)
                                <tr>
                                    <th>{{ $label }}</th>
                                    <td>
                                        @if(Storage::disk(config('filesystems.default'))->has(str($value)->remove('storage/')))
                                            <img src="{{ asset($value) }}" alt="" width="250">
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($kycRequest->status == 2)
                        <a href="{{ route('user.settings.security.kyc.resubmit', $kycRequest->id) }}" class="btn btn-primary">
                            <i class="fas fa-redo"></i>
                            {{ __('Resubmit') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush
