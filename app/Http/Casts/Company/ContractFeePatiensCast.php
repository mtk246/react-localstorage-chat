<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class ContractFeePatiensCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id');
    }

    public function getStartDate(): ?string
    {
        return array_key_exists('start_date', $this->inputs)
            ? $this->inputs['start_date']
            : null;
    }

    public function getEndDate(): ?string
    {
        return array_key_exists('end_date', $this->inputs)
            ? $this->inputs['end_date']
            : null;
    }
}
