<?php

declare(strict_types=1);

namespace App\Http\Casts\User;

use App\Http\Casts\CastsRequest;

final class RecoveryUserRequestCast extends CastsRequest
{
    public function getLastName(): string
    {
        return $this->inputs['last_name'];
    }

    public function getFirstName(): string
    {
        return $this->inputs['first_name'];
    }

    public function getBirthDate(): string
    {
        return $this->inputs['birth_date'];
    }

    public function getSsn(): ?string
    {
        return $this->get('ssn');
    }
}
