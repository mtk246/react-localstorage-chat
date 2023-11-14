<?php

declare(strict_types=1);

namespace App\Http\Casts\RoketChat;

use App\Http\Casts\CastsRequest;

final class UserWrapper extends CastsRequest
{
    public function getId(): string
    {
        return (string) $this->get('userId');
    }

    public function getAuthToken(): string
    {
        return (string) $this->get('authToken');
    }

    public function getRoles(): array
    {
        return $this->getArray('me.roles');
    }
}
