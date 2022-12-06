@extends('layouts.backend.app', [
   'prev'=> route('admin.settings.website.gallery-category.index')
])

@section('title','Edit Gallery Category')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform" method="post" action="{{ route('admin.settings.website.gallery-category.update',$category->id) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="category" class="required">{{ __('Category Name') }}</label>
                            <input type="text" name="category"  value="{{$category->category}}" id="category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="category" class="required">{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1"
                                        @if($category->status == 1) selected @endif>{{ __('Active') }}</option>
                                <option value="0"
                                        @if($category->status == 0) selected @endif>{{ __('Inactive') }}</option>
                            </select>
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

