@if(isset($data['headings']['heading.capture']))
    @php
        $heading = $data['headings']['heading.capture'];
    @endphp
    <!-- Capture Area -->
    <div class="capture-area section-padding-0-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="capture-area-text">
                        <h6>{{ $heading['short_title'] ?? null }}</h6>
                        <h2>{{ $heading['title'] ?? null }}</h2>
                    </div>

                    <!-- Single Card -->
                    <div class="single-capture-card">
                        <h5>{{ $heading['capture_1_title'] ?? null }}</h5>
                        <p>{!! $heading['capture_1_description'] ?? null !!}</p>
                    </div>

                    <!-- Single Card -->
                    <div class="single-capture-card">
                        <h5>{{ $heading['capture_2_title'] ?? null }}</h5>
                        <p>{!! $heading['capture_2_description'] ?? null !!}</p>
                    </div>

                    <div class="single-capture-card">
                        <h5>{{ $heading['capture_3_title'] ?? null }}</h5>
                        <p>{!! $heading['capture_3_description'] ?? null !!}</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="capture-image mb-50" data-aos="flip-left">
                        <img src="{{ asset($heading['image'] ?? null) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Capture Area -->
@else
@endif
