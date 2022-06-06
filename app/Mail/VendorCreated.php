<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $messages;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages)
    {
        return $this->messages=$messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome Vendor you are added from admin')->view('Mail.emails');
    }
}
