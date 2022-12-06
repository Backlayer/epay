<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    private $message;
    private $sub;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub, $message)
    {
        $this->message = $message;
        $this->sub = $sub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->sub)
            ->markdown('mail.send-email-to-customer', [
                'message' => $this->message
            ]);
    }
}
