@extends('layouts.user.master')

@section('title', __('Subscribers'))

@section('content')
    <div class="card mt-4 subscriber-table">
        <div class="table-responsive py-3 ">
            <table class="table table-flush" id="table">
                <thead class="thead-light">
                    <tr>
                        <th>{{ __('S / N') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Charge') }}</th>
                        <th>{{ __('Plan') }}</th>
                        <th>{{ __('Reference ID') }}</th>
                        <th>{{ __('Expiring Date') }}</th>
                        <th>{{ __('Renewal') }}</th>
                        <th>{{ __('Created') }}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('user/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('user/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('user/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
@endpush
