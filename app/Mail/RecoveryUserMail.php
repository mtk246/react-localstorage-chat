<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName;
    public $email;
    public $link;

    public function __construct($fullName,$email,$link)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.recovery-user')
            ->subject("Recover User");
    }
}
