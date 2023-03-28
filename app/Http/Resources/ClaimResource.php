<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $insurancePolicies = [];

        foreach ($this->insurancePolicies as $key => $insurancePolicy) {
            $insurancePolicy['type_responsibility'] = $insurancePolicy->typeResponsibility;
            $insurancePolicies[$key] = $insurancePolicy;
            $claimEligibilityCurrent = $insurancePolicy->claimEligibilities()
                                                        ->where('claim_id', $this->id)
                                                        ->orderBy('created_at', 'desc')
                                                        ->orderBy('id', 'asc')->first();

            $insurancePolicies[$key]['claim_eligibility'] = isset($claimEligibilityCurrent)
                ? [
                    'control_number' => $claimEligibilityCurrent->control_number ?? null,
                    'claim_id' => $claimEligibilityCurrent->claim_id ?? null,
                    'insurance_policy' => $claimEligibilityCurrent->insurancePolicy ?? null,
                    'insurance_policy_id' => $claimEligibilityCurrent->insurance_policy_id ?? null,
                    'response_details' => json_decode($claimEligibilityCurrent->response_details ?? ''),
                    'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                    'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                ] : null;
        }

        return [
            'id' => $this->id,
            'qr_claim' => $this->qr_claim,
            'control_number' => $this->control_number,
            'submitter_name' => $this->submitter_name,
            'submitter_contact' => $this->submitter_contact,
            'submitter_phone' => $this->submitter_phone,
            'company_id' => $this->company_id,
            'company' => $this->company->name ?? '',
            'facility_id' => $this->facility_id,
            'facility' => $this->facility->name ?? '',
            'patient_id' => $this->patient_id,
            'patient' => isset($this->patient->user)
                ? ($this->patient->user->profile->first_name.' '.$this->patient->user->profile->last_name)
                : '',
            'billing_provider_id' => $this->billing_provider_id,
            'billing_provider' => isset($this->billingProvider->user) ?
                ($this->billingProvider->user->profile->first_name.' '.$this->billingProvider->user->profile->last_name)
                : '',
            'service_provider_id' => $this->service_provider_id,
            'service_provider' => isset($this->serviceProvider->user)
                ? ($this->serviceProvider->user->profile->first_name.' '.
                  $this->serviceProvider->user->profile->last_name)
                : '',
            'referred_id' => $this->referred_id,
            'referred' => isset($this->referred->user)
                ? ($this->referred->user->profile->first_name.' '.$this->referred->user->profile->last_name)
                : '',
            'referred_provider_role_id' => $this->referred_provider_role_id,
            'referred_provider_role' => $this->referredProviderRole->name ?? '',
            'validate' => $this->validate,
            'automatic_eligibility' => $this->automatic_eligibility,
            'claim_formattable_type' => $this->claim_formattable_type,
            'claim_formattable_id' => $this->claim_formattable_id,

            'insurance_policies' => $insurancePolicies,
            'claim_formattable' => $this->claimFormattable,
            'diagnoses' => $this->diagnoses,

            'format' => $this->claimFormattable->type_form_id ?? '',
            'last_modified' => $this->getLastModifiedAttribute(),
            'private_note' => $this->getPrivateNoteAttribute(),
            'status' => $this->getStatusAttribute(),
            'status_history' => $this->getStatusHistoryAttribute(),
            'notes_history' => $this->getNotesHistoryAttribute(),
            'billed_amount' => $this->getBilledAmountAttribute(),
            'amount_paid' => $this->getAmountPaidAttribute(),
            'past_due_date' => $this->getPastDueDateAttribute(),
            'date_of_service' => $this->getDateOfServiceAttribute(),
            'status_date' => $this->getStatusDateAttribute(),
            'insurance_company_id' => $this->getInsuranceCompanyIdAttribute(),
            'insurance_company' => $this->getInsuranceCompanyAttribute(),
            'insurance_plan' => $this->getInsurancePlanAttribute(),
            'user_created' => $this->getUserCreatedAttribute(),
            'type_responsibility' => $this->insurancePolicies()->first()?->typeResponsibility ?? null,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'batch' => null,
        ];
    }
}
