@extends('layouts.backend.app', [
    'button_name' => __('Add New Gateway'),
    'button_link' => route('admin.payment-gateways.create')
])

@section('title', __('Gateway List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table" id="table-2">
                        <thead>
                        <tr>
                            <th>{{ __('SL.') }}</th>
                            <th>{{ __('Logo') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Currency') }}</th>
                            <th>{{ __('Min. Amount') }}</th>
                            <th>{{ __('Max. Amount') }}</th>
                            <th>{{ __('Namespace') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($gateways ?? [] as $gateway)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img height="50" class="border rounded p-1" src="{{ asset($gateway->logo) }}" alt="{{ $gateway->name }}">
                                </td>
                                <td>{{ $gateway->name }}</td>
                                <td>{{ $gateway->currency->code }}</td>
                                <td>{{ currency_format($gateway->min_amount, currency: $gateway->currency) }}</td>
                                <td>{{ currency_format($gateway->max_amount, currency: $gateway->currency) }}</td>
                                <td>{{ $gateway->namespace }}</td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.payment-gateways.edit', $gateway->id) }}"><i class="fa fa-edit"></i> {{ __('Edit') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


