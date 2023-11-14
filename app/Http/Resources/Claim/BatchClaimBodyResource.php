<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Models\Claims\ClaimCheckStatus;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimSubStatus;
use Illuminate\Http\Resources\Json\JsonResource;

final class BatchClaimBodyResource extends JsonResource
{
    public function __construct($resource, protected int $claimBatchId)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_provider' => $this->getBillingProvider(),
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
                $this->resource->type->value,
                $this->resource->service
            ),
            'insurance_policies' => $this->resource->insurancePolicies->map(function ($model) {
                return new InsurancePolicyResource($model);
            }),
            'last_modified' => $this->last_modified,
            'private_note' => $this->private_note,
            'status' => $this->getStatus(),
            'status_history' => $this->getStatusHistory(),
            'notes_history' => $this->getNotesHistory(),
            'billed_amount' => $this->billed_amount,
            'amount_paid' => $this->amount_paid ?? '0.00',
            'past_due_date' => $this->past_due_date,
            'date_of_service' => $this->getDateOfServiceAttribute(),
            'status_date' => $this->getStatusDateAttribute(),
            'insurance_policy' => $this->getInsurancePolicy(),
            'user_created' => $this->user_created,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'transmission_status' => $this->getClaimTransmissionStatus(),
            'transmission_response' => $this->getClaimTransmissionResponse(),
        ];
    }

    private function getStatus(): ClaimStatus|array
    {
        $data = $this->resource->status()
            ->orderBy('claim_status_claim.id', 'desc')
            ->first()
            ?->setHidden(['pivot']);
        $data['sub_status'] = $this->getSubstatus();
        $data['sub_statuses'] = ClaimSubStatus::query()
            ->whereHas('claimStatuses', function ($query) use ($data) {
                $query->where('claim_status_id', $data->id ?? null);
            }
            )
            ->get()
            ->setVisible(['id', 'name'])
            ->toArray() ?? [];

        return $data;
    }

    private function getSubstatus(): ClaimSubStatus|array|null
    {
        return $this->resource->subStatus()
            ->orderBy('claim_status_claim.id', 'desc')
            ->first()
            ?->setHidden(['pivot']);
    }

    private function getStatusHistory(): array
    {
        $records = [];
        $recordSubstatus = [];
        $history = $this->claimStatusClaims()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')->get() ?? [];
        foreach ($history as $status) {
            match ($status->claim_status_type) {
                ClaimSubStatus::class => $this->setSubstatus($status, $recordSubstatus),
                ClaimStatus::class => $this->setStatus($status, $records, $recordSubstatus),
            };
        }

        return $records;
    }

    private function setSubStatus($status, &$recordSubstatus): void
    {
        $record = [];
        $notes = [];
        foreach ($status->privateNotes as $note) {
            array_push(
                $notes,
                [
                    'note' => $note->note,
                    'created_at' => $note->created_at,
                    'last_modified' => $note->last_modified,
                ]
            );
        }
        $record['notes_history'] = $notes;
        $record['code'] = $status->claimStatus->code ?? '';
        $record['name'] = $status->claimStatus->name ?? '';
        $record['sub_status_date'] = $status->created_at;
        $record['last_modified'] = $status->last_modified ?? '';
        array_push($recordSubstatus, $record);
    }

    private function setStatus($status, &$records, &$recordSubstatus): void
    {
        $record = [];
        $notes = [];
        foreach ($status->privateNotes as $note) {
            $check = ClaimCheckStatus::query()
                ->where('private_note_id', $note->id)
                ->first();
            array_push(
                $notes,
                [
                    'note' => $note->note,
                    'created_at' => $note->created_at,
                    'last_modified' => $note->last_modified,
                    'check_status' => isset($check) ? [
                        'response_details' => $check->response_details ?? '',
                        'interface_type' => $check->interface_type ?? '',
                        'interface' => $check->interface ?? '',
                        'consultation_date' => $check->consultation_date ?? '',
                        'resolution_time' => $check->resolution_time ?? '',
                        'past_due_date' => $check->past_due_date ?? '',
                    ] : null,
                ]
            );
        }
        $record['notes_history'] = $notes;
        $record['status'] = $status->claimStatus->status ?? '';
        $record['status_background_color'] = $status->claimStatus->background_color ?? '';
        $record['status_font_color'] = $status->claimStatus->font_color ?? '';
        $record['status_date'] = $status->created_at;
        $record['sub_status_history'] = $recordSubstatus;
        $record['last_modified'] = $status->last_modified ?? '';
        array_push($records, $record);
        $recordSubstatus = [];
    }

    private function getNotesHistory(): array
    {
        $records = [];
        $recordSubstatus = [];
        $history = $this->claimStatusClaims()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')->get() ?? [];
        foreach ($history as $status) {
            match ($status->claim_status_type) {
                ClaimSubStatus::class => $this->setSubNote($status, $recordSubstatus),
                ClaimStatus::class => $this->setNote($status, $records, $recordSubstatus),
            };
        }

        return $records;
    }

    private function setSubNote($status, &$recordSubstatus): void
    {
        $notes = $status->privateNotes()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')->get() ?? [];
        foreach ($notes as $note) {
            array_push(
                $recordSubstatus,
                [
                    'status' => $status->claimStatus->name ?? '',
                    'note' => $note->note,
                    'created_at' => $note->created_at,
                    'last_modified' => $note->last_modified,
                ]
            );
        }
    }

    private function setNote($status, &$records, &$recordSubstatus): void
    {
        foreach ($recordSubstatus as $subNote) {
            array_push(
                $records,
                [
                    'note' => $subNote['note'],
                    'created_at' => $subNote['created_at'],
                    'last_modified' => $subNote['last_modified'],
                    'check_status' => null,
                    'status' => $subNote['status'],
                    'status_background_color' => $status->claimStatus->background_color ?? '',
                    'status_font_color' => $status->claimStatus->font_color ?? '',
                ]
            );
        }
        $recordSubstatus = [];
        $notes = $status->privateNotes()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')->get() ?? [];
        foreach ($notes as $note) {
            $check = ClaimCheckStatus::query()
                ->where('private_note_id', $note->id)
                ->first();
            array_push(
                $records,
                [
                    'note' => $note->note,
                    'created_at' => $note->created_at,
                    'last_modified' => $note->last_modified,
                    'check_status' => isset($check) ? [
                        'response_details' => $check->response_details ?? '',
                        'interface_type' => $check->interface_type ?? '',
                        'interface' => $check->interface ?? '',
                        'consultation_date' => $check->consultation_date ?? '',
                        'resolution_time' => $check->resolution_time ?? '',
                        'past_due_date' => $check->past_due_date ?? '',
                    ] : null,
                    'status' => $status->claimStatus->status ?? '',
                    'status_background_color' => $status->claimStatus->background_color ?? '',
                    'status_font_color' => $status->claimStatus->font_color ?? '',
                ]
            );
        }
    }

    private function getInsurancePolicy(): ?array
    {
        $policyPrimary = $this->resource
            ->insurancePolicies()
            ->wherePivot('order', 1)
            ->first();

        return [
            'insurance_company_id' => $policyPrimary?->insurancePlan?->insuranceCompany?->id ?? '',
            'insurance_company' => $policyPrimary?->insurancePlan?->insuranceCompany?->name ?? '',
            'insurance_plan_id' => $policyPrimary?->insurancePlan?->id ?? '',
            'insurance_plan' => $policyPrimary?->insurancePlan?->name ?? '',
            'type_responsibility' => $policyPrimary?->typeResponsibility?->code ?? '',
            'batch' => $policyPrimary?->batch ?? '',
        ];
    }

    private function getClaimTransmissionStatus()
    {
        $transmissionCurrent = $this->claimTransmissionResponses()
            ->where('claim_batch_id', $this->claimBatchId)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')->first();

        return $transmissionCurrent->claimTransmissionStatus ?? null;
    }

    private function getClaimTransmissionResponse()
    {
        $transmissionCurrent = $this->claimTransmissionResponses()
            ->where('claim_batch_id', $this->claimBatchId)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')->first();

        return $transmissionCurrent?->response_details;
    }

    private function getBillingProvider(): ?string
    {
        $billing = $this->resource->demographicInformation->healthProfessionals()
            ->when(ClaimType::PROFESSIONAL == $this->resource->type, function ($query) {
                $query->where('field_id', 5);
            })
            ->when(ClaimType::INSTITUTIONAL == $this->resource->type, function ($query) {
                $query->where('field_id', 76)
                    ->orWhere('field_id', 1);
            })
            ->first();

        return !empty($billing)
            ? $billing->profile->first_name.' '.$billing->profile->last_name
            : '';
    }
}
