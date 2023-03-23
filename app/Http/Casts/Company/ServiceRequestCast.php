<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use App\Models\MacLocality;
use Illuminate\Support\Collection;

final class ServiceRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return array_key_exists('billing_company_id', $this->inputs)
            ? $this->inputs['billing_company_id']
            : null;
    }

    public function getProcedureId(): ?int
    {
        return array_key_exists('procedure_id', $this->inputs)
            ? $this->inputs['procedure_id']
            : null;
    }

    public function getModifierId(): ?int
    {
        return array_key_exists('modifier_id', $this->inputs)
            ? $this->inputs['modifier_id']
            : null;
    }

    public function getPrice(): ?float
    {
        return array_key_exists('price', $this->inputs)
            ? (float) $this->inputs['price']
            : null;
    }

    public function getMac(): ?string
    {
        return array_key_exists('state', $this->inputs)
            ? $this->inputs['mac']
            : null;
    }

    public function getLocalityNumber(): ?string
    {
        return array_key_exists('fsa', $this->inputs)
            ? $this->inputs['locality_number']
            : null;
    }

    public function getState(): ?string
    {
        return array_key_exists('state', $this->inputs)
            ? $this->inputs['state']
            : null;
    }

    public function getFsa(): ?string
    {
        return array_key_exists('fsa', $this->inputs)
            ? $this->inputs['fsa']
            : null;
    }

    public function getCounties(): ?string
    {
        return array_key_exists('counties', $this->inputs)
            ? $this->inputs['counties']
            : null;
    }

    public function getInsuranceLabelFeeId(): ?int
    {
        return array_key_exists('insurance_label_fee_id', $this->inputs)
            ? (int) $this->inputs['insurance_label_fee_id']
            : null;
    }

    public function getPricePercentage(): ?int
    {
        return array_key_exists('price_percentage', $this->inputs)
            ? (int) $this->inputs['price_percentage']
            : null;
    }

    public function getClia(): ?string
    {
        return array_key_exists('clia', $this->inputs)
            ? $this->inputs['clia']
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
        return collect($this->inputs['medications'] ?? [])
            ->map(fn (array $item) => new MedicationRequestCast($item, $this->querys, $this->user));
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
