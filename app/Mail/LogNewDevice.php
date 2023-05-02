<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogNewDevice extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $fullName;
    public $ip;
    public $code;
    public $os;

    public function __construct($fullName, $ip, $code, $os)
    {
        $this->fullName = $fullName;
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
        return $this->view('emails.log-new-device')->subject('Login with new Device');
    }
}
