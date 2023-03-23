<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class ExectionInsuranceCompanyCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id')
            ? (int) $this->get('id')
            : null;
    }

    public function getInsuranceCompanyId(): ?int
    {
        return $this->get('insurance_company_id')
            ? (int) $this->get('insurance_company_id')
            : null;
    }
}
