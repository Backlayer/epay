@if(isset($data['headings']['heading.faq']))
    @php
        $heading = $data['headings']['heading.faq'];
    @endphp
    <div class="faq-area section-padding-100-50">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-title text-center" data-aos="fade-down" data-aos-anchor-placement="top-bottom">
                        <h2><span>-</span>{{ $heading['title'] ?? null }}<span>-</span></h2>
                        <p>{{ $heading['description'] ?? null }}</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-9 col-lg-6">
                    <div class="faq-content mb-50">
                        <div class="accordion faq-accordian " id="faqaccordian">
                            @forelse($data['faqs'] ?? [] as $faq)
                            <!-- Single FAQ -->
                            <div class="card border-0">
                                <div class="card-header tab-heading-card" id="heading{{ $loop->index }}">
                                    <button class="btn tab-heading" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? "true": "false" }}"
                                            aria-controls="collapse{{ $loop->index }}">{{ $faq->question }}</button>
                                </div>
                                <div @class(['collapse', 'show' => $loop->first]) id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}"
                                     data-bs-parent="#faqaccordian">
                                    <div class="card-body">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@else
@endif
