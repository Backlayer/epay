@foreach($notifications as $notification)
    <a href="{{ $notification->data['url'] ?? null }}" @class(['dropdown-item', 'notification-item', 'dropdown-item-unread' => $notification->read_at == null])>
        <div
            @class([
                'dropdown-item-icon',
                'bg-primary' => $notification->read_at == null,
                'bg-info' => $notification->read_at !== null,
                'text-white'
            ])>
            <i class="fab fa-first-order"></i>
        </div>
        <div class="dropdown-item-desc">
            {{$notification->data['message'] ?? null }}
            <div
                @class([
                    'time',
                    'text-primary' => $notification->read_at == null
                ])
            >
                {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
            </div>
        </div>
    </a>
@endforeach
