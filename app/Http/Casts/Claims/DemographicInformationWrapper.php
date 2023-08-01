<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class DemographicInformationWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'type_of_medical_assistance' => $this->get('type_of_medical_assistance'),
            'bill_clasification' => $this->get('bill_clasification'),
            'validate' => $this->get('validate'),
            'automatic_eligibility' => $this->get('automatic_eligibility'),
            'company_id' => $this->get('company_id'),
            'facility_id' => $this->get('facility_id'),
            'patient_id' => $this->get('patient_id'),
            'prior_authorization_number' => $this->get('prior_authorization_number'),
            'accept_assignment' => $this->get('accept_assignment'),
            'patient_signature' => $this->get('patient_signature'),
            'insured_signature' => $this->get('insured_signature'),
            'outside_lab' => $this->get('outside_lab'),
            'charges' => $this->get('charges') ?? 0,
            'employment_related_condition' => $this->get('employment_related_condition'),
            'auto_accident_related_condition' => $this->get('auto_accident_related_condition'),
            'auto_accident_place_state' => $this->get('auto_accident_place_state'),
            'other_accident_related_condition' => $this->get('other_accident_related_condition'),
        ];
    }

    public function getHealthProfessionals(): Collection
    {
        return $this->getCollect('health_professional_qualifier');
    }

    public function getDiagnoses(): Collection
    {
        return $this->getCollect('diagnoses');
    }
}
