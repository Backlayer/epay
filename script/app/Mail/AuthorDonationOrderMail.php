<?php

namespace App\Mail;

use App\Models\DonationOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorDonationOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private DonationOrder $donationOrder;
    private array $userInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DonationOrder $donationOrder, array $userInfo)
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
            ->subject(__(':name sent you a donation', ['name' => $this->userInfo['name']]))
            ->markdown('mail.author-donation-order-mail', [
                'order' => $this->donationOrder,
                'info' => $this->userInfo
            ]);
    }
}
