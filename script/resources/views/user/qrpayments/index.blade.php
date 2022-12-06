@extends('layouts.user.master')

@section('title', __('Qr Payment'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Qr Payment List') }}</li>
@endsection

@section('actions')
    <a href="#" data-toggle="modal" data-target="#qr-code" class="btn btn-sm btn-neutral"><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download QR') }}</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total payments') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 amount">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total payments amount') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card search-table">
        <div class="card-header pb-0">
            <h4>{{ __("Transactions") }}</h4>
            <form class="card-header-form">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Search...") }}">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('S/N') }}</th>
                            <th>{{ __('Invoice no') }}</th>
                            <th>{{ __('TRX') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('From') }}</th>
                            <th>{{ __("Comment") }}</th>
                            <th>{{ __('Created') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($qrPayments as $order)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $order->invoice_no }}</td>
                            <td>{{ $order->trx }}</td>
                            <td>{{ currency_format($order->amount, currency: user_currency()) }}</td>
                            <td>
                                {{ $order->name }}<br>
                                {{ $order->email }}
                            </td>
                            <td>{{ $order->comment }}</td>
                            <td>{{ formatted_date($order->created_at) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-body pb-0">
                    {{ $qrPayments->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
    @push('modal')
    <div class="modal fade" id="qr-code" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <h3 class="mb-0 font-weight-bolder">{{ __('Add category') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            <div id="qrcode" class="mx-auto mb-3">

                    </div>

                    <a href="" id="download-qr" class="custom-btn d-block btn-block mt-3 py-2 download-qr" download="{{ auth()->user()->name . '.png' }}">
                        <i class="fas fa-download"></i> {{ __('Download') }}
                    </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpush
    <input type="hidden" id="get-products-url" value="{{ route('user.get-payments') }}">
    <input type="hidden" id="qrUrl" value="{{ route('frontend.qr.index', auth()->user()->qr) }}">
    <input type="hidden" id="username" value="{{ auth()->user()->name }}">
@endsection

@push('script')
    <script src="{{ asset('plugins/qr2js/qrjs2.min.js') }}"></script>
    <script src="{{ asset('user/js/card-data.js') }}"></script>
    <script>
        getTotalProducts();

       
    </script>
@endpush
