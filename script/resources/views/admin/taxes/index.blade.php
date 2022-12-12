@extends('layouts.backend.app', [
    'button_name' => __('Add New'),
    'button_link' => route('admin.taxes.create'),
])

@section('title', __('Taxes'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ __('Tax List') }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Rate') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($taxes ?? [] as $tax)
                            <tr>
                                <td>{{ $tax->name }}</td>
                                <td>
                                    {{ $tax->rate }}
                                </td>
                                <td>{{ $tax->type }}</td>
                                <td>
                                    @if ($tax->status)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a class="btn btn-warning" href="{{ route('admin.taxes.edit', $tax->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a class="btn btn-danger delete-confirm" href="javascript:void(0)" data-action="{{ route('admin.taxes.destroy', $tax->id) }}">
                                            <i class="fas fa-trash"></i>
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
@endsection