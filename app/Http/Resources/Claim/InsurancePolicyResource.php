<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Contact;
use App\Models\InsurancePlan;
use Illuminate\Http\Resources\Json\JsonResource;

final class InsurancePolicyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $claimEligibilityCurrent = $this->resource
            ->claimEligibilities()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->first();

        $insurancePlanContactInfo = Contact::where('contactable_id', $this->resource->insurance_plan_id)
            ->where('contactable_type', InsurancePlan::class)
            ->first();

        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'patient_id' => $this->resource->patient_id,
            'patient' => $this->resource->patient->profile?->first_name.' '.$this->resource->patient->profile?->last_name,
            'status' => $this->resource->status,
            'own' => $this->resource->own,
            'policy_number' => $this->resource->policy_number,
            'group_number' => $this->resource->group_number,
            'eff_date' => $this->resource->eff_date,
            'end_date' => $this->resource->end_date,
            'release_info' => $this->resource->release_info,
            'assign_benefits' => $this->resource->assign_benefits,
            'insurance_company_id' => $this->resource->insurancePlan->insurance_company_id,
            'insurance_company' => [
                'id' => $this->resource->insurancePlan->insurance_company_id,
                'name' => $this->resource->insurancePlan->insuranceCompany->name,
                'payer_id' => $this->resource->insurancePlan->insuranceCompany->payer_id,
            ],
            'contact' => $insurancePlanContactInfo ? $insurancePlanContactInfo->toArray() : [],
            'insurance_plan_id' => $this->resource->insurance_plan_id,
            'insurance_plan' => $this->resource->insurancePlan->name,
            'type_responsibility_id' => $this->resource->type_responsibility_id ?? '',
            'type_responsibility' => $this->resource->typeResponsibility?->code ?? '',
            'payer_responsibility_id' => $this->resource->payer_responsibility_id ?? '',
            'payer_responsibility' => $this->resource->payerResponsibility?->code ?? '',
            'payment_responsibility_level_code' => $this->resource->payment_responsibility_level_code ?? '',
            'insurance_policy_type_id' => $this->resource->insurance_policy_type_id ?? '',
            'insurance_policy_type_code' => $this->resource->insurancePolicyType?->code ?? '',
            'insurance_policy_type_name' => $this->resource->insurancePolicyType?->description ?? '',
            'insurance_plan_type' => $this->resource->insurancePlan->planTypes ? $this->resource->insurancePlan->planTypes : [],
            'insurance_policy_id' => $this->resource->id ?? '',
            'order' => $this->resource->pivot->order,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'subscribers' => (!$this->resource->own)
                ? $this->resource->subscribers
                : null,
            'claim_eligibility' => (isset($claimEligibilityCurrent))
                ? [
                    'id' => $claimEligibilityCurrent->id,
                    'control_number' => $claimEligibilityCurrent->control_number ?? null,
                    'response_details' => json_decode($claimEligibilityCurrent->response_details ?? ''),
                    'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                    'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                ]
                : null,
        ];
    }
}
