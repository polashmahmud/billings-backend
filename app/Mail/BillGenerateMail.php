<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillGenerateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bill, $customer)
    {
        $this->bill = $bill;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bill');
    }
}
