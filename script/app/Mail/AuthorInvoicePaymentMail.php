<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorInvoicePaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    private Invoice $invoice;
    private array $userInfo;
    private $subTotal, $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, array $userInfo)
    {
        $this->invoice = $invoice;
        $this->userInfo = $userInfo;

        $subTotal = $invoice->amount * $invoice->quantity;
        $discount = ($subTotal * $invoice->discount) / 100;
        $tax = (($subTotal - $discount) * $invoice->tax) / 100;
        $total = ($subTotal - $discount) + $tax;

        $this->subTotal = convert_money_direct($subTotal, $invoice->currency, user_currency(), true);
        $this->total = convert_money_direct($total, $invoice->currency, user_currency(), true);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->userInfo['name'].' sent you a payment')
            ->markdown('mail.author-invoice-payment-mail', [
                'invoice' => $this->invoice,
                'userInfo' => $this->userInfo,
                'subTotal' => $this->subTotal,
                'total' => $this->total
            ]);
    }
}
