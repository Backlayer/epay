@extends('layouts.backend.app', [
    'prev' => route('admin.supports.index')
])

@section('title', __('Edit Support'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Support Chat') }}</h4>
                </div>
                @foreach ($support as $msg)
                    <div class="offset-2 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fas fa-circle text-success mr-2" title="Online" data-toggle="tooltip"></i> {{ __('Support Request from') }} {{ $msg->user->name }}</h4>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <td>{{ __('Title') }}</td>
                                    <td>{{ $msg->title  }}</td>
                                </tr>
                                @foreach ($msg->meta as $meta)
                                    <tr>
                                        <td>{{ $meta->type == 1 ?  'Comment' : 'Reply from Admin' }} </td>
                                        <td>{{ $meta->comment }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
                <div class="offset-2 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-circle text-success mr-2" title="Online" data-toggle="tooltip"></i>{{ __('Reply') }}</h4>
                        </div>
                        <form method="POST" action="{{ route('admin.support.update', $id) }}" class="ajax_with_reload">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Comment') }}</label>
                                            <textarea name="comment" class="form-control" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-lg float-right w-100 basicbtn">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

