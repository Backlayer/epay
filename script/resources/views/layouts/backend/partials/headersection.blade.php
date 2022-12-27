<div class="section-header">
    @isset($prev)
        <div class="section-header-back">
            <a href="{{ url($prev) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
    @endisset


    @hasSection('title')
        <h1>@yield('title')</h1>
    @elseif(isset($title))
        <h1>{{ $title }}</h1>
    @endif

    @isset($button_name)
        <div class="section-header-button">
            <a href="{{ url($button_link) }}" class="btn btn-primary">
                @isset($button_icon)
                    <i class="{{ $button_icon }}"></i>
                @endisset
                {{ $button_name }}
            </a>
        </div>
    @endisset
    <div class="section-header-breadcrumb">
        @foreach(request()->segments() as $segment)
            <div class="breadcrumb-item">{{ $segment }}</div>
        @endforeach
    </div>
</div>
