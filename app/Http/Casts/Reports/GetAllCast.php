<?php

declare(strict_types=1);

namespace App\Http\Casts\Reports;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class GetAllCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getClasifications(): Collection
    {
        return $this->getCollect('clasifications');
    }

    public function getFavorite(): bool
    {
        return (bool) $this->get('favorite');
    }
}
