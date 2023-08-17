<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryUserMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $fullName;
    public $email;
    public $link;

    public function __construct($fullName, $email, $link)
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
            ->subject('Recover User');
    }
}
