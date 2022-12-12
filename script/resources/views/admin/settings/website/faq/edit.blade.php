@extends('layouts.backend.app',[
     'prev'=> route('admin.settings.website.faq.index')
])

@section('title', __('Edit Faq'))


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform_with_redirect" method="post" action="{{ route('admin.settings.website.faq.update', $faq->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="question" class="required">{{ __('Question') }}</label>
                            <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}" required>
                        </div>

                        <div class="form-group">
                            <label for="answer" class="required">{{ __('Answer') }}</label>
                            <textarea name="answer" id="answer" class="form-control" required>{{ $faq->question }}</textarea>
                        </div>

                        <button class="btn btn-primary basicbtn">
                            <i class="fas fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
