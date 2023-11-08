<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class ChangeStatusRequestWrapper extends CastsRequest
{
    public function getStatus(): int
    {
        return $this->getInt('status_id');
    }

    public function getSubStatus(): ?int
    {
        return $this->get('sub_status_id');
    }

    public function getPrivateNote(): ?string
    {
        return $this->get('private_note');
    }
}
