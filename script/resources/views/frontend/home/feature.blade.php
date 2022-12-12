@if(isset($data['headings']['heading.feature']))
    @php
    $heading = $data['headings']['heading.feature'];
    @endphp
    <!-- Feature Area -->
    <div class="feature-area section-padding-100-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-title text-center" data-aos="fade-down" data-aos-anchor-placement="top-bottom">
                        <h2><span>-</span> {{ $heading['title'] ?? null }} <span>-</span></h2>
                        <p>{{ $heading['description'] ?? null }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Features Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-feature-area text-center mb-50">
                        <div class="features-icon">
                            <i class="{{ $heading['feature_1_icon'] ?? null }}"></i>
                        </div>
                        <h4>{{ $heading['feature_1_text'] ?? null }}</h4>
                        <p>{{ $heading['feature_1_description'] ?? null }}</p>
                    </div>
                </div>

                <!-- Single Features Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-feature-area text-center mb-50">
                        <div class="features-icon">
                            <i class="{{ $heading['feature_2_icon'] ?? null }}"></i>
                        </div>
                        <h4>{{ $heading['feature_2_text'] ?? null }}</h4>
                        <p>{{ $heading['feature_2_description'] ?? null }}</p>
                    </div>
                </div>
                <!-- Single Features Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-feature-area text-center mb-50">
                        <div class="features-icon">
                            <i class="{{ $heading['feature_3_icon'] ?? null }}"></i>
                        </div>
                        <h4>{{ $heading['feature_3_text'] ?? null }}</h4>
                        <p>{{ $heading['feature_3_description'] ?? null }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area -->
@else
@endif
