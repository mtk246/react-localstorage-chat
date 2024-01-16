<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

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

    public function getId(): int
    {
        return $this->getInt('id', 0);
    }

    public function getInsurancePlanIds(): Collection
    {
        return $this->getCollect('insurance_plan_ids');
    }

    public function getInsuranceCompanyIds(): Collection
    {
        return $this->getCollect('insurance_company_ids');
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
        return $this->has('price')
            ? (float) $this->get('price')
            : null;
    }

    public function getMac(): ?string
    {
        return $this->get('mac');
    }

    public function getLocalityNumber(): ?string
    {
        return $this->get('locality_number');
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
        return $this->getInt('insurance_label_fee_id');
    }

    public function getPricePercentage(): ?int
    {
        return $this->getInt('price_percentage');
    }

    public function getPrivateNote(): ?string
    {
        return $this->get('private_note');
    }

    public function getMacLocality(): ?MacLocality
    {
        return MacLocality::query()
            ->when($this->getLocalityNumber(), fn ($query) => $query->where('locality_number', $this->getLocalityNumber()))
            ->when($this->getState(), fn ($query) => $query->where('state', $this->getState()))
            ->when($this->getFsa(), fn ($query) => $query->where('fsa', $this->getFsa()))
            ->when($this->getCounties(), fn ($query) => $query->where('counties', $this->getCounties()))
            ->when(
                $this->getMac(),
                fn ($query) => $query->where('mac', $this->getMac()),
                fn ($query) => $query->whereNull('mac')
            )->first();
    }

    public function getHaveContractSpecifications(): bool
    {
        return $this->getBool('have_contract_specifications');
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
            'contract_fee_type_id' => $this->getTypeId(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
            'insurance_label_fee_d' => $this->getInsuranceLabelFeeId(),
            'private_note' => $this->getPrivateNote(),
            'price' => $this->getPrice(),
            'price_percentage' => $this->getPricePercentage(),
        ];
    }
}
