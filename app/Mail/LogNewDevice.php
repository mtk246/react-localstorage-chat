<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogNewDevice extends Mailable
{
    use Queueable, SerializesModels;

    public $ip;
    public $code;
    public $os;

    public function __construct($ip,$code,$os)
    {
        $this->ip = $ip;
        $this->code = $code;
        $this->os = $os;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.log-new-device')->subject("Login with new Device");
    }
}
