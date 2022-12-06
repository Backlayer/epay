<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MoneyTransferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function build()
    {
        return $this
                ->subject('Recieved money from '.env('APP_NAME'))
                ->markdown('mail.transfer-money')
                ->with('options', $this->options);
    }
}
