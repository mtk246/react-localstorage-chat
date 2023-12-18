<?php

declare(strict_types=1);

namespace App\Http\Casts\InsurancePlan;

use App\Http\Casts\CastsRequest;
use App\Models\MacLocality;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class ContractFeesRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function getCompanyId(): Collection
    {
        return collect($this->inputs['company_id'] ?? null);
    }

    public function getTypeId(): ?int
    {
        return $this->get('type_id');
    }

    public function getStartDate(): ?string
    {
        return $this->get('start_date');
    }

    public function getEndDate(): ?string
    {
        return $this->get('end_date');
    }

    public function getProceduresIds(): Collection
    {
        return $this->getCollect('procedure_ids');
    }

    public function getModifierIds(): Collection
    {
        return $this->getCollect('modifier_ids');
    }

    public function getPrice(): ?float
    {
        return $this->get('price');
    }

    public function getMac(): ?string
    {
        return $this->get('state');
    }

    public function getLocalityNumber(): ?string
    {
        return $this->get('fsa');
    }

    public function getState(): ?string
    {
        return $this->get('state');
    }

    public function getFsa(): ?string
    {
        return $this->get('fsa');
    }

    public function getCounties(): ?string
    {
        return $this->get('counties');
    }

    public function getInsuranceLabelFeeId(): ?int
    {
        return $this->get('insurance_label_fee_id');
    }

    public function getPricePercentage(): ?float
    {
        return $this->get('price_percentage');
    }

    public function getPrivateNote(): ?string
    {
        return $this->get('private_note');
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

    public function getHaveContractSpecifications(): bool
    {
        return $this->getBool('have_contract_specifications', $this->inputs);
    }

    /**
     * @return \Illuminate\Support\Collection<TKey, TValue>
     *
     * @template TKey of array-key
     * @template TValue of \App\Http\Requests\Models\Medicament
     */
    public function getPatients(): Collection
    {
        return collect($this->inputs['patients'] ?? [])
            ->map(fn (array $inputs) => new ContractFeePatiensCast($inputs, $this->request, $this->user));
    }

    public function getContractSpecifications(): Collection
    {
        return collect(
            $this->getHaveContractSpecifications()
                ? $this->inputs['contract_specifications'] ?? []
                : []
        )
            ->map(fn (array $inputs) => new ContractFeeSpecificationWrapper($inputs, $this->request, $this->user));
    }

    public function wrapperContractFeesBody(): array
    {
        return [
            'billing_company_id' => $this->getBillingCompanyId(),
            'mac_locality_id' => $this->getMacLocality()?->id,
            'insurance_label_fee_id' => $this->getInsuranceLabelFeeId(),
            'contract_fee_type_id' => $this->getTypeId(),
            'start_date' => $this->getStartDate(),
            'private_note' => $this->getPrivateNote(),
            'end_date' => $this->getEndDate(),
            'price' => $this->getPrice(),
            'price_percentage' => $this->getPricePercentage(),
        ];
    }
}
