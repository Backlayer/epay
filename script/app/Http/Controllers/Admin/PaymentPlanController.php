<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserPlan;
use App\Models\UserPlanSubscriber;
use Illuminate\Http\Request;

class PaymentPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payment-plans-read')->only('index');
    }

    public function index()
    {
        $plans = UserPlan::with('owner')
                ->when(request()->search, function($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('interval', 'like', '%' . request('search') . '%')
                    ->orWhere('amount', 'like', '%' . request('search') . '%');
                })
                ->latest()
                ->paginate();

        return view('admin.paymentPlans.index', compact('plans'));
    }

    public function show($id)
    {
        $plan = UserPlan::with('owner')->findOrFail($id);
        $subscribers = UserPlanSubscriber::where('user_plan_id', $plan->id)->with('currency', 'subscriber')->get();
        return view('admin.paymentPlans.show', compact('plan', 'subscribers'));
    }
}
