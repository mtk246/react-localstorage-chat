<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailChangePassword extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $fullName;
    public $link;

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
            ->subject('Password Changed');
    }
}
