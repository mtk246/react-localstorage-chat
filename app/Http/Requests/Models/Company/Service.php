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
        return array_key_exists('billing_company_id', $this->service)
            ? $this->service['billing_company_id']
            : null;
    }

    public function getProcedureId(): ?int
    {
        return array_key_exists('procedure_id', $this->service)
            ? $this->service['procedure_id']
            : null;
    }

    public function getModifierId(): ?int
    {
        return array_key_exists('modifier_id', $this->service)
            ? $this->service['modifier_id']
            : null;
    }

    public function getPrice(): ?float
    {
        return array_key_exists('price', $this->service)
            ? (float) $this->service['price']
            : null;
    }

    public function getMac(): ?string
    {
        return array_key_exists('state', $this->service)
            ? $this->service['mac']
            : null;
    }

    public function getLocalityNumber(): ?string
    {
        return array_key_exists('fsa', $this->service)
            ? $this->service['locality_number']
            : null;
    }

    public function getState(): ?string
    {
        return array_key_exists('state', $this->service)
            ? $this->service['state']
            : null;
    }

    public function getFsa(): ?string
    {
        return array_key_exists('fsa', $this->service)
            ? $this->service['fsa']
            : null;
    }

    public function getCounties(): ?string
    {
        return array_key_exists('counties', $this->service)
            ? $this->service['counties']
            : null;
    }

    public function getInsuranceLabelFeeId(): ?int
    {
        return array_key_exists('insurance_label_fee_id', $this->service)
            ? (int) $this->service['insurance_label_fee_id']
            : null;
    }

    public function getPricePercentage(): ?int
    {
        return array_key_exists('price_percentage', $this->service)
            ? (int) $this->service['price_percentage']
            : null;
    }

    public function getClia(): ?string
    {
        return array_key_exists('clia', $this->service)
            ? $this->service['clia']
            : null;
    }

    /**
     * @return \Illuminate\Support\Collection<TKey, TValue>
     *
     * @template TKey of array-key
     * @template TValue of \App\Http\Requests\Models\Medicament
     */
    public function getMedications(): Collection
    {
        return collect($this->service['medications'] ?? [])
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
