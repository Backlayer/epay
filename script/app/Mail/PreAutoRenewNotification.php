<?php

namespace App\Mail;

use App\Models\UserPlanSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreAutoRenewNotification extends Mailable
{
    use Queueable, SerializesModels;

    private UserPlanSubscriber $subscription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserPlanSubscriber $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Your subscription will expire soon!')
            ->markdown('mail.pre-auto-renew-notification', [
                'subscription' => $this->subscription
            ]);
    }
}
