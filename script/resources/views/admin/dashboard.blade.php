@extends('layouts.backend.app')

@section('title', __('Dashboard'))

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Customers') }}</h4>
                        </div>
                        <div class="card-body" id="total_customers">
                            <img src="{{ asset('uploads/loader.gif') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Active Website/Merchant') }}</h4>
                        </div>
                        <div class="card-body" id="total_active_website">
                            <img src="{{ asset('uploads/loader.gif') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Earnings') }}</h4>
                        </div>
                        <div class="card-body" id="total_earnings">
                            <img src="{{ asset('uploads/loader.gif') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_single_charge_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Single Charge Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_single_charge_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_invoice_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Invoice Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_invoice_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_qr_payment_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Qr Payment Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_qr_payment_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_donation_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Donation Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_donation_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_website_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Website Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_website_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_transfer_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Money Transfer Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_transfer_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_money_request_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Money Request Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_money_request_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="total_payout_earnings_this_year_chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Payout Earning of :year', ['year' => date('Y')]) }}</h4>
                        </div>
                        <div class="card-body" id="total_payout_earnings_this_year">
                            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">{{ __('Earnings performance') }} <img
                                src="{{ asset('uploads/loader.gif') }}" height="20" id="earning_performance"></h4>
                        <div class="card-header-action">
                            <select class="form-control" id="performance">
                                <option value="7">{{ __('Last 7 Days') }}</option>
                                <option value="15">{{ __('Last 15 Days') }}</option>
                                <option value="30">{{ __('Last 30 Days') }}</option>
                                <option value="365">{{ __('Last 365 Days') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="145"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Site Analytics') }}</h4>
                    <div class="card-header-action">
                        <select class="form-control" id="days">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="15">{{ __('Last 15 Days') }}</option>
                            <option value="30">{{ __('Last 30 Days') }}</option>
                            <option value="180">{{ __('Last 180 Days') }}</option>
                            <option value="365">{{ __('Last 365 Days') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="google_analytics" height="120"></canvas>
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">

                            <div class="detail-value" id="total_visitors"></div>
                            <div class="detail-name">{{ __('Total Visitors') }}</div>
                        </div>
                        <div class="statistic-details-item">

                            <div class="detail-value" id="total_page_views"></div>
                            <div class="detail-name">{{ __('Total Page Views') }}</div>
                        </div>

                        <div class="statistic-details-item">

                            <div class="detail-value" id="new_vistors"></div>
                            <div class="detail-name">{{ __('New Visitor') }}</div>
                        </div>

                        <div class="statistic-details-item">

                            <div class="detail-value" id="returning_visitor"></div>
                            <div class="detail-name">{{ __('Returning Visitor') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Referral URL') }}</h4>
                        </div>
                        <div class="card-body refs" id="refs">

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Browser') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" id="browsers"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Most Visit Pages') }}</h4>
                        </div>
                        <div class="card-body tmvp" id="table-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <input type="hidden" id="site_url" value="{{ url('/') }}">
    <input type="hidden" id="dashboard_static" value="{{ url('/admin/dashboard/static') }}">
    <input type="hidden" id="dashboard_performance" value="{{ url('/admin/dashboard/performance') }}">
    <input type="hidden" id="deposit_perfomance" value="{{ url('/admin/dashboard/deposit/perfomance') }}">
    <input type="hidden" id="dashboard_order_statics" value="{{ url('/admin/dashboard/order_statics') }}">
    <input type="hidden" id="gif_url" value="{{ asset('uploads/loader.gif') }}">
    <input type="hidden" id="month" value="{{ date('F') }}">
    <input type="hidden" id="defaultCurrency" value="{{ default_currency('code') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/chatjs/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquerysparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/pages/dashboard.js') }}"></script>
@endpush
