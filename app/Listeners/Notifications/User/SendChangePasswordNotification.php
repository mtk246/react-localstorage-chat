<?php

declare(strict_types=1);

namespace App\Listeners\Notifications\User;

use App\Events\User\ChangePassword;
use App\Notifications\User\ChangePasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChangePasswordNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /** @param ChangePassword $event */
    public function handle($event): void
    {
        $user = $event->user;

        $token = encrypt($user->id.'@#@#$'.$user->email);

        $user->token = $token;
        $user->save();

        $url = env('URL_FRONT').'/#/newCredentials?mcctoken='.$token;
        $fullName = $user->profile->first_name.' '.$user->profile->last_name;

        \Notification::send($user, new ChangePasswordNotification($url, $fullName));
    }
}
