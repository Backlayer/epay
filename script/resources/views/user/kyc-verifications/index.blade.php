@extends('layouts.user.master')

@section('title', __('Kyc Documents'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Kyc Documents') }}</li>
@endsection

@section('actions')
    @if(!auth()->user()->kyc_verified_at)
        <a href="{{ route('user.kyc-verifications.create') }}" class="btn btn-sm btn-neutral">
            {{ __('Submit New Document') }}
        </a>
    @endif
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 @class(['text-danger' => !Auth::user()->kyc_verified_at])>
                @if(Auth::user()->kyc_verified_at)
                    {{ __('You are verified') }}
                @else
                    {{ __('You are not verified') }}
                @endif
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('Method') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Note') }}</th>
                        <th>{{ __('Documents') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->method->title ?? null }}</td>
                            <td>
                                @if($document->status == 0)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-spinner"></i>
                                        {{ __('Pending') }}
                                    </span>
                                @elseif($document->status == 1)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i>
                                        {{ __('Approved') }}
                                    </span>
                                @elseif($document->status == 2)
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i>
                                        {{ __('Rejected') }}
                                    </span>
                                @elseif($document->status == 3)
                                    <span class="badge badge-dark">
                                         <i class="fas fa-spinner"></i>
                                        {{ __('Re-Submitted') }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $document->note }}</td>
                            <td>{{ count($document->data ?? []) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if ($document->status == 2)
                                        <a class="btn btn-sm btn-neutral" href="{{ route('user.kyc-verifications.resubmit', $document->id) }}">
                                            {{ __('Re Submit') }}
                                        </a>
                                    @endif
                                    <a class="btn btn-sm btn-neutral" href="{{ route('user.kyc-verifications.show', $document->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
