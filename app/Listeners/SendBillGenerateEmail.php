<?php

namespace App\Listeners;

use App\Events\BillGenerate;
use App\Mail\BillGenerateMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBillGenerateEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BillGenerate  $event
     * @return void
     */
    public function handle(BillGenerate $event)
    {
        Mail::to($event->customer->email)
            ->send(new BillGenerateMail($event->customer, $event->bill));
    }
}
