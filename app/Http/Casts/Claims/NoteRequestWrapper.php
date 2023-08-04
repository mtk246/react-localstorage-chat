<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class NoteRequestWrapper extends CastsRequest
{
    public function getPrivateNote(): string
    {
        return $this->get('private_note');
    }
}
