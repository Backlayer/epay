<?php

namespace App\Mail;

use App\Models\UserPlanSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WalletNotificationMail extends Mailable
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
            ->subject('Insufficient Balance, Please deposit')
            ->markdown('mail.wallet-notification-mail', [
                'subscription' => $this->subscription
            ]);
    }
}
