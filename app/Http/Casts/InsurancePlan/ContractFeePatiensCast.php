<?php

declare(strict_types=1);

namespace App\Http\Casts\InsurancePlan;

use App\Http\Casts\CastsRequest;

final class ContractFeePatiensCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('patient_id');
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
