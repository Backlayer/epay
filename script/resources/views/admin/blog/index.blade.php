@extends('layouts.backend.app', [
  'button_name' => __('Add New'),
  'button_link' => route('admin.blog.create')
])

@section('title', __('Blog Lists'))

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.blog.delete-all') }}" class="ajaxform_with_reload">
                @csrf
                <div class="float-left mb-3">
                    <div class="input-group">
                        <select class="form-control action" name="method">
                            <option value="">{{ __('Select Action') }}</option>
                            <option value="delete">{{ __('Delete Permanently') }}</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>


               <div class="clearfix mb-3"></div>
               <div class="table-responsive">
                  <table class="table table-striped">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="checkAll"></th>
                    <th>{{ __('Sl') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th><i class="fa fa-image"></i></th>
                    <th>{{ __('Url') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($posts as $key =>  $row)
                  <tr>
                      <td> <input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                      <td>{{$key+1}}</td>
                    <td>{{ $row->title }}</td>
                    <td><img src="{{ asset($row->preview->value ?? 'uploads/default.png') }}" alt="" height="50"></td>
                    <td>{{ url('/blog',$row->slug) }}</td>
                    @if($row->status == 1)
                    <td class="text-success">{{ __('Active') }}</td>
                    @endif
                    @if($row->status == 0)
                    <td class="text-danger">{{ __('Inactive') }}</td>
                    @endif
                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                    <td>
                      <div class="dropdown d-inline">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item has-icon" href="{{ route('admin.blog.edit', $row->id) }}"><i class="fa fa-edit"></i>{{ __('edit') }}</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          {{ $posts->links('vendor.pagination.bootstrap-5') }}
        </div>
     </form>
      </div>
    </div>
  </div>
</div>
@endsection
