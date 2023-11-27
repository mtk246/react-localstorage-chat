<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class CopayRequestCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getProceduresIds(): Collection
    {
        return collect($this->inputs['procedure_ids'] ?? []);
    }

    public function getInsurancePlanIds(): Collection
    {
        return collect($this->inputs['insurance_plan_ids'] ?? []);
    }

    public function getInsuranceCompanyIds(): Collection
    {
        return collect($this->inputs['insurance_company_ids'] ?? []);
    }

    public function getCopay(): ?float
    {
        return $this->has('copay')
            ? (float) $this->inputs['copay']
            : null;
    }

    public function getPrivateNote(): ?string
    {
        return $this->get('private_note');
    }
}
