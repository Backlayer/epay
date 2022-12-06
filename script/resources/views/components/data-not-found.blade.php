<div class="empty-state" data-height="400" style="height: 400px;">

    @if(!$is_blank)
        @if($icon)
            <div class="empty-state-icon">
                <i class="{{ $icon }}"></i>
            </div>
        @endisset
        <h2>{{ $message }}</h2>
        <p class="lead">
            {{ $help }}
        </p>
        @if(isset($button_name) && isset($button_link))
            <a href="{{ $button_link }}" class="btn btn-primary mt-4">
                @if($button_icon)
                    <i class="{{ $button_icon }}"></i>
                @endif
                {{ $button_name }}
            </a>
        @endif
    @elseif($loader)
        <div class="spinner-border text-primary loader-spinner">
            <span class="sr-only">Loading...</span>
        </div>
    @endif
</div>
