@if(isset($data['headings']['heading.latest-news']))
    @php
        $heading = $data['headings']['heading.latest-news'] ?? [];
        $posts = $data['blog'] ?? [];
    @endphp
        <!-- Blog Area -->
    <div class="blog-area section-padding-0-50">
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
                @forelse($posts as $post)
                <!-- Single Blog -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-blog-area mb-50">
                        <div class="blog-image">
                            <img src="{{ $post->preview ? asset($post->preview->value ?? null) : asset('admin/img/img/placeholder.png')}}" alt="">
                        </div>
                        <h4><a href="{{ route('frontend.blog.show', $post->slug) }}">{{ str($post->title)->words(7, '...') }}</a></h4>
                        <p>{{ str($post->excerpt->value ?? null)->words(16, '...') }}</p>
                        <div class="blog-btn">
                            <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ __('Read more') }} <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
    <!-- Blog Area -->
@else
@endif
