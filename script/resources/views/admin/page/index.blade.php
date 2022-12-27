@extends('layouts.backend.app', [
    'button_name' => 'Add New',
    'button_link' => route('admin.page.create')
])

@section('title', _('Page List'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.page.delete-all') }}" class="ajaxform_with_reload">
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAll"></th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Url') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                 <tr>
                                    <td> <input type="checkbox" disabled=""></td>
                                    <td>{{ __('Home Page') }} (Default)</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text copyLinkBtn"   data-id="{{ url('/') }}"  >{{ __('Copy link!') }}</button>
                                            </div>
                                            <input id="copy-link" class="form-control" type="text" value="{{ url('/') }}">
                                        </div>
                                    </td>
                                   <td class="text-success">{{ __('Active') }}</td>
                                   
                                    <td>{{ date('d-m-Y', strtotime(now())) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon"
                                                   href="{{ route('admin.settings.website.heading.index') }}"><i
                                                        class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td> <input type="checkbox" disabled="" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></td>
                                    <td>{{ __('About Page') }}  (Default)</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text copyLinkBtn"   data-id="{{ url('/about') }}"  >{{ __('Copy link!') }}</button>
                                            </div>
                                            <input id="copy-link" class="form-control" type="text" value="{{ url('/about') }}">
                                        </div>
                                    </td>
                                   <td class="text-success">{{ __('Active') }}</td>
                                   
                                    <td>{{ date('d-m-Y', strtotime(now())) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon"
                                                   href="{{ route('admin.settings.website.about.index') }}"><i
                                                        class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            @foreach($all_page as $row)
                                <tr>
                                    <td> <input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                                    <td>{{ $row->title }}</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text copyLinkBtn"   data-id="{{ url('/page',$row->slug) }}"  >{{ __('Copy link!') }}</button>
                                            </div>
                                            <input id="copy-link" class="form-control" type="text" value="{{ url('/page',$row->slug) }}">
                                        </div>
                                    </td>
                                    @if($row->status == 1)
                                        <td class="text-success">{{ __('Active') }}</td>
                                    @endif
                                    @if($row->status == 0)
                                        <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif
                                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon"
                                                   href="{{ route('admin.page.edit', $row->id) }}"><i
                                                        class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $all_page->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        "use strict";
        $(document).on('click', '.copyLinkBtn',function () {
            const url = $(this).data('id');
            if (navigator.clipboard && window.isSecureContext) {
                Sweet('success','Link Copy Successfully');
                return navigator.clipboard.writeText(url);
            } else {
                // text area method
                Sweet('success','Link Copy Successfully');
                let textArea = document.createElement("textarea");
                textArea.value = url;
                // make the textarea out of viewport
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                return new Promise((res, rej) => {
                    // here the magic happens
                    document.execCommand('copy') ? res() : rej();
                    textArea.remove();
                });
            }
        })
    </script>
@endpush
