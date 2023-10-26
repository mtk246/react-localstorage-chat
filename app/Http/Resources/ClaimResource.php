<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;
use App\Models\TypeCatalog;
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
        $type = $this->claimFormattable->typeForm?->form;

        return ('UB-04 / 837I' == $type)
            ? $this->getUB04Resources()
            : (('CMS-1500 / 837P' == $type)
                ? $this->getCMS1500Resources()
                : []);
    }

    protected function getUB04Resources(): array
    {
        $insurancePolicies = [];

        foreach ($this->insurancePolicies as $key => $insurancePolicy) {
            $insurancePolicy['type_responsibility'] = $insurancePolicy->typeResponsibility;
            $insurancePolicies[$key] = $insurancePolicy;
            $claimEligibilityCurrent = $insurancePolicy->claimEligibilities()
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'asc')->first();

            $insurancePolicies[$key]['order'] = $insurancePolicy->pivot?->order ?? 0;
            $insurancePolicies[$key]['claim_eligibility'] = isset($claimEligibilityCurrent)
                ? [
                    'control_number' => $claimEligibilityCurrent->control_number ?? null,
                    'insurance_policy' => $claimEligibilityCurrent->insurancePolicy ?? null,
                    'insurance_policy_id' => $claimEligibilityCurrent->insurance_policy_id ?? null,
                    'response_details' => json_decode($claimEligibilityCurrent->response_details ?? ''),
                    'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                    'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                ] : null;
        }

        $order = ['P', 'S', 'T'];

        usort($insurancePolicies, function ($a, $b) use ($order) {
            $a_index = array_search($a['type_responsibility']['code'], $order);
            $b_index = array_search($b['type_responsibility']['code'], $order);

            return $a_index - $b_index;
        });
        $this->claimFormattable?->physicianOrSupplierInformation?->claimDateInformations->transform(function ($dateInfo) {
            $enums = collect(FieldInformationInstitutional::cases());
            $item = $enums->first(fn ($item) => $item->value === (int) $dateInfo->field_id);
            if (is_null($item)) {
                $field = TypeCatalog::find($dateInfo->field_id);
                $item = $enums->first(fn ($item) => $item->getName() === $field?->description);
                $dateInfo->field_id = $item->value;
            }
            $dateInfo->field = ($item) ? [
                'id' => $item,
                'code' => $item->value,
                'description' => $item->getName(),
            ] : null;

            return $dateInfo;
        });
        $claimFormattable = [
            'id' => $this->claimFormattable->id,
            'type_form_id' => $this->claimFormattable->type_form_id,
            'type_of_medical_assistance' => $this->claimFormattable->type_of_medical_assistance,
            'billing_company_id' => $this->claimFormattable->billing_company_id,
            'created_at' => $this->claimFormattable->created_at,
            'updated_at' => $this->claimFormattable->updated_at,

            'prior_authorization_number' => $this->claimFormattable?->physicianOrSupplierInformation?->prior_authorization_number,
            'employment_related_condition' => $this->claimFormattable?->patientOrInsuredInformation?->employment_related_condition,
            'auto_accident_related_condition' => $this->claimFormattable?->patientOrInsuredInformation?->auto_accident_related_condition,
            'auto_accident_place_state' => $this->claimFormattable?->patientOrInsuredInformation?->auto_accident_place_state,
            'other_accident_related_condition' => $this->claimFormattable?->patientOrInsuredInformation?->other_accident_related_condition,
            'accept_assignment' => $this->claimFormattable?->physicianOrSupplierInformation?->accept_assignment,
            'patient_signature' => $this->claimFormattable?->patientOrInsuredInformation?->patient_signature,
            'insured_signature' => $this->claimFormattable?->patientOrInsuredInformation?->insured_signature,
            'outside_lab' => $this->claimFormattable?->physicianOrSupplierInformation?->outside_lab,
            'charges' => $this->claimFormattable?->physicianOrSupplierInformation?->charges,
            'claim_services' => $this->claimFormattable?->claimFormServices->map(function ($service) {
                return [
                    'id' => $service->id,
                    'from_service' => $service->from_service,
                    'to_service' => $service->to_service,
                    'procedure_id' => $service->procedure_id,
                    'procedures' => isset($service->procedure)
                        ? [[
                            'id' => $service->procedure_id,
                            'name' => $service->procedure->code,
                            'description' => $service->procedure->description,
                            'price' => $service->procedure->companyServices
                                ->firstWhere('company_id', $this->company_id)?->price ?? 0,
                        ]]
                        : [],
                    'revenue_code_id' => $service->revenue_code_id,
                    'revenue_codes' => isset($service->revenueCode)
                        ? [[
                            'id' => $service->revenue_code_id,
                            'name' => $service->revenueCode->code,
                            'description' => $service->revenueCode->description,
                        ]]
                        : [],
                    'price' => $service->price,
                    'units_of_service' => $service->days_or_units,
                    'total_charge' => $service->total_charge,
                    'copay' => $service->copay,
                ];
            }),
            'additional_information' => [
                'admission_date' => $this->claimFormattable?->physicianOrSupplierInformation?->admission_date,
                'admission_time' => $this->claimFormattable?->physicianOrSupplierInformation?->admission_time,
                'discharge_date' => $this->claimFormattable?->physicianOrSupplierInformation?->discharge_date,
                'discharge_time' => $this->claimFormattable?->physicianOrSupplierInformation?->discharge_time,
                'condition_code_ids' => $this->claimFormattable?->physicianOrSupplierInformation?->condition_code_ids,
                'condition_codes' => $this->claimFormattable?->physicianOrSupplierInformation?->condition_codes,
                'admission_type_id' => $this->claimFormattable?->physicianOrSupplierInformation?->admission_type_id,
                'admission_source_id' => $this->claimFormattable?->physicianOrSupplierInformation?->admission_source_id,
                'patient_status_id' => $this->claimFormattable?->physicianOrSupplierInformation?->patient_status_id,
                'bill_classification_id' => $this->claimFormattable?->physicianOrSupplierInformation?->bill_classification_id,
                'diagnosis_related_group_id' => $this->claimFormattable?->physicianOrSupplierInformation?->diagnosis_related_group_id,
                'non_covered_charges' => $this->claimFormattable?->physicianOrSupplierInformation?->non_covered_charges,
                'claim_date_informations' => $this->claimFormattable?->physicianOrSupplierInformation?->claimDateInformations->map(function ($dateInfo) {
                    return [
                        'id' => $dateInfo->id,
                        'field_id' => $dateInfo->field_id,
                        'field' => $dateInfo->field,
                        'qualifier_id' => $dateInfo->qualifier_id,
                        'qualifier' => $dateInfo->qualifier,
                        'from_date' => $dateInfo->from_date_or_current,
                        'to_date' => $dateInfo->to_date,
                        'through' => $dateInfo->through,
                        'amount' => $dateInfo->amount,
                    ];
                }),
            ],
        ];

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
            'validate' => $this->validate,
            'automatic_eligibility' => $this->automatic_eligibility,
            'claim_formattable_type' => $this->claim_formattable_type,
            'claim_formattable_id' => $this->claim_formattable_id,

            'insurance_policies' => $insurancePolicies,
            'claim_formattable' => $claimFormattable,
            'diagnoses' => $this->diagnoses,
            'health_professional_qualifier' => $this->healthProfessionals->transform(function ($hpq) {
                return [
                    'field_id' => $hpq->pivot->field_id,
                    'qualifier_id' => $hpq->pivot->qualifier_id,
                    'health_professional_id' => $hpq->pivot->health_professional_id,
                ];
            }),

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

    protected function getCMS1500Resources(): array
    {
        $insurancePolicies = [];

        foreach ($this->insurancePolicies as $key => $insurancePolicy) {
            $insurancePolicy['type_responsibility'] = $insurancePolicy->typeResponsibility;
            $insurancePolicies[$key] = $insurancePolicy;
            $claimEligibilityCurrent = $insurancePolicy->claimEligibilities()
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'asc')->first();

            $insurancePolicies[$key]['order'] = $insurancePolicy->pivot?->order ?? 0;
            $insurancePolicies[$key]['claim_eligibility'] = isset($claimEligibilityCurrent)
                ? [
                    'control_number' => $claimEligibilityCurrent->control_number ?? null,
                    'insurance_policy' => $claimEligibilityCurrent->insurancePolicy ?? null,
                    'insurance_policy_id' => $claimEligibilityCurrent->insurance_policy_id ?? null,
                    'response_details' => json_decode($claimEligibilityCurrent->response_details ?? ''),
                    'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                    'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                ] : null;
        }

        $order = ['P', 'S', 'T'];

        usort($insurancePolicies, function ($a, $b) use ($order) {
            $a_index = array_search($a['type_responsibility']['code'], $order);
            $b_index = array_search($b['type_responsibility']['code'], $order);

            return $a_index - $b_index;
        });
        $this->claimFormattable?->physicianOrSupplierInformation?->claimDateInformations->transform(function ($dateInfo) {
            $enums = collect(FieldInformationProfessional::cases());
            $item = $enums->first(fn ($item) => $item->value === (int) $dateInfo->field_id);
            if (is_null($item)) {
                $field = TypeCatalog::find($dateInfo->field_id);
                $item = $enums->first(fn ($item) => $item->getName() === $field?->description);
            }
            $dateInfo->field_id = $item->value ?? '';
            $dateInfo->field = ($item) ? [
                'id' => $item,
                'code' => $item->value,
                'description' => $item->getName(),
            ] : null;

            return $dateInfo;
        });
        $this->claimFormattable?->claimFormServices->transform(function ($service) {
            $service->procedures = ($service->procedure_id)
                ? [[
                    'id' => $service->procedure_id,
                    'name' => $service->procedure->code,
                    'description' => $service->procedure->description,
                    'price' => $service->procedure->companyServices
                        ->firstWhere('company_id', $this->company_id)?->price ?? 0,
                ]]
                : [];

            return $service;
        });

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
            'billing_provider' => isset($this->billingProvider->user)
                ? ($this->billingProvider->user->profile->first_name.' '.$this->billingProvider->user->profile->last_name)
                : '',
            'service_provider_id' => $this->service_provider_id,
            'service_provider' => isset($this->serviceProvider->user)
                ? ($this->serviceProvider->user->profile->first_name.' '
                  .$this->serviceProvider->user->profile->last_name)
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
