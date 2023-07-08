<?php

declare(strict_types=1);

namespace App\Http\Casts\Claim;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class UpdateRulesWrapper extends CastsRequest
{
    public function getRuleData(): array
    {
        return [
            'id' => $this->get('id'),
            'name' => $this->get('name'),
            'format' => $this->get('format'),
            'description' => $this->get('description') ?? '',
            'billing_company_id' => $this->getBillingCompanyId(),
            'insurance_company_id' => $this->get('insurance_company_id'),
            'rules' => $this->getRules()->toArray(),
            'parameters' => $this->getParameters()->toArray(),
        ];
    }

    private function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    private function getRules(): Collection
    {
        return $this->getCollect('rules');
    }

    private function getParameters(): Collection
    {
        return $this->getCollect('parameters');
    }
}
