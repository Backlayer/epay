<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Donation;
use App\Models\UserPlan;
use App\Models\Qrpayment;
use App\Models\Transaction;
use App\Models\SingleCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::whereUserId(auth()->id())->where('amount', '>', 0)->latest()->paginate();
        $payouts = Payout::whereUserId(auth()->id())->whereStatus('completed')->sum('amount');
        return view('user.dashboard.index', compact('transactions', 'payouts'));
    }

    function transactions(Request $request)
    {
        $months = Transaction::whereUserId(auth()->id())
            ->whereYear('created_at', $request->year ?? date("Y"))
            ->selectRaw('month(created_at) month')
            ->groupBy('month')
            ->get()
            ->map(function ($q) {
                $data['month'] = Carbon::createFromFormat('m', $q->month)->format('F');
                return $data;
            });

        $credit = Transaction::whereUserId(auth()->id())->where('amount', '>', 0)
            ->whereYear('created_at', $request->year ?? date("Y"))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) {
                $data['month'] = Carbon::createFromFormat('m', $q->month)->format('F');
                $data['amount'] = number_format(max($q->amount, 0), 2);
                return $data;
            });

        $debit = Transaction::whereUserId(auth()->id())->where('amount', '<', 0)
            ->whereYear('created_at', $request->year ?? date("Y"))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) {
                $data['month'] = Carbon::createFromFormat('m', $q->month)->format('F');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json([
            'credit' => $credit,
            'months' => $months,
            'debit' => $debit,
        ]);
    }

    public function orderChart(Request $request)
    {
        $orders = Order::whereSellerId(auth()->id())
            ->whereYear('created_at', '>=', Carbon::now()->subDays($request->day ?? 7))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) use ($request) {
                $data['month'] = $request->day == 365 ? Carbon::createFromFormat('m', $q->month)->format('F') : Carbon::createFromFormat('m', $q->month)->format('d-m-Y');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function singleCharge(Request $request)
    {
        $singleCharge = SingleCharge::whereUserId(auth()->id())
            ->whereYear('created_at', '>=', Carbon::now()->subDays($request->day ?? 7))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) use ($request) {
                $data['month'] = $request->day == 365 ? Carbon::createFromFormat('m', $q->month)->format('F') : Carbon::createFromFormat('m', $q->month)->format('d-m-Y');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json([
            'singlecharge' => $singleCharge,
        ]);
    }

    public function donations(Request $request)
    {
        $donations = Donation::whereUserId(auth()->id())
            ->whereYear('created_at', '>=', Carbon::now()->subDays($request->day ?? 7))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) use ($request) {
                $data['month'] = $request->day == 365 ? Carbon::createFromFormat('m', $q->month)->format('F') : Carbon::createFromFormat('m', $q->month)->format('d-m-Y');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json([
            'donations' => $donations,
        ]);
    }

    public function plans(Request $request)
    {
        $plans = UserPlan::whereOwnerId(auth()->id())
            ->whereYear('created_at', '>=', Carbon::now()->subDays($request->day ?? 7))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) use ($request) {
                $data['month'] = $request->day == 365 ? Carbon::createFromFormat('m', $q->month)->format('F') : Carbon::createFromFormat('m', $q->month)->format('d-m-Y');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json([
            'plans' => $plans,
        ]);
    }

    public function qrPayments(Request $request)
    {
        $qrpayments = Qrpayment::whereSellerId(auth()->id())
            ->whereYear('created_at', '>=', Carbon::now()->subDays($request->day ?? 7))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) use ($request) {
                $data['month'] = $request->day == 365 ? Carbon::createFromFormat('m', $q->month)->format('F') : Carbon::createFromFormat('m', $q->month)->format('d-m-Y');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json([
            'qrpayments' => $qrpayments,
        ]);
    }
}
