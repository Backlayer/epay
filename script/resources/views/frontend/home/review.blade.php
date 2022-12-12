@if(isset($data['headings']['heading.review']))
    @php
        $heading = $data['headings']['heading.review'];
    @endphp
    <!-- Client Area Css -->
    <div class="client-area section-padding-100 bg-gray-cu">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-title text-center" data-aos="fade-down" data-aos-anchor-placement="top-bottom">
                        <h2><span>-</span>{{ $heading['title'] ?? null }}<span>-</span></h2>
                        <p>{{ $heading['description'] ?? null }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="client-slider owl-carousel">
                    @forelse($data['reviews'] ?? [] as $review)
                    <!-- Single Client Slider -->
                    <div class="single-clinet-slider">
                        <div class="client-text">
                            <div class="client-rating">
                                <span>"</span>
                            </div>
                            <p>{{ $review->comment }}</p>

                            <!-- Client Bottom -->
                            <div class="client-bottom-area d-flex align-content-center">
                                <div class="client-img">
                                    <img src="{{ asset($review->image) }}" alt="">
                                </div>

                                <div class="client-info">
                                    <h6>{{ $review->name }}</h6>
                                    <span>{{ $review->position }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Bg Shape -->
        <div class="client-bg-shape" data-aos="fade-up-right">
            <img src="{{ asset('frontend/img/bg-img/c-1.svg') }}" alt="">
        </div>
    </div>
    <!-- Client Area Css -->
@else
@endif
