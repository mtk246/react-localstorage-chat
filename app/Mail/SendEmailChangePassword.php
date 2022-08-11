<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName, $link;

    /**
     * @param $fullName
     * @param $link
     */
    public function __construct($fullName, $link)
    {
        $this->fullName = $fullName;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.change-password')
            ->subject("Password Changed");
    }
}
