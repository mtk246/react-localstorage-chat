<?php

declare(strict_types=1);

namespace App\Http\Casts\HealthProfessional;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class StoreCompanyRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getId(): ?int
    {
        return $this->get('id');
    }

    public function getCompanyId(): int
    {
        return $this->get('company_id');
    }

    public function getAuthorization(): Collection
    {
        return $this->getCollect('authorization');
    }
}
