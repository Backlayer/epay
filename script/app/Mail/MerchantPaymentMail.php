<?php

namespace App\Mail;

use App\Models\WebOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchantPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    private WebOrder $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(WebOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('You are received a payment')
            ->markdown('mail.merchant-payment-mail', [
                'order' => $this->order
            ]);
    }
}
