<?php

declare(strict_types=1);

namespace App\Http\Requests\Casts;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class CopayRequestCast
{
    /** @param array<key, string|int|null> $copays*/
    public function __construct(private array $copays, private User $user)
    {
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->copays)
            ? (int) $this->copays['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getProceduresIds(): Collection
    {
        return collect($this->copays['procedure_ids'] ?? []);
    }

    public function getInsurancePlanId(): ?int
    {
        return array_key_exists('insurance_plan_id', $this->copays)
            ? (int) $this->copays['insurance_plan_id']
            : null;
    }

    public function getInsuranceCompanyId(): ?int
    {
        return array_key_exists('insurance_company_id', $this->copays)
            ? (int) $this->copays['insurance_company_id']
            : null;
    }

    public function getCopay(): ?int
    {
        return array_key_exists('copay', $this->copays)
            ? (int) $this->copays['copay']
            : null;
    }

    public function getPrivateNote(): ?string
    {
        return array_key_exists('private_note', $this->copays)
            ? $this->copays['private_note']
            : null;
    }
}
