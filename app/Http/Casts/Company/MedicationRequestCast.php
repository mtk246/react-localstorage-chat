<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class MedicationRequestCast extends CastsRequest
{
    public function getId(): int
    {
        return (int) $this->inputs['id'];
    }

    public function getDate(): string
    {
        return $this->inputs['date'];
    }

    public function getDrugCode(): string
    {
        return $this->inputs['drug_code'];
    }

    public function getBatch(): string
    {
        return $this->inputs['batch'];
    }

    public function getQuantity(): int
    {
        return (int) $this->inputs['quantity'];
    }

    public function getFrequency(): int
    {
        return (int) $this->inputs['frequency'];
    }
}
