<?php

namespace App\Mail;

use App\Models\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    private ContactMail $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactMail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('You have a new contact mail'))
            ->markdown('mail.send-contact-mail-to-admin')
            ->with('mail', $this->mail);
    }
}
