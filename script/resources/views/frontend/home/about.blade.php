@if(isset($data['headings']['heading.about']))
    @php
        $heading = $data['headings']['heading.about'];
    @endphp
    <!-- About Us Area -->
    <div class="about-us-area section-padding-0-50">
        <div class="container">
            <div class="row align-items-center">
                <!-- About Text -->
                <div class="col-lg-7 col-xl-6">
                    <div class="about-us-text mb-50">
                        <h2><span>-</span> {{ $heading['title'] ?? null }}</h2>
                        <p>{{ $heading['description'] ?? null }}</p>

                        <a class="hero-btn two" href="{{ $heading['button_url'] ?? null }}">
                            {{ $heading['button_text'] ?? null }}
                        </a>
                    </div>
                </div>

                <!-- About Image -->
                <div class="col-lg-5 col-xl-6">
                    <div class="about-image mb-50">
                        <img src="{{ asset($heading['image'] ?? null) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Area -->
@else

@endif
