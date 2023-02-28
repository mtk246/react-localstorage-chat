<?php

declare(strict_types=1);

namespace App\Http\Requests\Models\Company;

final class Medication
{
    /** @param array<key, string|int|null> $medication*/
    public function __construct(private array $medication)
    {
    }

    public function getCode(): string
    {
        return '';
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
        return $this->medication['quantity'];
    }

    public function getFrequency(): int
    {
        return $this->medication['frequency'];
    }
}
