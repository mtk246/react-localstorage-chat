<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class ChangePasswordNotification extends Notification
{
    use Queueable;

    public function __construct(private string $url, private string $fullName)
    {
    }

    /** @return string[] */
    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->view('emails.rescue_password', [
                'url' => $this->url,
                'completeName' => $this->fullName,
            ])
            ->subject('Recovery Password');
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'completeName' => $this->fullName,
        ];
    }
}
