@extends('layouts.backend.app', [
   'prev'=> route('admin.settings.website.gallery-category.index')
])

@section('title','Create Gallery Category')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform_with_reset" method="post" action="{{ route('admin.settings.website.gallery-category.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="category" class="required">{{ __('Category Name') }}</label>
                            <input type="text" name="category" placeholder="{{ __('Enter Category Name') }}" id="category" class="form-control" required>
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

