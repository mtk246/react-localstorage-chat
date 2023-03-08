<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\http\Casts\CastsRequest;
use App\Models\Medication as MedicationModel;

final class MedicationRequestCast extends CastsRequest
{
    public function getCode(): string
    {
        return generateNewCode(prefix: 'test', code_length: 5, model: MedicationModel::class);
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
