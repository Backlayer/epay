<?php

namespace App\Mail;

use App\Models\UserPlanSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionPurchaseMailAuthor extends Mailable
{
    use Queueable, SerializesModels;

    private UserPlanSubscriber $subscriber;
    private $isRenewal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserPlanSubscriber $subscriber, $isRenewal)
    {
        $this->subscriber = $subscriber;
        $this->isRenewal = $isRenewal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->isRenewal ? 'Auto renewal subscription renewed' : 'You have a new subscriber')
            ->markdown('mail.send-subscription-purchase-mail-author', [
                'subscriber' => $this->subscriber,
                'isRenewal' => $this->isRenewal
            ]);
    }
}
