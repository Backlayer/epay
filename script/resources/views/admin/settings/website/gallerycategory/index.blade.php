@extends('layouts.backend.app', [
  'button_name' => __('Add New'),
  'button_link' => route('admin.settings.website.gallery-category.create')
])

@section('title', __('Gallery Category'))

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <div class="clearfix mb-3"></div>
               <div class="table-responsive">
                  <table class="table table-striped">
                <thead>
                  <tr>
                    <th>{{ __('Sl') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $key =>  $row)
                  <tr>
                      <td>{{$key+1}}</td>
                    <td>{{ $row->category }}</td>
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
                                <a class="dropdown-item has-icon" href="{{ route('admin.settings.website.gallery-category.edit', $row->id) }}"><i class="fa fa-edit"></i>{{ __('edit') }}</a>
                                <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)"
                                   data-action="{{ route('admin.settings.website.gallery-category.destroy', $row->id) }}">
                                    <i class="fa fa-trash"></i>
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          {{ $categories->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
