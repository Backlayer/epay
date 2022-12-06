<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserPlan;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanController extends Controller
{
    public function index()
    {
        $plans = UserPlan::whereOwnerId(Auth::id())
            ->withCount('active', 'expired')
            ->latest()
            ->paginate();

        return view('user.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('user.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'interval' => [
                'required', 'string',
                Rule::in(['1 Hour', '1 Day', '1 Week', '1 Month', '4 Months', '6 Months', '1 Year'])
            ],
            'limit' => ['nullable', 'integer'],
            'features' => ['required', 'array', 'min:1'],
            'features.*.title' => ['required','string', 'max:100']
        ], [
            'features.*.title.max' => __('validation.max.string', ['attribute' => __("feature title")]),
            'features.*.title.required' => __('validation.required', ['attribute' => __("feature title")]),
            'features.*.title.string' => __('validation.string', ['attribute' => __("feature title")])
        ]);

        UserPlan::create([
                'owner_id' => Auth::id(),
                'currency_id' => user_currency()->id,
                'features' => $request->input('features')
            ] + $validated);

        return response()->json([
            'message' => __('Plan Created Successfully'),
            'redirect' => route('user.plans.index')
        ]);
    }

    public function show(UserPlan $plan)
    {
        abort_if(Auth::id() !== $plan->owner_id, 404);
        $subscribers = $plan->subscribers()->latest()->paginate();

        return view('user.plans.show', compact('subscribers', 'plan'));
    }

    public function edit(UserPlan $plan)
    {
        abort_if(Auth::id() !== $plan->owner_id, 404);
        return view('user.plans.edit', compact('plan'));
    }

    public function update(Request $request, UserPlan $plan)
    {
        abort_if(Auth::id() !== $plan->owner_id, 404);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'interval' => [
                'required', 'string',
                Rule::in(['1 Hour', '1 Day', '1 Week', '1 Month', '4 Months', '6 Months', '1 Year'])
            ],
            'limit' => ['nullable', 'integer'],
            'features' => ['required', 'array', 'min:1'],
            'features.*.title' => ['required','string', 'max:100']
        ], [
        'features.*.title.max' => __('validation.max.string', ['attribute' => __("feature title")]),
        'features.*.title.required' => __('validation.required', ['attribute' => __("feature title")]),
        'features.*.title.string' => __('validation.string', ['attribute' => __("feature title")])
    ]);

        $plan->update($validated);

        return response()->json([
            'message' => __('Plan Updated Successfully'),
            'redirect' => route('user.plans.index')
        ]);
    }

    public function destroy(UserPlan $plan)
    {
        abort_if(Auth::id() !== $plan->owner_id, 404);

        if ($plan->subscribers()->count() > 0){
            return response()->json([
                'message' => __("You are not allowed to delete. Because it has :number orders", ['number' => $plan->subscribers()->count()]),
                'redirect' => route('user.plans.index')
            ], 403);
        }

        $plan->delete();

        return response()->json([
            'message' => __("Plan Deleted Successfully"),
            'redirect' => route('user.plans.index')
        ]);
    }

    public function disable(UserPlan $plan)
    {
        abort_if(Auth::id() !== $plan->owner_id, 404);

        $plan->update([
            'status' => !$plan->status
        ]);

        $message = $plan->status ?
            __('Subscription Plan Has Been Activated') :
            __('Subscription Plan Has Been Disabled');

        return response()->json([
            'message' => $message,
            'redirect' => route('user.single-charges.index')
        ]);
    }
}
