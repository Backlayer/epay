<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-welcome-tab" data-toggle="tab" href="#{{ $key }}-welcome" role="tab" aria-controls="{{ $key }}-welcome" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-welcome" role="tabpanel" aria-labelledby="{{ $key }}-welcome-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-welcome') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="short_title" class="required">{{ __('Short Title') }} ({{ $key }})</label>
                            <input type="text" name="short_title" id="short_title" class="form-control" value="{{ $headings['heading.welcome'][$key]['short_title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.welcome'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.welcome'][$key]['description'] ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="welcome_image_{{ $key }}" class="required">{{ __('Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_name' => 'image',
                                'input_id' => 'welcome_image_'.$key,
                                'preview' => $headings['heading.welcome'][$key]['image'] ?? null,
                                'value' => $headings['heading.welcome'][$key]['image'] ?? null
                            ]) }}
                        </div>

                        <div class="form-group">
                            <label for="button1_text" class="required">{{ __('Button 1 Text') }} ({{ $key }})</label>
                            <input type="text" name="button1_text" id="button1_text" class="form-control" value="{{ $headings['heading.welcome'][$key]['button1_text'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="button1_url" class="required">{{ __('Button 1 Url') }} ({{ $key }})</label>
                            <input type="text" name="button1_url" id="button1_url" class="form-control" value="{{ $headings['heading.welcome'][$key]['button1_url'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="button2_text" class="required">{{ __('Button 2 Text') }} ({{ $key }})</label>
                            <input type="text" name="button2_text" id="button2_text" class="form-control" value="{{ $headings['heading.welcome'][$key]['button2_text'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="button2_url" class="required">{{ __('Button 2 Url') }} ({{ $key }})</label>
                            <input type="text" name="button2_url" id="button2_url" class="form-control" value="{{ $headings['heading.welcome'][$key]['button2_url'] ?? null }}" required>
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
