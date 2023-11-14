<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class ContractFeePatiensCast extends CastsRequest
{
    public function getId(): int
    {
        return $this->getInt('patient_id');
    }

    public function getStartDate(): ?string
    {
        return $this->get('start_date');
    }

    public function getEndDate(): ?string
    {
        return $this->get('end_date');
    }
}
