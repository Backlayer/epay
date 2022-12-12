@extends('layouts.backend.app',[
    'prev'=> route('admin.language.index')
])

@section('title', __('Edit Phrases'))

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Edit Language') }}</h4>
				<div class="card-header-action">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						{{ __('Add New Key') }}
					</button>
				</div>
			</div>
			<div class="card-body">
                <form class="ajaxform" action="{{ route('admin.language.update', $id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="phase-key">
                            <thead>
                            <tr>
                                <th width="50%">{{ __('Key') }}</th>
                                <th width="50%">{{ __('Value') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phrases ?? [] as $key => $row)
                                <tr>
                                    <td>
                                        <label for="values-{{ $key }}">
                                            {{ $key }}
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="values[{{ $key }}]" id="values-{{ $key }}" class="form-control w-100" value="{{ $row }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col-sm-12 col-md-12">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form method="post" class="ajaxform_with_reset" action="{{ route('admin.language.add_key') }}">
		@csrf
		<input type="hidden" name="id" value="{{ $id }}">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{ __('Add Key For ') }} <b>{{ $id }}</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="key" class="required">{{ __('Key') }}</label>
						<input type="text" name="key" id="key" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="value" class="required">{{ __('Value') }}</label>
						<input type="text" name="value" id="value" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
					<button type="submit" class="btn btn-primary basicbtn">{{ __('Save changes') }}</button>
				</div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        "use strict";
        $('#phase-key').dataTable()
    </script>
@endpush
