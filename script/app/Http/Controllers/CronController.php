<?php

namespace App\Http\Controllers;

use App\Mail\PreAutoRenewNotification;
use App\Mail\SendSubscriptionPurchaseMail;
use App\Mail\SendSubscriptionPurchaseMailAuthor;
use App\Mail\SystemErrorMail;
use App\Mail\WalletNotificationMail;
use App\Models\Transaction;
use App\Models\UserPlanSubscriber;
use Illuminate\Support\Facades\Auth;
use Mail;
use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transfer;
use App\Models\WebOrder;
use App\Models\TemporaryFile;

class CronController extends Controller
{
    public function deleteTemporaryFiles()
    {
        $temporaryFiles = TemporaryFile::where('created_at', '<', today()->subDay())->get();

        foreach ($temporaryFiles as $temporaryFile) {
            $path = 'temp/' . $temporaryFile->folder;
            if (\Storage::disk(config('filesystems.default'))->exists($path)){
                \Storage::disk(config('filesystems.default'))->deleteDirectory($path);
            }

            $temporaryFile->delete();
        }
    }

    public function deleteUnpaidExternalOrders()
    {
        WebOrder::where('created_at', '<', today()->subDay(3))->where('gateway_id',null)->delete();
    }

    public function moneyRefund()
    {
        // Get pending transfer
        $transfers = Transfer::whereStatus(1)->where('created_at', '<', Carbon::now()->subDays(3));
        \DB::beginTransaction();
        try {
            foreach ($transfers->get() as $transfer) {
                $user = User::findOrFail($transfer->user_id);
                $user->update([
                    "wallet" => $user->wallet + $transfer->amount +  $transfer->charge
                ]);
            }
            $transfers->update([
                "status" => 3
            ]);

            \DB::commit();

            return;
        } catch (Throwable $th) {
            \DB::rollback();
            return;
        }
    }

    public function preRenewalNotification()
    {
        $subscriptions = UserPlanSubscriber::with('subscriber.currency', 'currency')
            ->whereIsAutoRenew(true)
            ->whereDate('expire_at', '=', today()->add('3 Days'))
            ->get();

        foreach ($subscriptions as $subscription){
            $defaultPlanAmount = convert_money($subscription->amount + $subscription->charge, $subscription->currency);
            $defaultSubscriberWallet = convert_money($subscription->subscriber->wallet, $subscription->subscriber->currency);

            if ($defaultSubscriberWallet < $defaultPlanAmount){
                if (config('system.queue.mail')){
                    Mail::to($subscription->subscriber)->queue(new WalletNotificationMail($subscription));
                }else{
                    Mail::to($subscription->subscriber)->send(new WalletNotificationMail($subscription));
                }
            }else{
                if (config('system.queue.mail')){
                    Mail::to($subscription->subscriber)->queue(new PreAutoRenewNotification($subscription));
                }else{
                    Mail::to($subscription->subscriber)->send(new PreAutoRenewNotification($subscription));
                }
            }
        }
    }

    public function autoRenew()
    {
        \DB::beginTransaction();
        try {
            $subscriptions = UserPlanSubscriber::with('subscriber.currency', 'currency')
                ->whereIsAutoRenew(true)
                ->whereDate('expire_at', today())
                ->get();


            foreach ($subscriptions as $subscription){
                $defaultPlanAmount = convert_money($subscription->amount + $subscription->charge, $subscription->currency);
                $defaultSubscriberWallet = convert_money($subscription->subscriber->wallet, $subscription->subscriber->currency);

                if ($defaultSubscriberWallet < $defaultPlanAmount){
                    if (config('system.queue.mail')){
                        Mail::to($subscription->subscriber)->queue(new WalletNotificationMail($subscription));
                    }else{
                        Mail::to($subscription->subscriber)->send(new WalletNotificationMail($subscription));
                    }
                }else{
                    $subscription->update([
                        'times' => $subscription->times + 1,
                        'expire_at' => now()->add($subscription->interval),
                    ]);

                    $convertToDefaultAmount = convert_money($subscription->amount + $subscription->charge, $subscription->currency);

                    $getTax = calculate_taxes($convertToDefaultAmount, false);
                    $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'user_plan_charge');
                    $totalCharge = $getTax + $getExtraCharge;

                    $convertToOwnerAmount = convert_money($convertToDefaultAmount, $subscription->plan->owner->currency, true);
                    $convertToOwnerCharge = convert_money($totalCharge, $subscription->plan->owner->currency, true);

                    // Add Balance to author wallet
                    $subscription->plan->owner->update([
                        'wallet' => $subscription->plan->owner->wallet +  ($convertToOwnerAmount - $convertToOwnerCharge)
                    ]);

                    $convertToSubscriberAmount = convert_money($convertToDefaultAmount, user_currency(), true);
                    //Deduct Balance from subscriber profile
                    Auth::user()->update([
                        'wallet' => Auth::user()->wallet - $convertToSubscriberAmount
                    ]);

                    //Generate Transaction for buyers
                    Transaction::create([
                        'name' => $subscription->subscriber->name,
                        'email' => $subscription->subscriber->email,
                        'user_id' => $subscription->subscriber_id,
                        'currency_id' => $subscription->subscriber->currency_id,
                        'amount' => -$convertToSubscriberAmount,
                        'charge' => null,
                        'rate' => user_currency()->rate,
                        'reason' => __('Subscription Payment sent to :name', ['name' => $subscription->plan->owner->business_name ?? $subscription->plan->owner->name]),
                        'type' => 'debit'
                    ]);

                    //Generate Transaction for sellers
                    Transaction::create([
                        'name' => $subscription->plan->owner->name,
                        'email' => $subscription->plan->owner->email,
                        'user_id' => $subscription->plan->owner_id,
                        'currency_id' => $subscription->plan->owner->currency_id,
                        'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                        'charge' => $convertToOwnerCharge,
                        'rate' => $subscription->plan->owner->currency->rate,
                        'reason' => __('Subscription Payment received from :name', ['name' => Auth::user()->name]),
                        'type' => 'credit'
                    ]);

                    if (config('system.queue.mail')){
                        \Illuminate\Support\Facades\Mail::to($subscription->subscriber)->queue(new SendSubscriptionPurchaseMail($subscription, true));
                        Mail::to($subscription->owner)->queue(new SendSubscriptionPurchaseMailAuthor($subscription, true));
                    }else{
                        Mail::to($subscription->subscriber)->send(new SendSubscriptionPurchaseMail($subscription, true));
                        Mail::to($subscription->owner)->send(new SendSubscriptionPurchaseMailAuthor($subscription, true));
                    }
                }
            }

            \DB::commit();
        }catch (Throwable $exception){
            \DB::commit();

            if (env('MAIL_TO', false)){
                if(config('system.queue.mail')){
                    Mail::to(env('MAIL_TO'))->queue(new SystemErrorMail($exception->getMessage()));
                }else{
                    Mail::to(env('MAIL_TO'))->send(new SystemErrorMail($exception->getMessage()));
                }
            }
        }
    }
}
