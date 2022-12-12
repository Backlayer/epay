@extends('layouts.backend.app')

@section('title', __('Categories'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Categories list') }}</h4>
                    <form action="{{ route('admin.categories.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search by name') }}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-flush table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('S / N') }}</th>
                                <th>{{ __('User name') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Created At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index+1 }}</th>
                                <td>{{ $category->user->name }}</th>
                                <td>{{ $category->title }}</th>
                                <td>{{ formatted_date($category->created_at) }}</th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
