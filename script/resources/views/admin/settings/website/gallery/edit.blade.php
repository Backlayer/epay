@extends('layouts.backend.app', [
    'prev'=> route('admin.settings.website.gallery.index')
])

@section('title','Edit Gallery')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
@endsection

@section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <form class="ajaxform" method="post" action="{{ route('admin.settings.website.gallery.update',$page->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- left side --}}
                        <div class="col-lg-5">
                            <strong>{{ __('Image') }}</strong>
                            <p>{{ __('Upload Gallery image here') }}</p>

                        </div>
                        {{-- /left side --}}
                        {{-- right side --}}
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    {{ mediasection([
                                        'input_name' => 'preview',
                                        'input_id' => 'preview',
                                        'preview' => $page->preview->value ?? null,
                                        'value' => $page->preview->value ?? null,
                                    ]) }}
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
                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Category :') }} </label>
                                        <div class="col-lg-12">
                                            <select name="category" class="form-control">
                                                @foreach($category as $c)
                                                    <option @selected($c->id == $page->categories->first()->pivot->category_id)  value="{{$c->id}}">{{$c->category}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Title :') }} </label>
                                        <div class="col-lg-12">
                                            <input type="text" value="{{ $page->title }}" class="form-control"
                                                   placeholder="{{ __('Title') }}" required name="name">
                                        </div>
                                    </div>
                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Description :') }} </label>
                                        <div class="col-lg-12">
                                            <textarea name="excerpt" cols="30" rows="10"
                                                      class="form-control">{{ $page->excerpt->value ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Support :') }} </label>
                                        <div class="col-lg-12">
                                            <input type="text" value="{{ $page->support->value }}" class="form-control"
                                                   placeholder="{{ __('Support') }}" required name="support">
                                        </div>
                                    </div>


                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Status :') }} </label>
                                        <div class="col-lg-12">
                                            <select name="status" class="form-control">
                                                <option value="1"
                                                        @if($page->status == 1) selected @endif>{{ __('Active') }}</option>
                                                <option value="0"
                                                        @if($page->status == 0) selected @endif>{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Is Featured ? :') }} </label>
                                        <div class="col-lg-12">
                                            <select name="featured" class="form-control">
                                                <option value="1"
                                                        @if($page->featured == 1) selected @endif>{{ __('Active') }}</option>
                                                <option value="0"
                                                        @if($page->featured == 0) selected @endif>{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="from-group row mb-2">
                                        <label for="" class="col-lg-12">{{ __('Select Language :') }} </label>
                                        <div class="col-lg-12">
                                            <select name="lang" class="form-control">
                                                @php
                                                    $languages=get_option('languages',true);
                                                @endphp
                                                @foreach($languages as $key => $row)
                                                    <option value="{{ $key }}"
                                                            @if($page->lang == $key) selected="" @endif>{{ __($row) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="blog">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn btn-primary basicbtn"
                                                    type="submit">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection

@section('modal')
    {{ mediasingle() }}
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote.js') }}"></script>

@endpush
