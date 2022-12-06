<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\HasPayment;
use App\Http\Controllers\Controller;
use App\Mail\SendSubscriptionPurchaseMail;
use App\Mail\SendSubscriptionPurchaseMailAuthor;
use App\Models\Transaction;
use App\Models\UserPlan;
use App\Models\UserPlanSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class PlanController extends Controller
{
    use HasPayment;

    public function index(UserPlan $plan)
    {
        abort_if(!$plan->status, 404);

        return view('frontend.plans.index', compact('plan'));
    }

    public function payment(Request $request, UserPlan $plan)
    {
        abort_if(!$plan->status, 404);
        $request->validate([
            'amount' => [Rule::requiredIf(fn() => empty($plan->amount))]
        ]);

        \DB::beginTransaction();
        try {
            if ($plan->amount){
               $amount = convert_money_direct($plan->amount, $plan->currency, user_currency());
            }else{
                $amount = $request->input('amount');
            }

            //Check User wallet
            if (Auth::user()->wallet < $amount){
                return response()->json([
                    'message' => __('Insufficient Funds! Please Deposit'),
                    'url' => route('user.deposits.index')
                ], 403);
            }

            // Check Already Subscribed
            $alreadyExists = UserPlanSubscriber::whereSubscriberId(Auth::id())
                ->whereUserPlanId($plan->id)
                ->where('expire_at', '>', now())
                ->exists();
            if($alreadyExists){
                return response()->json([
                    'message' => __('You are already subscribe to this plan'),
                    'url' => route('user.transactions.index', 'subscription')
                ], 403);
            }

            // Calculate Income, taxes etc
            if ($plan->amount){
                $convertToDefaultAmount = convert_money($plan->amount, $plan->currency);
            }else{
                $convertToDefaultAmount = convert_money($request->input('amount'), user_currency());
            }
            $getTax = calculate_taxes($convertToDefaultAmount, false);
            $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'user_plan_charge');
            $totalCharge = $getTax + $getExtraCharge;

            $convertToOwnerAmount = convert_money($convertToDefaultAmount, $plan->owner->currency, true);
            $convertToOwnerCharge = convert_money($totalCharge, $plan->owner->currency, true);

            // Add Balance to author wallet
            $plan->owner->update([
                'wallet' => $plan->owner->wallet +  ($convertToOwnerAmount - $convertToOwnerCharge)
            ]);

            $convertToSubscriberAmount = convert_money($convertToDefaultAmount, user_currency(), true);
            //Deduct Balance from subscriber profile
            Auth::user()->update([
                'wallet' => Auth::user()->wallet - $convertToSubscriberAmount
            ]);

            // Generate User Subscription or Renew Plan
            $subscriber = UserPlanSubscriber::where([
                'subscriber_id' => Auth::id(),
                'user_plan_id' => $plan->id
            ])->first();

            if ($subscriber){
                $isRenewed = true;
                $subscriber->update([
                    'times' => $subscriber->times + 1,
                    'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                    'charge' => $convertToOwnerCharge,
                    'rate' => $plan->owner->currency->rate,
                    'expire_at' => now()->add($plan->interval),
                    'user_plan_id'=> $plan->id,
                    'owner_id' => $plan->owner_id,
                    'interval' => $plan->interval,
                    'subscriber_id' => Auth::id(),
                    'currency_id' => $plan->owner->currency_id,
                    'is_auto_renew' => $request->input('auto_renew')
                ]);
            }else{
                $isRenewed = false;
                $subscriber = UserPlanSubscriber::create([
                    'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                    'charge' => $convertToOwnerCharge,
                    'rate' => $plan->owner->currency->rate,
                    'interval' => $plan->interval,
                    'expire_at' => now()->add($plan->interval),
                    'user_plan_id'=> $plan->id,
                    'owner_id' => $plan->owner_id,
                    'subscriber_id' => Auth::id(),
                    'currency_id' => $plan->owner->currency_id,
                    'is_auto_renew' => $request->input('auto_renew')
                ]);
            }

            //Generate Transaction for buyers
            Transaction::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'user_id' => Auth::id(),
                'currency_id' => Auth::user()->currency_id,
                'amount' => -$convertToSubscriberAmount,
                'charge' => null,
                'rate' => user_currency()->rate,
                'reason' => __('Subscription Payment sent to :name', ['name' => $plan->owner->business_name ?? $plan->owner->name]),
                'type' => 'debit'
            ]);

            //Generate Transaction for sellers
            Transaction::create([
                'name' => $plan->owner->name,
                'email' => $plan->owner->email,
                'user_id' => $plan->owner_id,
                'currency_id' => $plan->owner->currency_id,
                'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                'charge' => $convertToOwnerCharge,
                'rate' => $plan->owner->currency->rate,
                'reason' => __('Subscription Payment received from :name', ['name' => Auth::user()->name]),
                'type' => 'credit'
            ]);

            if (config('system.queue.mail')){
                Mail::to($subscriber->subscriber)->queue(new SendSubscriptionPurchaseMail($subscriber, $isRenewed));
                Mail::to($subscriber->owner)->queue(new SendSubscriptionPurchaseMailAuthor($subscriber, $isRenewed));
            }else{
                Mail::to($subscriber->subscriber)->send(new SendSubscriptionPurchaseMail($subscriber, $isRenewed));
                Mail::to($subscriber->owner)->send(new SendSubscriptionPurchaseMailAuthor($subscriber, $isRenewed));
            }

            \DB::commit();

            return response()->json([
                'message' => __('Subscription Purchased Successfully'),
                'redirect' => route('user.transactions.index', 'plan')
            ]);
        }catch (\Throwable $e){
            \DB::rollBack();

            return response()->json([
                'message' => __('Subscription Purchased Failed: '.$e->getMessage()),
            ], 422);
        }
    }
}
