<?php

declare(strict_types=1);

namespace App\Http\Casts\Claim;

use App\Enums\Claim\RequiredFillRuleType;
use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class UpdateRulesWrapper extends CastsRequest
{
    public function getRuleData(): array
    {
        return [
            'name' => $this->get('name'),
            'format' => $this->get('format'),
            'description' => $this->get('description') ?? '',
            'billing_company_id' => $this->getBillingCompanyId(),
            'rules' => $this->getRules()->toArray(),
            'parameters' => $this->getParameters()->toJson(),
            'active' => $this->getBool('active', true),
            'note' => $this->get('note', ''),
        ];
    }

    private function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getInsuranceCompanies(): array
    {
        return $this->getArray('insurance_company_ids');
    }

    public function getInsurancePlans(): array
    {
        return $this->getArray('insurance_plan_ids');
    }

    public function hasResponsibilities(): bool
    {
        return $this->has('responsibilities');
    }

    public function getResponsibilities(): Collection
    {
        return $this->getCollect('responsibilities');
    }

    public function hasChangeStatus(): bool
    {
        return 1 === count($this->inputs) && filled($this->get('active', ''));
    }

    public function getActive(): bool
    {
        return $this->getBool('active', true);
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
