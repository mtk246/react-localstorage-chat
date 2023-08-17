<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Facades\Gate;

final class CompanyPatientWrapper extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id')
            ? (int) $this->get('id')
            : null;
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::check('is-admin')
            ? (int) $this->get('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getPatientId(): ?int
    {
        return $this->get('patient_id')
            ? (int) $this->get('patient_id')
            : null;
    }

    public function getMedicalNumber(): ?string
    {
        return $this->get('med_num');
    }
}
