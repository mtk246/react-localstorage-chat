<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailRecoveryPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $completeName, $url;

    /**
     * @param $completeName
     * @param $url
     */
    public function __construct($completeName,$url)
    {
        $this->completeName = $completeName;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name')
            ->subject("Recovery Password");
    }
}
