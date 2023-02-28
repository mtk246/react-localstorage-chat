<?php

declare(strict_types=1);

namespace App\Http\Requests\Models\Company;

use App\Models\MacLocality;
use Illuminate\Support\Collection;

final class Service
{
    /** @param array<key, string|int|array|null> $service */
    public function __construct(private array $service)
    {
    }

    public function getBillingCompanyId(): ?int
    {
        return $this->service['billing_company_id'] ?? null;
    }

    public function getProcedureId(): int
    {
        return $this->service['procedure_id'];
    }

    public function getModifierId(): int
    {
        return $this->service['modifier_id'];
    }

    public function getPrice(): float
    {
        return (float) $this->service['price'];
    }

    public function getMac(): ?string
    {
        return $this->service['mac'];
    }

    public function getLocalityNumber(): ?string
    {
        return $this->service['locality_number'];
    }

    public function getState(): ?string
    {
        return $this->service['state'];
    }

    public function getFsa(): ?string
    {
        return $this->service['fsa'];
    }

    public function getCounties(): ?string
    {
        return $this->service['counties'];
    }

    public function getInsuranceLabelFeeId(): int
    {
        return $this->service['insurance_label_fee_id'];
    }

    public function getPricePercentage(): int
    {
        return (int) $this->service['price_percentage'];
    }

    public function getClia(): string
    {
        return $this->service['clia'];
    }

    /**
     * @return \Illuminate\Support\Collection<TKey, TValue>
     *
     * @template TKey of array-key
     * @template TValue of \App\Http\Requests\Models\Medicament
     */
    public function getMedications(): Collection
    {
        return collect($this->service['medications'])
            ->map(fn (array $item) => new Medication($item));
    }

    public function getMacLocality(): ?MacLocality
    {
        $query = MacLocality::query();

        if ($this->getMac()) {
            $query = $query->where('mac', $this->getMac());
        }

        if ($this->getLocalityNumber()) {
            $query = $query->where('locality_number', $this->getLocalityNumber());
        }

        if ($this->getState()) {
            $query = $query->where('state', $this->getState());
        }

        if ($this->getFsa()) {
            $query = $query->where('fsa', $this->getFsa());
        }

        if ($this->getCounties()) {
            $query = $query->where('counties', $this->getCounties());
        }

        return $query->first() ?? null;
    }
}
