@extends('layouts.backend.app')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Support Tickets'])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __("Tickets") }}</h4>
                    <div class="card-header-action">

                    </div>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-primary btn-icon icon-left btn-lg btn-block mb-4 d-md-none" data-toggle-slide="#ticket-items">
                        <i class="fas fa-list"></i> {{ __("All Tickets") }}
                    </a>
                    @if($supports->count() > 0)
                        <div class="tickets">
                            <div class="ticket-items" id="ticket-items">
                                @foreach($supports as $support)
                                    @if($loop->first)
                                        @php
                                            $firstID = $support->id;
                                        @endphp
                                    @endif
                                    <div @class(['ticket-item', 'active' => $loop->first]) data-id="{{ $support->id }}">
                                        <div class="ticket-title d-flex justify-content-between">
                                            <h4>{{ str($support->subject)->words() }}</h4>
                                            @if($support->priority == 'High')
                                                <span class="badge badge-danger">{{ $support->priority }}</span>
                                            @elseif($support->priority == 'Medium')
                                                <span class="badge badge-warning">{{ $support->priority }}</span>
                                            @else
                                                <span class="badge badge-light">{{ $support->priority }}</span>
                                            @endif
                                        </div>
                                        <div class="ticket-desc">
                                            <div>{{ $support->user->name }}</div>
                                            <div class="bullet"></div>
                                            <div>{{ $support->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="ticket-content" id="getTicket">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="ticket-header">
                                        <div class="ticket-sender-picture img-shadow">
                                            <img src="{{ avatar($supports[0]->user) }}" alt="image">
                                        </div>
                                        <div class="ticket-detail">
                                            <div class="ticket-title">
                                                <h4>{{ $supports[0]->subject }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div class="font-weight-600">{{ $supports[0]->user->name }}</div>
                                                <div class="bullet"></div>
                                                <div class="text-primary font-weight-600">
                                                    {{ \Carbon\Carbon::parse($supports[0]->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{ __("Ticket Status") }}</label>
                                        <select name="status" id="status" data-id="{{ $support->id }}" data-control="select2">
                                            <option value="1" @selected($support->status)>{{ __("Open") }}</option>
                                            <option value="0" @selected(!$support->status)>{{ __("Closed") }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ticket-description mb-5">
                                    <ul class="list-unstyled">
                                        <li>{{ __("Ticket Number: :number", ['number' => $support->ticket_no] ) }}</li>
                                        <li>{{ __("Reference Code: :code", ['code' => $support->reference_code] ) }}</li>
                                        <li>{{ __("Type: :type", ['type' => str($support->type)->replace('_', ' ')->ucfirst()] ) }}</li>
                                    </ul>

                                    <div class="mb-5">
                                        <h4>{{ __("Details") }}</h4>

                                        {{ $support->details }}
                                    </div>

                                    @if($support->images)
                                        <h3>{{ __("Attachments") }}</h3>
                                        <div class="gallery">
                                            @foreach($support->images as $image)
                                                <a href="{{ asset($image) }}" class="gallery-item" data-image="{{ asset($image) }}" data-title="{{ $support->subject }}" download>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="ticket-divider"></div>

                                    <div class="ticket-form">
                                        <form action="{{ route('admin.supports.reply', $firstID) }}" method="post" class="replyForm">
                                            <div class="form-group">
                                                <textarea name="reply" class="summernote form-control" placeholder="{{ __("Type a reply ...") }}"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button class="btn btn-primary btn-lg submit-button">
                                                    {{ __("Reply") }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="replies">
                                        @foreach($replies as $reply)
                                            @include('admin.support.reply', compact('reply'))
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{ __("No support tickets found!") }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="support_status_url" value="{{ route('admin.supports.update-status') }}">
    <input type="hidden" id="support_get_ticket_url" value="{{ route('admin.supports.get-ticket') }}">
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('script')
    <script src="{{ asset('plugins/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('admin/js/support.js') }}"></script>
@endpush
