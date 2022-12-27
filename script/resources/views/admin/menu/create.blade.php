@extends('layouts.backend.app')

@section('title', __('Create Menu'))

@section('content')
<div class="row" id="category_body">
	<div class="col-lg-4">      
		<div class="card">
			<div class="card-body">
				<form class="ajaxform_with_reload" method="post" action="{{ route('admin.menu.store') }}">
					@csrf
					<div class="custom-form">
						<div class="form-group">
							<label for="name">{{ __('Menu Name') }}</label>
							<input type="text" name="name" class="form-control" id="name" placeholder="Menu Name">
						</div>
						<div class="form-group">
							<label for="position">{{ __('Menu Position') }}</label>
							<select class="custom-select mr-sm-2" id="position" name="position">
								<option value="header">{{ __('Header') }}</option>
								<option value="footer">{{ __('Footer') }}</option>
								<option value="footer_left_menu">{{ __('Footer left Menu') }}</option>
								<option value="footer_right_menu">{{ __('Footer Right Menu') }}</option>
							</select>
						</div>
						<div class="form-group">
							<label for="lang">{{ __('Select Language') }}</label>
							<select class="custom-select mr-sm-2" id="lang" name="lang">
								@foreach($langs as $key=> $row)
								<option value="{{ $key }}">{{ $row }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="position">{{ __('Menu Status') }}</label>
							<select class="custom-select mr-sm-2" id="status" name="status">
								<option value="1">{{ __('Active') }}</option>
								<option value="0" selected="">{{ __('Draft') }}</option>
							</select>
						</div>
						<div class="form-group mt-20">
							<button class="btn btn-primary col-12" type="submit">{{ __('Add New Menu') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-8" >      
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<div class="card-action-filter">
						<form class="ajaxform_with_reload" method="post" action="{{ route('admin.menus.destroy') }}">
							@csrf
							<div class="card-filter-content d-flex">
								<div class="single-filter">
									<div class="form-group">
										<select class="form-control selectric" name="method">
											<option >{{ __('Select Actions') }}</option>
											<option value="delete">{{ __('Delete Permanently') }}</option>
										</select>
									</div>
								</div>
								<div class="single-filter ml-1">
									<button type="submit" class="btn btn-primary btn-lg">{{ __('Apply') }}</button>
								</div>
							</div>
						</div>
						<div id="menuArea">
							<table class="table text-center category">
								<thead>
									<tr>
										<th class="am-select">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input checkAll" id="checkAll">
												<label class="custom-control-label" for="checkAll"></label>
											</div>
										</th>
										<th class="am-title">{{ __('Title') }}</th>
										<th class="am-title">{{ __('Postion') }}</th>
										<th class="am-title">{{ __('Language') }}</th>
										<th class="am-title">{{ __('Status') }}</th>
										<th class="am-title">{{ __('Customize') }}</th>
										<th class="am-title">{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach(App\Models\Menu::latest()->get() as $menu)
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="ids[]" class="custom-control-input" id="customCheck{{ $menu->id }}" value="{{ $menu->id }}">
											<label class="custom-control-label" for="customCheck{{ $menu->id }}"></label>
										</div>
									</td>
									<td>{{ $menu->name }} </td>
									<td>{{ $menu->position }}</td>
									<td>{{ $menu->lang }}</td>
									<td>@if($menu->status==1) <p class="badge badge-success">{{ __('Active Menu') }}</p> @else <p class="badge badge-danger">{{ __('Draft Menu') }}</p> @endif</td>
									
									<td><a href="{{ route('admin.menu.show',$menu->id) }}"><i class="fas fa-arrows-alt"></i> {{ __('Customize') }}</a></td>
									<td><a  class="text-success" href="{{ route('admin.menu.edit',$menu->id) }}" ><i class="far fa-edit"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</form>	
						<tfoot>
							<tr>
								<th class="am-select">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input checkAll" id="checkAll">
										<label class="custom-control-label" for="checkAll"></label>
									</div>
								</th>
								<th class="am-title">{{ __('Title') }}</th>
								<th class="am-author">{{ __('Postion') }}</th>
								<th class="am-title">{{ __('Language') }}</th>
								<th class="am-author">{{ __('Status') }}</th>
								<th class="am-title">{{ __('Customize') }}</th>
								<th class="am-author">{{ __('Action') }}</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>				
@endsection