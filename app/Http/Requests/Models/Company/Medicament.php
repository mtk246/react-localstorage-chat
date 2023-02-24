<?php

declare(strict_types = 1);

namespace App\Http\Requests\Models\Company;

final class Medicament
{
    public function __construct(
        private array $medicament,
    ){ }

    public function getCode(): string
    {
        return '';
    }

    public function getDate(): string
    {
        return $this->medicament['date'];
    }

    public function getDrugCode(): string
    {
        return $this->medicament['drug_code'];
    }

    public function getBatch(): string
    {
        return $this->medicament['batch'];
    }

    public function getQuantity(): int
    {
        return $this->medicament['quantity'];
    }

    public function getFrequency(): int
    {
        return $this->medicament['frequency'];
    }
}
