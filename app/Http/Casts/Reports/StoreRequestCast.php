<?php

declare(strict_types=1);

namespace App\Http\Casts\Reports;

use App\Http\Casts\CastsRequest;
use App\Models\Reports\Report;
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

    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    public function getClasification(): int
    {
        return $this->get('clasification');
    }

    public function getBaseReport(): ?Report
    {
        return $this->get('base_report_id')
            ? Report::findOrFail($this->get('base_report_id'))
            : null;
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
