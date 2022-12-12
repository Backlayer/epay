@if($reply->type)
    <div class="ticket-content right">
        <div class="ticket-header">
            <div class="ticket-detail">
                <div class="ticket-title">
                    <h4>{{ $reply->sender->name }}</h4>
                </div>
                <div class="ticket-info">
                    <div class="text-primary font-weight-600">
                        {{ formatted_date($reply->created_at, 'd M, Y h:i A') }}
                    </div>
                </div>
            </div>
            <div class="ticket-sender-picture img-shadow">
                <img src="{{ avatar() }}" alt="image">
            </div>
        </div>

        <div class="ticket-description col-md-12">
            <p>{{ $reply->comment }}</p>
            <div class="ticket-divider">
            </div>
        </div>
    </div>
@else
    <div class="ticket-content">
        <div class="ticket-header">
            <div class="ticket-sender-picture img-shadow">
                <img src="{{ avatar() }}" alt="image">
            </div>
            <div class="ticket-detail">
                <div class="ticket-title">
                    <h4>{{ $reply->sender->name  }}</h4>
                </div>
                <div class="ticket-info">
                    <div class="text-primary font-weight-600">
                        {{ formatted_date($reply->created_at, 'd M, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="ticket-description col-md-12">
            <p>{{ $reply->comment }}</p>
            <div class="ticket-divider">
            </div>
        </div>
    </div>
@endif

