@extends('layouts.backend.app',[
    'prev' => route('admin.reviews.index')
])

@section('title', __('Reviews'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form class="ajaxform_with_redirect" method="post" action="{{ route('admin.reviews.update', $review->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- left side --}}
                    <div class="col-lg-5">
                        <strong>{{ __('Customer Image') }}</strong>
                        <p>{{ __('Upload User image here') }}</p>
                    </div>
                    {{-- /left side --}}
                    {{-- right side --}}
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}</label>
                                    {{ mediasection([
                                        'input_name' => 'image',
                                        'input_id' => 'image',
                                        'preview' => $review->value['image'] ?? null,
                                        'value' => $review->value['image'] ?? null,
                                    ]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- /right side --}}
                </div>

                <div class="row">
                    {{-- left side --}}
                    <div class="col-lg-5">
                        <strong>{{ __('Description') }}</strong>
                        <p>{{ __('Add your Review details and necessary information from here') }}</p>
                    </div>
                    {{-- /left side --}}
                    {{-- right side --}}
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="required">{{ __('Customer Name') }} </label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Customer Name" value="{{ $review->value['name'] ?? null }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="position" class="required">{{ __('Customer Position') }} </label>
                                    <input type="text" name="position" id="position" class="form-control" value="{{ $review->value['position'] ?? null }}" placeholder="Enter Customer Position" required>
                                </div>

                                <div class="form-group">
                                    <label for="rating" class="required">{{ __('Rating (5)') }} </label>
                                    <input type="number" name="rating" id="rating" class="form-control" value="{{ $review->value['rating'] ?? null }}" max="5" step="any" required>
                                </div>

                                <div class="form-group">
                                    <label for="comment" class="required">{{ __('Comment') }} </label>
                                    <textarea name="comment" id="comment" class="form-control" required>{{ $review->value['comment'] ?? null }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Status:') }}</label>
                                    <select name="status" class="form-control select2">
                                        <option value="1" {{$review->status == 1 ? 'selected':""}}>
                                            {{ __('Active') }}</option>
                                        <option value="0" {{$review->status == 0 ? 'selected':""}}>
                                            {{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary basicbtn" type="submit">
                                    <i class="fas fa-save"></i>
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('modal')
    {{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
@endpush
