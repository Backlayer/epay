<div class="my-4 mb-5 mt-5">
    <div class="row justify-content-between mt-3 mb-4">
        <div class="col">
            <h3>{{ __('Credit/Debit') }}</h3>
        </div>
        <div class="col-sm-4">
            <select class="form-control" id="credit-debit-perfomace">
                @foreach (range(2023, date('Y')) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
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

    <canvas id="creditDebitChart" height="300" width="864" class="chartjs-render-monitor"></canvas>
</div>

<input type="hidden" id="get-dashboard-data" value="{{ route('user.dashboard.chart') }}">
