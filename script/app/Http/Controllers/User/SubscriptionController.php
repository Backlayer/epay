<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserPlanSubscriber;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function show(UserPlanSubscriber $subscription)
    {
        return view('user.subscriptions.show', compact('subscription'));
    }

    public function autoRenew(UserPlanSubscriber $subscription)
    {
        abort_if($subscription->subscriber_id !== auth()->id(), 404);

        $subscription->update([
            'is_auto_renew' => !$subscription->is_auto_renew
        ]);

        return response()->json([
            'message' => __("Auto renew :status", ['status' => $subscription->is_auto_renew ? __('Enabled') : __("Disabled")]),
            'redirect' => route('user.subscription.show', $subscription->id)
        ]);
    }
}
