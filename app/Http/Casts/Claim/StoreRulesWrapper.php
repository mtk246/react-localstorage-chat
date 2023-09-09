<?php

declare(strict_types=1);

namespace App\Http\Casts\Claim;

use App\Enums\Claim\RequiredFillRuleType;
use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class StoreRulesWrapper extends CastsRequest
{
    public function getRuleData(): array
    {
        return [
            'name' => $this->get('name'),
            'format' => $this->get('format'),
            'description' => $this->get('description') ?? '',
            'billing_company_id' => $this->getBillingCompanyId(),
            'insurance_plan_id' => $this->getInsurancePlan(),
            'rules' => $this->getRules()->toArray(),
            'parameters' => $this->getParameters()->toJson(),
        ];
    }

    private function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getInsurancePlan(): int
    {
        return $this->get('insurance_plan_id');
    }

    private function getRules(): Collection
    {
        return $this->getCollect('rules');
    }

    private function getParameters(): Collection
    {
        return $this->getRules()
            ->filter(fn (array $value, string $key) => !is_null(RequiredFillRuleType::tryFrom($key)))
            ->mapWithKeys(fn (array $rule) => [$rule['name'] => $rule['value']]);
    }
}
