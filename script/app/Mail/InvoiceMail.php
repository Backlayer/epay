<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    private Invoice $invoice;
    private $subTotal, $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $invoice->loadSum('items', 'subtotal');

        $subTotal = $invoice->items_sum_subtotal;
        $discount = ($subTotal * $invoice->discount) / 100;
        $tax = (($subTotal - $discount) * $invoice->tax) / 100;
        $total = ($subTotal - $discount) + $tax;

        $this->subTotal = currency_format($subTotal, currency: $invoice->currency);
        $this->total = currency_format($total, currency: $invoice->currency);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('You have a new invoice')
            ->markdown('mail.invoice-mail', [
                'invoice' => $this->invoice,
                'subTotal' => $this->subTotal,
                'total' => $this->total,
            ]);
    }
}
