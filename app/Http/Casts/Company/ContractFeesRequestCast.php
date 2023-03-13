<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\http\Casts\CastsRequest;
use App\Models\MacLocality;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class ContractFeesRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->inputs)
            ? (int) $this->inputs['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getInsurancePlanId(): ?int
    {
        return array_key_exists('insurance_plan_id', $this->inputs)
            ? (int) $this->inputs['insurance_plan_id']
            : null;
    }

    public function getInsuranceCompanyId(): ?int
    {
        return array_key_exists('insurance_company_id', $this->inputs)
            ? (int) $this->inputs['insurance_company_id']
            : null;
    }

    public function getTypeId(): ?int
    {
        return array_key_exists('type_id', $this->inputs)
            ? (int) $this->inputs['type_id']
            : null;
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

    public function getProceduresIds(): Collection
    {
        return collect($this->inputs['procedure_id'] ?? []);
    }

    public function getModifierId(): ?int
    {
        return array_key_exists('modifier_id', $this->inputs)
            ? (int) $this->inputs['modifier_id']
            : null;
    }

    public function getPrice(): ?int
    {
        return array_key_exists('price', $this->inputs)
            ? (int) $this->inputs['price']
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

    public function getPrivateNote(): ?string
    {
        return array_key_exists('private_note', $this->inputs)
            ? $this->inputs['private_note']
            : null;
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

    /**
     * @return \Illuminate\Support\Collection<TKey, TValue>
     *
     * @template TKey of array-key
     * @template TValue of \App\Http\Requests\Models\Medicament
     */
    public function getPatiens(): Collection
    {
        return collect($this->inputs['patiens'] ?? [])
            ->map(fn (array $inputs) => new ContractFeePatiensCast($inputs, $this->querys, $this->user));
    }
}
