<?php

declare(strict_types=1);

namespace App\Http\Casts\InsurancePlan;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class CopayRequestCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id');
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getCompaniesIds(): Collection
    {
        return $this->getCollect('companies_ids');
    }

    public function getProceduresIds(): Collection
    {
        return $this->getCollect('procedure_ids');
    }

    public function getCopay(): ?float
    {
        return $this->has('copay')
            ? (float) $this->get('copay')
            : null;
    }

    public function getPrivateNote(): ?string
    {
        return $this->get('private_note');
    }
}
