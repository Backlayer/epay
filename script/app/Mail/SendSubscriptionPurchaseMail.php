<?php

namespace App\Mail;

use App\Models\UserPlanSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionPurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    private UserPlanSubscriber $subscriber;
    private $isRenewed;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserPlanSubscriber $subscriber, $isRenewed)
    {
        $this->subscriber = $subscriber;
        $this->isRenewed = $isRenewed;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->isRenewed ? 'Your renewal subscription confirmation' : 'Your subscription confirmation')
            ->markdown('mail.send-subscription-purchase-mail', [
                'subscriber' => $this->subscriber,
                'isRenewed' => $this->isRenewed
            ]);
    }
}
