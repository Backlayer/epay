@extends('layouts.backend.app', [
  'button_name' => 'Create New',
  'button_link' => route('admin.kyc-method.create')
])

@section('title', __('Kyc Verification Methods'))

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('admin.kyc-method.mass-destroy')}}" class="mass_destroy">
                @csrf
                <div class="float-left mb-3">
                    <div class="input-group">
                        <select class="form-control action" name="method">
                            <option disabled selected>{{ __('Select Action') }}</option>
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
                    <th>{{ __('Image Accept') }}</th>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($kycMethods as $key =>  $row)

                  <tr>
                      <td> <input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                      <td>{{$key+1}}  </td>
                    <td>{{ $row->title}}</td>
                    <td><img src="{{ asset($row->image ?? 'uploads/default.png') }}" alt="" height="50"></td>
                    <td>
                        @if($row->image_accept == 1)
                            <span class="badge badge-success">{{ __('Yes') }} </span>
                        @else
                            <span class="badge badge-danger">{{ __('No') }} </span>
                        @endif
                    </td>
                    <td>{{ formatted_date($row->created_at) }}</td>
                      <td>
                    @if($row->status == 1)
                      <span class="badge badge-success">{{ __('Active') }} </span>
                     @else
                    <span class="badge badge-danger">{{ __('Inactive') }} </span>
                    @endif
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.kyc-method.edit', $row->id) }}"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          {{ $kycMethods->links('vendor.pagination.bootstrap-5') }}
        </div>
     </form>
      </div>
    </div>
  </div>
</div>
@endsection
