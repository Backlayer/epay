@extends('layouts.backend.app',[
     'prev'=> route('admin.settings.website.faq.index')
])

@section('title', __('Create FAQ'))


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform_with_reset" method="post" action="{{ route('admin.settings.website.faq.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="question" class="required">{{ __('Question') }}</label>
                            <input type="text" name="question" id="question" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="answer" class="required">{{ __('Answer') }}</label>
                            <textarea name="answer" id="answer" class="form-control" required></textarea>
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
