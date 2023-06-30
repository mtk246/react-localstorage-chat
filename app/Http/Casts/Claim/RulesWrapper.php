<?php

declare(strict_types=1);

namespace App\Http\Casts\Claim;

use App\Enums\Claim\RequiredFillRuleType;
use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class RulesWrapper extends CastsRequest
{
    public function getCompanies(): Collection
    {
        return $this->getCollect('companies');
    }

    public function getRuleData(): array
    {
        return [
            'name' => $this->get('name'),
            'format' => $this->get('format'),
            'description' => $this->get('description') ?? '',
            'billing_company_id' => $this->getBillingCompanyId(),
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
        return collect(config('claim.formats.institutional'))
            ->map(fn ($format) => collect($format)
                ->map(fn (array $rule) => collect($rule)
                    ->only(['type', 'value'])
                )
            );
    }

    private function getParameters(): Collection
    {
        return $this->getRules()
            ->filter(fn (string $value, string $key) => !is_null(RequiredFillRuleType::tryFrom($key)))
            ->mapWithKeys(fn (array $rule) => [$rule['name'] => $rule['value']]);
    }
}
