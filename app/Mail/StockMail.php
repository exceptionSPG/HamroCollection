<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockMail extends Mailable
{
    use Queueable, SerializesModels;
    public $allData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($allData)
    {
        //
        $this->allData = $allData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->allData;
        return $this->from('stock@hamrocollection.com')->view('mail.stock_mail', compact('data'))->subject('Emergency: Stock going below Threshold.');
    }
}
