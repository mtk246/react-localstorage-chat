<?php

declare(strict_types=1);

namespace App\Listeners\RocketChat;

use App\Services\RocketChatService;
use Illuminate\Support\Facades\Log;

class UpdateUserPasswordListener
{
    public function __construct(private readonly RocketChatService $rocketChatService)
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        Log::info(sprintf('Update User Password for user %s', $event->user->email));

        if (!$this->rocketChatService->userExist($event->user->email)) {
            Log::info(sprintf('User %s dont have a roket chat user', $event->user->email));

            return;
        }

        $this->rocketChatService->updateUser([
            'userId' => $this->rocketChatService->getUserList(['emails.address' => $event->user->email])[0]['_id'],
            'data.password' => $event->password,
        ]);
    }
}
