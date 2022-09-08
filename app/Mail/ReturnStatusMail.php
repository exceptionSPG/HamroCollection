<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *return_status_mail
     * @return $this
     */
    public function build()
    {
        $order = $this->data;
        if ($order['invoice']['return_order'] == 2) {
            $status = 'Approved';
        } elseif ($order['invoice']['return_order'] == 3) {
            $status = 'Rejected';
        }

        return $this->from('support@hamrocollection.com')->view('mail.return_status_mail', compact('order'))->subject('Your Order Return Request for the order: ' . $order['invoice']['invoice_number'] . ' is ' . $status);
    }
}
