@extends('layouts.backend.app',[
    'button_name' => __('Add New'),
    'button_link' => route('admin.settings.website.faq.create')
])

@section('title', __('Faq'))
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('SL.') }}</th>
                        <th>{{ __('Question') }}</th>
                        <th>{{ __('Answer') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($faqs ?? [] as $index => $item)
                    <tr>
                        <td>{{  $index + 1 }}</td>
                        <td>{{ $item->question ?? null }}</td>
                        <td>{{ $item->answer ?? null }}</td>
                        <td>
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{ __('Action') }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item has-icon"
                                   href="{{ route('admin.settings.website.faq.edit', $item->id) }}">
                                    <i class="fa fa-edit"></i>
                                    {{ __('Edit') }}
                                </a>


                                <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)"
                                   data-action="{{ route('admin.settings.website.faq.destroy', $item->id) }}">
                                    <i class="fa fa-trash"></i>
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
@endsection
