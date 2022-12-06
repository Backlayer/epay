@extends('layouts.backend.app', [
	'button_name' => __('Add Menu'),
	'button_link' => route('admin.menu.create')
])

@section('title', __('Menu Lists'))

@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}"/>
@endpush

@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="mb-20">{{ __('Menu List') }}</h4>
				<div class="row">
					<div class="col-lg-12">
						<form id="frmEdit" class="form-horizontal">
							<div class="custom-form">
								<div class="form-group">
									<label for="text">{{ __('Text') }}</label>
									<div class="input-group">
										<input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text" autocomplete="off">
										<div class="input-group-append">
											<button type="button" id="myEditor_icon" class="btn btn-primary btn-sm"></button>
										</div>
									</div>
									<input type="hidden" name="icon" class="item-menu">
								</div>
								<div class="form-group">
									<label for="href">{{ __('URL') }}</label>
									<input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL" required autocomplete="off">
								</div>
								<div class="form-group">
									<label for="target">{{ __('Target') }}</label>
									<select name="target" id="target" class="custom-select mr-sm-2 item-menu">
										<option value="_self">{{ __('Self') }}</option>
										<option value="_blank">{{ __('Blank') }}</option>
										<option value="_top">{{ __('Top') }}</option>
									</select>
								</div>
								<div class="form-group none">
									<label for="title">{{ __('Tooltip') }}</label>
									<input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
								</div>
							</div>
						</form>
						<div class="menu-add-update d-flex">
							<button type="button" id="btnUpdate" class="btn btn-update  btn-warning text-white col-6 mr-2" disabled><i class="fas fa-sync-alt"></i> {{ __('Update') }}</button>
							<button type="button" id="btnAdd" class="btn btn-success col-6 "><i class="fas fa-plus"></i> {{ __('Add') }}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row mb-10" >
					<div class="col-lg-6">
						<h4>{{ __('Menu structure') }}</h4>
					</div>
					<div class="col-lg-6">
						<div class="save-menu float-right" >
							<form class="ajaxform" class="float-right" method="post" action="{{ route('admin.menus.MenuNodeStore') }}"> @csrf <input type="hidden" name="data" id="data"> <input type="hidden" name="menu_id" value="{{ $menu->id }}"> <button id="form-button" class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button></form>
						</div>
					</div>
				</div>
				<ul id="myEditor" class="sortableLists list-group">
				</ul>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="menu_data" value="{{ $menu->data }}">
@endsection

@push('script')
<script src="{{ asset('admin/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/jquery-menu-editor.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap-iconpicker/js/menu.js') }}"></script>
@endpush
