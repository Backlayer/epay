<div class="row my-4 mb-5 mt-5">
    <div class="col-lg-12">
        <div class="row justify-content-between mt-3 mb-4">
            <div class="col">
                <h3>{{ __('Qr Payments') }}</h3>
            </div>
            <div class="col-sm-4">
                <select class="form-control" id="qr-payments-perfomace">
                    <option value="7">{{ __('Last 7 Days') }}</option>
                    <option value="15">{{ __('Last 15 Days') }}</option>
                    <option value="30">{{ __('Last 30 Days') }}</option>
                    <option value="365">{{ __('Last 365 Days') }}</option>
                </select>
            </div>
        </div>
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class="chart-inner-div"></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class="chart-inner-div-2"></div>
            </div>
        </div>
        <canvas id="qrpayments" height="300" width="864" class="chartjs-render-monitor"></canvas>
    </div>
</div>

<input type="hidden" id="get-qr-payments-data" value="{{ route('user.qr-payments.chart') }}">
