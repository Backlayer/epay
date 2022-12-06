<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    private $options;
    private $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($options, $template)
    {
        $this->options = $options;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('New purchase from '. env('APP_NAME'))
            ->markdown($this->template)
            ->with('options', $this->options);
    }
}
