<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationOrder;
use App\Models\Invoice;
use App\Models\Moneyrequest;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Qrpayment;
use App\Models\SingleChargeOrder;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Models\WebOrder;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Analytics;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function staticData()
    {
        $total_customers = User::whereRole('user')->count();
        $total_active_website = Website::whereMode(1)->count();
        $total_earnings = Transaction::whereType('credit')
            ->selectRaw('sum(charge / rate) as total')
            ->first()->total ?? 0;

        $data['total_customers'] = $total_customers;
        $data['total_active_website'] = $total_active_website;
        $data['total_earnings'] = currency_format($total_earnings, currency: default_currency());;
        $data['total_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(Transaction::class, 'type', 'credit'), currency: default_currency());
        $data['total_single_charge_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(SingleChargeOrder::class), currency: default_currency());
        $data['total_invoice_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(Invoice::class), currency: default_currency());
        $data['total_qr_payment_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(Qrpayment::class), currency: default_currency());
        $data['total_donation_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(DonationOrder::class), currency: default_currency());
        $data['total_website_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(WebOrder::class), currency: default_currency());
        $data['total_transfer_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(Transfer::class), currency: default_currency());
        $data['total_money_request_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(Moneyrequest::class), currency: default_currency());
        $data['total_payout_earnings_this_year'] = currency_format($this->getTotalEarningOfThisYear(Payout::class), currency: default_currency());

        // For chart
        $data['total_earnings_this_year_chart'] = $this->getTotalEarningChart(Transaction::class, 'type', 'credit');
        $data['total_single_charge_earnings_this_year_chart'] = $this->getTotalEarningChart(SingleChargeOrder::class);
        $data['total_invoice_earnings_this_year_chart'] = $this->getTotalEarningChart(Invoice::class);
        $data['total_qr_payment_earnings_this_year_chart'] = $this->getTotalEarningChart(Qrpayment::class);
        $data['total_donation_earnings_this_year_chart'] = $this->getTotalEarningChart(DonationOrder::class);
        $data['total_website_earnings_this_year_chart'] = $this->getTotalEarningChart(WebOrder::class);
        $data['total_transfer_earnings_this_year_chart'] = $this->getTotalEarningChart(Transfer::class);
        $data['total_money_request_earnings_this_year_chart'] = $this->getTotalEarningChart(Moneyrequest::class);
        $data['total_payout_earnings_this_year_chart'] = $this->getTotalEarningChart(Payout::class);

        return response()->json($data);

    }

    private function getTotalEarningOfThisYear($model, $column = null, $value = null)
    {
        return \Cache::remember('total_earning_of_this_year.'.$model, 150, function () use ($model, $column, $value){
            $year = Carbon::parse(date('Y'))->year;

            if (isset($model->status)){
                if (is_string($model->status)){
                    return $model::whereStatus('completed')
                        ->when($column, function (Builder $builder) use($column, $value){
                            $builder->where($column, $value);
                        })
                        ->whereYear('created_at', '=', $year)
                        ->selectRaw('sum(charge / rate) as total')
                        ->first()->total ?? 0;
                }else{
                    return $model::whereStatus(1)
                        ->when($column, function (Builder $builder) use($column, $value){
                            $builder->where($column, $value);
                        })
                        ->whereYear('created_at', '=', $year)
                        ->selectRaw('sum(charge / rate) as total')
                        ->first()->total ?? 0;
                }
            }else{
                return $model::whereYear('created_at', '=', $year)
                    ->when($column, function (Builder $builder) use($column, $value){
                        $builder->where($column, $value);
                    })
                    ->selectRaw('sum(charge / rate) as total')
                    ->first()->total ?? 0;
            }
        });
    }

    private function getTotalEarningChart($model, $column = null, $value = null)
    {
        return Cache::remember('get_total_earning_chart.'.$model, 150, function () use($model, $column, $value){
            $year = Carbon::parse(date('Y'))->year;

            if (isset($model->status)){
                if (is_string($model->status)){
                    return $model::whereStatus('completed')
                        ->whereYear('created_at', '=', $year)
                        ->when($column, function (Builder $builder) use($column, $value){
                            $builder->where($column, $value);
                        })
                        ->selectRaw('year(created_at) year, monthname(created_at) month, sum(charge / rate) as total')
                        ->orderBy('created_at')
                        ->groupBy('year', 'month')
                        ->get();
                }else{
                    return $model::whereStatus(1)
                        ->whereYear('created_at', '=', $year)
                        ->when($column, function (Builder $builder) use($column, $value){
                            $builder->where($column, $value);
                        })
                        ->selectRaw('year(created_at) year, monthname(created_at) month, sum(charge / rate) as total')
                        ->orderBy('created_at')
                        ->groupBy('year', 'month')
                        ->get();
                }
            }else{
                return $model::whereYear('created_at', '=', $year)
                    ->when($column, function (Builder $builder) use($column, $value){
                        $builder->where($column, $value);
                    })
                    ->selectRaw('year(created_at) year, monthname(created_at) month, sum(charge / rate) as total')
                    ->orderBy('created_at')
                    ->groupBy('year', 'month')
                    ->get();
            }
        });
    }

    public function performance($period)
    {
        $earnings = Transaction::whereType('credit')
            ->whereDate('created_at', '>', Carbon::now()->subDays($period))
            ->orderBy('created_at')
            ->when($period, function (Builder $builder) use($period){
                if ($period != 365){
                    $builder->selectRaw('year(created_at) year, date(created_at) date, sum(charge / rate) as total');
                }else{
                    $builder->selectRaw('year(created_at) year, monthname(created_at) month, sum(charge / rate) as total');
                }
            })
            ->groupBy('year', $period != 365 ? 'date' : 'month')
            ->get();

        return response()->json($earnings);
    }

    public function google_analytics($days)
    {
        if (file_exists('uploads/service-account-credentials.json')) {
            $data['TotalVisitorsAndPageViews'] = $this->fetchTotalVisitorsAndPageViews($days);
            $data['MostVisitedPages'] = $this->fetchMostVisitedPages($days);
            $data['Referrers'] = $this->fetchTopReferrers($days);
            $data['fetchUserTypes'] = $this->fetchUserTypes($days);
            $data['TopBrowsers'] = $this->fetchTopBrowsers($days);
        } else {
            $data['TotalVisitorsAndPageViews'] = [];
            $data['MostVisitedPages'] = [];
            $data['Referrers'] = [];
            $data['fetchUserTypes'] = [];
            $data['TopBrowsers'] = [];
        }

        return response()->json($data);
    }

    public function fetchTotalVisitorsAndPageViews($period)
    {

        return Analytics::fetchTotalVisitorsAndPageViews(Period::days($period))->map(function ($data) {
            $row['date'] = $data['date']->format('Y-m-d');
            $row['visitors'] = $data['visitors'];
            $row['pageViews'] = $data['pageViews'];
            return $row;
        });

    }

    public function fetchMostVisitedPages($period)
    {
        return Analytics::fetchMostVisitedPages(Period::days($period));

    }

    public function fetchTopReferrers($period)
    {
        return Analytics::fetchTopReferrers(Period::days($period));

    }

    public function fetchUserTypes($period)
    {
        return Analytics::fetchUserTypes(Period::days($period));

    }

    public function fetchTopBrowsers($period)
    {
        return Analytics::fetchTopBrowsers(Period::days($period));

    }

    public function pageanalytics(Request $request)
    {

        $analyticsData = Analytics::performQuery(
            Period::days(14),
            'ga:pageviews',
            [
                'metrics' => 'ga:pageviews',
                'dimensions' => 'ga:date',
                'filters' => 'ga:pagePath==/' . $request->path
            ]

        );

        return $result = collect($analyticsData['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0])->format('m-d-Y'),
                'views' => (int)$dateRow[1],
            ];
        });
    }

    public function fetchVisitorsAndPageViews($period)
    {
        return Analytics::fetchVisitorsAndPageViews(Period::days($period));
    }
}
