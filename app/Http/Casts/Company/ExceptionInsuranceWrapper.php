<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class ExceptionInsuranceWrapper extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id')
            ? (int) $this->get('id')
            : 0;
    }

    public function getBillingCompanyId(): ?int
    {
        return $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : null;
    }

    public function getInsurancePlanIds(): array
    {
        return $this->getArray('insurance_plan_ids');
    }
}
