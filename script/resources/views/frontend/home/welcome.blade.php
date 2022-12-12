@if(isset($data['headings']['heading.welcome']))
    @php
    $heading = $data['headings']['heading.welcome'];
    @endphp
    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <!-- Welcome Animation -->
        <div class="welcome-animation">
            <div class="square-shape"></div>
            <div class="bubble wb-two d-none d-md-block"></div>
            <div class="bubble b_three"></div>
            <div class="bubble b_four d-none d-sm-block"></div>
            <div class="square-shape1 d-none d-sm-block"></div>
            <div class="bubble b_six d-none d-sm-block"></div>
            <div class="triangle-shape2 d-none d-sm-block"></div>
        </div>
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <!-- Welcome Text -->
                <div class="col-lg-6">
                    <div class="welcome-text">
                        <h6>{{ $heading['short_title'] ?? null }}</h6>
                        <h2>{{ $heading['title'] ?? null }}</h2>
                        <p>{{ $heading['description'] ?? null }}</p>
                        <div class="button-area">
                            <a
                                class="hero-btn first mr-15-cu mb-2"
                                href="{{ $heading['button1_url'] ?? null }}"
                            >
                                {{ $heading['button1_text'] ?? null }}
                            </a>
                            <a
                                class="hero-btn two mb-2"
                                href="{{ $heading['button2_url'] ?? null }}"
                            >
                            {{ $heading['button2_text'] ?? null }}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Welcome Thumb -->
                <div class="col-lg-6">
                    <div class="welcome-thumb-area text-center">
                        <img src="{{ asset($heading['image'] ?? null) }}" alt="">
                    </div>
                </div>

            </div>
        </div>
        <!-- Welcome Bottom Shape Image -->
        <div class="header-shape">
            <img src="{{ asset('frontend/img/bg-img/bg-img.png') }}" class="img-fluid w-100" alt="">
        </div>
    </section>
    <!-- Welcome Area End -->
@else
@endif
