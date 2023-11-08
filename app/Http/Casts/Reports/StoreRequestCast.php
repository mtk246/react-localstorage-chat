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

    public function getBaseReport(): ?Report
    {
        return $this->get('base_report_id')
            ? Report::findOrFail($this->get('base_report_id'))
            : null;
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
}
