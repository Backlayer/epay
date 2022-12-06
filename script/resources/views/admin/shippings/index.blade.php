@extends('layouts.backend.app')

@section('title', __('Shipping rate list'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-flush" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('S / N') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Region') }}</th>
                                <th>{{ __('Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippings as $shipping)
                            <tr>
                                <td>{{ $loop->index+1 }}</th>
                                <td>{{ $shipping->user->name }}</th>
                                <td>{{ $shipping->region }}</th>
                                <td>{{ $shipping->amount }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $shippings->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('user/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('script')
    <!-- Optional JS -->
    <script src="{{ asset('user/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('user/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        "use strict";
        $('#table').DataTable( {
            paging: false,
            info: false
        });
    </script>
@endpush

