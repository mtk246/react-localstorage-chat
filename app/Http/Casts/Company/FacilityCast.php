<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Facades\Gate;

final class FacilityCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::check('is-admin')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getId(): ?int
    {
        return (int) $this->get('facility_id');
    }
}
