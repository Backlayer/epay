<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-payment-tab" data-toggle="tab" href="#{{ $key }}-payment" role="tab" aria-controls="{{ $key }}-payment" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-payment" role="tabpanel" aria-labelledby="{{ $key }}-payment-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-payment') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.payment'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.payment'][$key]['description'] ?? null }}</textarea>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="payment_1_icon" class="required">{{ __('Payment 1 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="payment_1_icon" id="payment_1_icon" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_1_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_1_text" class="required">{{ __('Payment 1 Text') }} ({{ $key }})</label>
                                            <input type="text" name="payment_1_text" id="payment_1_text" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_1_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_1_description" class="required">{{ __('Payment 1 Description') }} ({{ $key }})</label>
                                            <textarea name="payment_1_description" id="payment_1_description" class="form-control" required>{{ $headings['heading.payment'][$key]['payment_1_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="payment_2_icon" class="required">{{ __('Payment 2 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="payment_2_icon" id="payment_2_icon" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_2_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_2_text" class="required">{{ __('Payment 2 Text') }} ({{ $key }})</label>
                                            <input type="text" name="payment_2_text" id="payment_2_text" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_2_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_2_description" class="required">{{ __('Payment 2 Description') }} ({{ $key }})</label>
                                            <textarea name="payment_2_description" id="payment_2_description" class="form-control" required>{{ $headings['heading.payment'][$key]['payment_2_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="payment_3_icon" class="required">{{ __('Payment 3 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="payment_3_icon" id="payment_3_icon" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_3_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_3_text" class="required">{{ __('Payment 3 Text') }} ({{ $key }})</label>
                                            <input type="text" name="payment_3_text" id="payment_3_text" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_3_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_3_description" class="required">{{ __('Payment 3 Description') }} ({{ $key }})</label>
                                            <textarea name="payment_3_description" id="payment_3_description" class="form-control" required>{{ $headings['heading.payment'][$key]['payment_3_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="payment_4_icon" class="required">{{ __('Payment 4 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="payment_4_icon" id="payment_4_icon" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_4_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_4_text" class="required">{{ __('Payment 4 Text') }} ({{ $key }})</label>
                                            <input type="text" name="payment_4_text" id="payment_4_text" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_4_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_4_description" class="required">{{ __('Payment 4 Description') }} ({{ $key }})</label>
                                            <textarea name="payment_4_description" id="payment_4_description" class="form-control" required>{{ $headings['heading.payment'][$key]['payment_4_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="payment_5_icon" class="required">{{ __('Payment 5 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="payment_5_icon" id="payment_5_icon" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_5_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_5_text" class="required">{{ __('Payment 5 Text') }} ({{ $key }})</label>
                                            <input type="text" name="payment_5_text" id="payment_5_text" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_5_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_5_description" class="required">{{ __('Payment 5 Description') }} ({{ $key }})</label>
                                            <textarea name="payment_5_description" id="payment_5_description" class="form-control" required>{{ $headings['heading.payment'][$key]['payment_5_description'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="payment_6_icon" class="required">{{ __('Payment 6 Icon') }} ({{ $key }})</label>
                                            <input type="text" name="payment_6_icon" id="payment_6_icon" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_6_icon'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_6_text" class="required">{{ __('Payment 6 Text') }} ({{ $key }})</label>
                                            <input type="text" name="payment_6_text" id="payment_6_text" class="form-control" value="{{ $headings['heading.payment'][$key]['payment_6_text'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_6_description" class="required">{{ __('Payment 6 Description') }} ({{ $key }})</label>
                                            <textarea name="payment_6_description" id="payment_6_description" class="form-control" required>{{ $headings['heading.payment'][$key]['payment_6_description'] ?? null }}</textarea>
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
