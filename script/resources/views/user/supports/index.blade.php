@extends('layouts.user.master')

@section('title', __('Supports'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Supports') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.supports.create') }}" class="btn btn-sm btn-neutral">
        {{ __('Open Ticket') }}
    </a>
@endsection

@section('content')
    @if($tickets->count() > 0)
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
                                <th>{{ __("Subject") }}</th>
                                <th>{{ __("Priority") }}</th>
                                <th>{{ __("Type") }}</th>
                                <th>{{ __('Reference') }}</th>
                                <th>{{ __('Details') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __("Created At") }}</th>
                                <th>{{ __("Action") }}</th>
                            </tr>
                            </thead>
                            <tbody class="list" style="min-height: 200px">
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->priority }}</td>
                                    <td>{{ $ticket->type }}</td>
                                    <td>{{ $ticket->reference_code }}</td>
                                    <td>{{ str($ticket->details)->words(30) }}</td>
                                    <td>
                                        @if($ticket->status)
                                            <span class="badge badge-danger">
                                                <i class="fas fa-check"></i>
                                                {{ __('Closed') }}
                                            </span>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-spinner"></i>
                                                {{ __('Open') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ formatted_date($ticket->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('user.supports.show', $ticket->id) }}" class="btn btn-light btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $tickets->links('vendor/pagination/bootstrap-5') }}
                </div>
            </div>
        </div>
    @else
        <div class="row my-5 py-5">
            <div class="col text-center mt-5">
                <img src="{{ asset('user/img/icons/empty.svg') }}" alt="">
                <h4 class="mt-3">{{ __('No Ticket Found') }}</h4>
                <p>{{ __("We couldn't find any ticket to this account") }}</p>
            </div>
        </div>
    @endif
@endsection
