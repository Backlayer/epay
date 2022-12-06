<div class="d-flex justify-content-between align-items-center">
    <div class="ticket-header">
        <div class="ticket-sender-picture img-shadow">
            <img src="{{ avatar($support->user) }}" alt="image">
        </div>
        <div class="ticket-detail">
            <div class="ticket-title">
                <h4>{{ $support->subject }}</h4>
            </div>
            <div class="ticket-info">
                <div class="font-weight-600">{{ $support->user->name }}</div>
                <div class="bullet"></div>
                <div class="text-primary font-weight-600">
                    {{ \Carbon\Carbon::parse($support->created_at)->diffForHumans() }}
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
                <a class="chocolat-image" href="{{ asset($image) }}">
                    <img src="{{ asset($image) }}" class="gallery-item" alt="{{ $support->subject }}">
                </a>
            @endforeach
        </div>
    @endif

    <div class="ticket-divider"></div>

    <div class="ticket-form">
        <form action="{{ route('admin.supports.reply', $support->id) }}" method="post" class="replyForm">
            <div class="form-group">
                <textarea name="reply" class="summernote form-control" placeholder="Type a reply ..."></textarea>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary btn-lg submit-button">
                    Reply
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
