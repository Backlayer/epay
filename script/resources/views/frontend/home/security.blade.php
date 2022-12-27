@if(isset($data['headings']['heading.security']))
    @php
        $heading = $data['headings']['heading.security'];
    @endphp
    <!-- Security Area -->
    <div class="security-area section-padding-0-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-title text-center" data-aos="fade-down" data-aos-anchor-placement="top-bottom">
                        <h2><span>-</span>{{ $heading['title'] ?? null }}<span>-</span></h2>
                        <p>{{ $heading['title'] ?? null }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Card -->
                <div class="col-md-6">
                    <div class="single-security-area">
                        <div class="security-icon">
                            <i class="{{ $heading['security_1_icon'] ?? null }}"></i>
                        </div>
                        <h4>{{ $heading['security_1_title'] ?? null }}</h4>
                        <p>{{ $heading['security_1_description'] ?? null }}</p>

                        <div class="bg-shape-ecurity" data-aos="fade-up-right">
                            <img src="{{ asset('frontend/img/bg-img/c-1.svg') }}" alt="">
                        </div>
                    </div>
                </div>

                <!-- Single Card -->
                <div class="col-md-6">
                    <div class="single-security-area">
                        <div class="security-icon">
                            <i class="{{ $heading['security_2_icon'] ?? null }}"></i>
                        </div>
                        <h4>{{ $heading['security_2_title'] ?? null }}</h4>
                        <p>{{ $heading['security_2_description'] ?? null }}</p>

                        <div class="bg-shape-ecurity" data-aos="fade-up-right">
                            <img src="{{ asset('frontend/img/bg-img/c-1.svg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Security Area -->
@else
@endif
