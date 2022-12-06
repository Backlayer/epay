<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPromotionalMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sub;
    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub, $message)
    {
        $this->sub = $sub;
        $this->message = $message;
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
            ->markdown('mail.send-promotional-mail',[
                'message' => $this->message
            ]);
    }
}
