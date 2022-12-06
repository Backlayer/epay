@extends('layouts.backend.app')

@section('title', __('Footer Settings'))

@section('content')
    <section class="section">

        <div class="section-body">
            <form action="{{ route('admin.settings.website.footer.store') }}" class="ajaxform" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Footer Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="copyright">{{ __('Copyright Content') }}</label>
                            <input type="text" id="copyright" name="copyright" class="form-control" value="{{ $footer->copyright ?? null }}">
                        </div>
                        <div class="form-group">
                            <label for="about">{{ __('Footer About') }}</label>
                            <textarea id="about" name="about" class="form-control">{{ $footer->about ?? null }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 repeater">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>{{ __('Footer Social Links') }}</h4>

                        <button type="button" class="btn btn-primary btn-sm" data-repeater-create>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body" data-repeater-list="social">
                        @if(count($footer->social ?? []) > 0)
                            @foreach ($footer->social ?? [] as $key => $social)
                                <div class="input-group mb-3" data-repeater-item>
                                    <input type="text" name="icon_class" class="form-control icon_class" value="{{ $social->icon_class }}" placeholder="{{ __('Icon Class') }}" aria-label="{{ __('Icon Class') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="{{ $social->icon_class }}"></i>
                                        </span>
                                    </div>
                                    <input type="url" name="website_url" class="form-control" value="{{ $social->website_url }}" placeholder="{{ __('Website url') }}" aria-label="{{ __('Website Url') }}" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-danger" type="button" data-repeater-delete>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-3" data-repeater-item>
                                <input type="text" name="icon_class" class="form-control icon_class" placeholder="{{ __('Icon Class') }}" aria-label="{{ __('Icon Class') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i></i>
                                    </span>
                                </div>
                                <input type="url" name="website_url" class="form-control" placeholder="{{ __('Website url') }}" aria-label="{{ __('Website Url') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger" type="button" data-repeater-delete>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('admin/pages/footer.js') }}"></script>
@endpush
