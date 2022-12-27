<div class="row justify-content-center">
    @if(Auth::check() && Auth::user()->role == 'admin')
        <div class="col-lg-8 col-xl-7 text-center">
            <a href="{{ $url }}" class="{{ $class }}">
                <i class="fas fa-edit"></i>
                {{ $text }}
            </a>
        </div>
    @endif
</div>
