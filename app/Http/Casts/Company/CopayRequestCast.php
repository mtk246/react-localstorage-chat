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
        return array_key_exists('id', $this->inputs)
            ? (int) $this->inputs['id']
            : null;
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->inputs)
            ? (int) $this->inputs['billing_company_id']
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
