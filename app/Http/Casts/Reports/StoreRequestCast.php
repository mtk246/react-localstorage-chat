<?php

declare(strict_types=1);

namespace App\Http\Casts\Reports;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Facades\Gate;

final class StoreRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    public function getUse(): string
    {
        return $this->get('use');
    }

    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    public function getTags(): array
    {
        return $this->getArray('tags');
    }

    public function getType(): int
    {
        return $this->get('type');
    }

    public function getRange(): string
    {
        return $this->get('range');
    }

    public function getConfiguration(): ConfigurationCast
    {
        return $this->cast('configuration', ConfigurationCast::class);
    }
}
