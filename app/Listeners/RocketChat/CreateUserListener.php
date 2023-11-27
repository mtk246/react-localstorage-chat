<?php

declare(strict_types=1);

namespace App\Listeners\RocketChat;

use App\Services\RocketChatService;
use Illuminate\Support\Facades\Log;

class CreateUserListener
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
        Log::info(sprintf('Creating rocketchat user for %s', $event->user->email));

        if ($this->rocketChatService->userExist($event->user->email)) {
            Log::info(sprintf('User %s already exists in rocketchat', $event->user->email));

            return;
        }

        $request = $this->rocketChatService->createUser($event->user, $event->password)->json();

        Log::info(sprintf('User %s created in rocketchat, %s', $event->user->email, json_encode($request)));
    }
}
