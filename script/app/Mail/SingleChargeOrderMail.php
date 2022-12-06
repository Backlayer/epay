<?php

namespace App\Mail;

use App\Models\SingleChargeOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SingleChargeOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private SingleChargeOrder $order;
    private array $userInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SingleChargeOrder $order, array $userInfo)
    {
        $this->order = $order;
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
            ->markdown('mail.single-charge-order-mail', [
                'order' => $this->order,
                'info' => $this->userInfo
            ]);
    }
}
