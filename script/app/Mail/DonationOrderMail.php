<?php

namespace App\Mail;

use App\Models\DonationOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private DonationOrder $donationOrder;
    private $userInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DonationOrder $donationOrder, $userInfo)
    {
        $this->donationOrder = $donationOrder;
        $this->userInfo = $userInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Hello '.$this->userInfo['name'].', here’s your confirmation.')
            ->markdown('mail.donation-order-mail', [
                'order' => $this->donationOrder,
                'info' => $this->userInfo
            ]);
    }
}
