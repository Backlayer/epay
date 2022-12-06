<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MoneyRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $options;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Money request mail from '. env("APP_NAME"))
            ->markdown('mail.money-request-mail')
            ->with('options', $this->options);
    }
}
