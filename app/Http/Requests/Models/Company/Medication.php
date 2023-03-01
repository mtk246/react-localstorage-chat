<?php

declare(strict_types=1);

namespace App\Http\Requests\Models\Company;

use App\Models\Medication as MedicationModel;

final class Medication
{
    /** @param array<key, string|int|null> $medication*/
    public function __construct(private array $medication)
    {
    }

    public function getCode(): string
    {
        return generateNewCode(prefix: 'test', code_length: 5, model: MedicationModel::class);
    }

    public function getDate(): string
    {
        return $this->medication['date'];
    }

    public function getDrugCode(): string
    {
        return $this->medication['drug_code'];
    }

    public function getBatch(): string
    {
        return $this->medication['batch'];
    }

    public function getQuantity(): int
    {
        return (int) $this->medication['quantity'];
    }

    public function getFrequency(): int
    {
        return (int) $this->medication['frequency'];
    }
}
