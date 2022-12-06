<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-capture-tab" data-toggle="tab" href="#{{ $key }}-capture" role="tab" aria-controls="{{ $key }}-capture" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-capture" role="tabpanel" aria-labelledby="{{ $key }}-capture-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-capture') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="short_title" class="required">{{ __('Short Title') }} ({{ $key }})</label>
                            <input type="text" name="short_title" id="short_title" class="form-control" value="{{ $headings['heading.capture'][$key]['short_title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.capture'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="capture_image_{{ $key }}" class="required">{{ __('Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_name' => 'image',
                                'input_id' => 'capture_image_'.$key,
                                'preview' => $headings['heading.capture'][$key]['image'] ?? null,
                                'value' => $headings['heading.capture'][$key]['image'] ?? null
                            ]) }}
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="capture_1_title" class="required">{{ __('Capture :number Title', ['number' => 1]) }} ({{ $key }})</label>
                                            <input type="text" name="capture_1_title" id="capture_1_title" class="form-control" value="{{ $headings['heading.capture'][$key]['capture_1_title'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="capture_1_description" class="required">
                                                {{ __('Capture :number Description', ['number' => 1]) }} ({{ $key }})
                                            </label>
                                            <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ __('Support Html') }}"></i>
                                            <textarea name="capture_1_description" id="capture_1_description" class="form-control" required>{{ $headings['heading.capture'][$key]['capture_1_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="capture_2_title" class="required">{{ __('Capture :number Title', ['number' => 2]) }} ({{ $key }})</label>
                                            <input type="text" name="capture_2_title" id="capture_2_title" class="form-control" value="{{ $headings['heading.capture'][$key]['capture_2_title'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="capture_2_description" class="required">{{ __('Capture :number Description', ['number' => 2]) }} ({{ $key }})</label>
                                            <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ __('Support Html') }}"></i>
                                            <textarea name="capture_2_description" id="capture_2_description" class="form-control" required>{{ $headings['heading.capture'][$key]['capture_2_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="capture_3_title" class="required">{{ __('Capture :number Title', ['number' => 3]) }} ({{ $key }})</label>
                                            <input type="text" name="capture_3_title" id="capture_3_title" class="form-control" value="{{ $headings['heading.capture'][$key]['capture_3_title'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="capture_3_description" class="required">{{ __('Capture :number Description', ['number' => 3]) }} ({{ $key }})</label>
                                            <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ __('Support Html') }}"></i>
                                            <textarea name="capture_3_description" id="capture_3_description" class="form-control" required>{{ $headings['heading.capture'][$key]['capture_3_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
