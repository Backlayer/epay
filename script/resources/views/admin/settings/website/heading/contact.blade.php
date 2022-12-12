<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-contact-tab" data-toggle="tab" href="#{{ $key }}-contact" role="tab" aria-controls="{{ $key }}-contact" aria-selected="true">{{ $value }} ({{ $key }})</a>
                </li>
                @php
                    $i++;
                @endphp
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content tab-bordered" id="myTab3Content">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-contact" role="tabpanel" aria-labelledby="{{ $key }}-contact-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-contact') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.contact'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required">{{ __('Phone') }} ({{ $key }})</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ $headings['heading.contact'][$key]['phone'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">{{ __('Email') }} ({{ $key }})</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $headings['heading.contact'][$key]['email'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="location" class="required">{{ __('Our Location') }} ({{ $key }})</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ $headings['heading.contact'][$key]['location'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="map_url" class="required">{{ __('Map URL') }} ({{ $key }})</label>
                            <input type="url" name="map_url" id="map_url" class="form-control" value="{{ $headings['heading.contact'][$key]['map_url'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary basicbtn">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</div>
