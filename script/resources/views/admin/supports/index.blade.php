@extends('layouts.backend.app')

@section('title', __('Supports'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tickets">
                    <div class="ticket-items" id="ticket-items">
                        @forelse ($supports ?? [] as $support)
                            <div class="ticket-item d-flex justify-content-between align-items-center" id="trigger-{{ $support->id }}" data-action="{{ route('admin.supports.get-ticket', $support->id) }}">
                                <div>
                                    <div class="ticket-title">
                                        <h4>{{ $support->title }} ({{ $support->ticket_no }})</h4>
                                    </div>
                                    <div class="ticket-desc">
                                        <div class="user">{{  $support->user->name }}</div>
                                        <div class="bullet"></div>
                                        <div class="date">{{  $support->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <button class="btn btn-danger delete-confirm" data-action={{ route('admin.supports.destroy', ['support' => $support->id, 'trigger' => 'trigger-'.$support->id]) }}>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        @empty
                            <h6>{{ __('No support ticket found!') }}</h6>
                        @endforelse
                        <div class="mt-3">
{{--                            {{ $supports->links('vendor.pagination.bootstrap-5') }}--}}
                        </div>
                    </div>
                    <div class="ticket-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('admin/js/pages/admin/support.js') }}"></script>
@endpush
