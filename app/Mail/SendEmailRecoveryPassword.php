<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailRecoveryPassword extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $completeName;
    public $url;

    public function __construct($completeName, $url)
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
        return $this->view('emails.rescue_password')
            ->subject('Recovery Password');
    }
}
