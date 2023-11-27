<?php

declare(strict_types=1);

namespace App\Http\Casts\Reports;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    public function getClasification(): int
    {
        return $this->getInt('clasification');
    }

    public function getType(): int
    {
        return $this->getInt('type');
    }

    public function getRange(): ?string
    {
        return $this->get('range');
    }

    public function getConfiguration(): ConfigurationCast
    {
        return $this->cast('configuration', ConfigurationCast::class);
    }

    public function getFavorite(): bool
    {
        return (bool) $this->get('favorite');
    }
}
