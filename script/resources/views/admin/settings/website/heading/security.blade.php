<div class="card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-security-tab" data-toggle="tab" href="#{{ $key }}-security" role="tab" aria-controls="{{ $key }}-security" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-security" role="tabpanel" aria-labelledby="{{ $key }}-security-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-security') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.security'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $headings['heading.security'][$key]['description'] ?? null }}</textarea>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="security_1_icon" class="required">{{ __('Security :number Icon', ['number' => 1]) }} ({{ $key }})</label>
                                            <input type="text" name="security_1_icon" id="security_1_icon" class="form-control" value="{{ $headings['heading.security'][$key]['security_1_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="security_1_title" class="required">{{ __('Security :number Title', ['number' => 1]) }} ({{ $key }})</label>
                                            <input type="text" name="security_1_title" id="security_1_title" class="form-control" value="{{ $headings['heading.security'][$key]['security_1_title'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="security_1_description" class="required">
                                                {{ __('Security :number Description', ['number' => 1]) }} ({{ $key }})
                                            </label>
                                            <textarea name="security_1_description" id="security_1_description" class="form-control" required>{{ $headings['heading.security'][$key]['security_1_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="security_2_icon" class="required">{{ __('Security :number Icon', ['number' => 2]) }} ({{ $key }})</label>
                                            <input type="text" name="security_2_icon" id="security_2_icon" class="form-control" value="{{ $headings['heading.security'][$key]['security_2_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="security_2_title" class="required">{{ __('Security :number Title', ['number' => 2]) }} ({{ $key }})</label>
                                            <input type="text" name="security_2_title" id="security_2_title" class="form-control" value="{{ $headings['heading.security'][$key]['security_2_title'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="security_2_description" class="required">
                                                {{ __('Security :number Description', ['number' => 2]) }} ({{ $key }})
                                            </label>
                                            <textarea name="security_2_description" id="security_2_description" class="form-control" required>{{ $headings['heading.security'][$key]['security_2_description'] ?? null }}</textarea>
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
