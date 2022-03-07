<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenerateNewPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName;
    public $email;
    public $usercode;
    public $link;

    /**
     * @param $fullName
     * @param $email
     * @param $link
     */
    public function __construct($fullName, $email, $usercode, $link)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->usercode = $usercode;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.genera-new-pass');
    }
}
