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
        return Gate::allows('is-admin') && $this->copays['billing_company_id']
            ? (int) $this->copays['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getProceduresIds(): Collection
    {
        return collect($this->copays['procedure_id']);
    }

    public function getInsurancePlanId(): int
    {
        return (int) $this->copays['insurance_plan_id'];
    }

    public function getInsuranceCompanyId(): int
    {
        return (int) $this->copays['insurance_company_id'];
    }

    public function getCopay(): int
    {
        return (int) $this->copays['copay'];
    }

    public function getPrivateNote(): ?string
    {
        return $this->copays['private_note'];
    }
}
