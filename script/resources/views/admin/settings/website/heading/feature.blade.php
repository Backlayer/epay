<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-feature-tab" data-toggle="tab" href="#{{ $key }}-feature" role="tab" aria-controls="{{ $key }}-feature" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-feature" role="tabpanel" aria-labelledby="{{ $key }}-feature-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-feature') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.feature'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.feature'][$key]['description'] ?? null }}</textarea>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="feature_1_icon" class="required">{{ __('Feature 1 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="feature_1_icon" id="feature_1_icon" class="form-control" value="{{ $headings['heading.feature'][$key]['feature_1_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_1_text" class="required">{{ __('Feature 1 Text') }} ({{ $key }})</label>
                                            <input type="text" name="feature_1_text" id="feature_1_text" class="form-control" value="{{ $headings['heading.feature'][$key]['feature_1_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_1_description" class="required">{{ __('Feature 1 Description') }} ({{ $key }})</label>
                                            <textarea name="feature_1_description" id="feature_1_description" class="form-control" required>{{ $headings['heading.feature'][$key]['feature_1_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="feature_2_icon" class="required">{{ __('Feature 2 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="feature_2_icon" id="feature_2_icon" class="form-control" value="{{ $headings['heading.feature'][$key]['feature_2_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_2_text" class="required">{{ __('Feature 2 Text') }} ({{ $key }})</label>
                                            <input type="text" name="feature_2_text" id="feature_2_text" class="form-control" value="{{ $headings['heading.feature'][$key]['feature_2_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_2_description" class="required">{{ __('Feature 2 Description') }} ({{ $key }})</label>
                                            <textarea name="feature_2_description" id="feature_2_description" class="form-control" required>{{ $headings['heading.feature'][$key]['feature_2_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="feature_3_icon" class="required">{{ __('Feature 3 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="feature_3_icon" id="feature_3_icon" class="form-control" value="{{ $headings['heading.feature'][$key]['feature_3_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_3_text" class="required">{{ __('Feature 3 Text') }} ({{ $key }})</label>
                                            <input type="text" name="feature_3_text" id="feature_3_text" class="form-control" value="{{ $headings['heading.feature'][$key]['feature_3_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_3_description" class="required">{{ __('Feature 3 Description') }} ({{ $key }})</label>
                                            <textarea name="feature_3_description" id="feature_3_description" class="form-control" required>{{ $headings['heading.feature'][$key]['feature_3_description'] ?? null }}</textarea>
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
