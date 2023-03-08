<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class CopayRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->inputs)
            ? (int) $this->inputs['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getProceduresIds(): Collection
    {
        return collect($this->inputs['procedure_ids'] ?? []);
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

    public function getCopay(): ?int
    {
        return array_key_exists('copay', $this->inputs)
            ? (int) $this->inputs['copay']
            : null;
    }

    public function getPrivateNote(): ?string
    {
        return array_key_exists('private_note', $this->inputs)
            ? $this->inputs['private_note']
            : null;
    }
}
