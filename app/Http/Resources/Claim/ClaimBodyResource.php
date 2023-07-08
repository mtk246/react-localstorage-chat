<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimBodyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'billing_company_id' => $this->resource->id,
            'code' => $this->resource->code,
            'type' => $this->resource->type->value,
            'submitter_name' => $this->resource->submitter_name,
            'submitter_contact' => $this->resource->submitter_contact,
            'submitter_phone' => $this->resource->submitter_phone,
            'demographic_information' => new DemographicInformationResource(
                $this->resource->demographicInformation,
                $this->resource->type->value
            ),
            'claim_service' => new ClaimServiceResource(
                $this->resource->service,
                $this->resource->type->value,
                $this->resource->demographicInformation->company_id ?? null,
            ),
            'additional_information' => new AdditionalInformationResource(
                $this->resource,
                $this->resource->type->value
            ),
            'insurance_policies' => $this->resource->insurancePolicies->map(function ($model) {
                return new InsurancePolicyResource($model);
            }),

            /*
             * @todo Pendiente por validar
             *'last_modified' => $this->getLastModifiedAttribute(),
             *'private_note' => $this->getPrivateNoteAttribute(),
             *'status' => $this->getStatusAttribute(),
             *'status_history' => $this->getStatusHistoryAttribute(),
             *'notes_history' => $this->getNotesHistoryAttribute(),
             *'billed_amount' => $this->getBilledAmountAttribute(),
             *'amount_paid' => $this->getAmountPaidAttribute(),
             *'past_due_date' => $this->getPastDueDateAttribute(),
             *'date_of_service' => $this->getDateOfServiceAttribute(),
             *'status_date' => $this->getStatusDateAttribute(),
             *'insurance_company_id' => $this->getInsuranceCompanyIdAttribute(),
             *'insurance_company' => $this->getInsuranceCompanyAttribute(),
             *'insurance_plan' => $this->getInsurancePlanAttribute(),
             *'user_created' => $this->getUserCreatedAttribute(),
             *'type_responsibility' => $this->insurancePolicies()->first()?->typeResponsibility ?? null,
             */

            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
