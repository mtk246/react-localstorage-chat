<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\ClaimStatusMap;
use App\Enums\InterfaceType;
use App\Http\Resources\HealthProfessional\HealthProfessionalResource;
use App\Http\Resources\Payments\EobResource;
use App\Http\Resources\Payments\PaymentResource;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimSubStatus;
use App\Models\Claims\DenialRefile;
use App\Models\Claims\DenialTracking;
use App\Models\Payments\Eob;
use App\Models\RefileReason;
use App\Models\TypeForm;
use Illuminate\Http\Resources\Json\JsonResource;

final class DenialBodyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $data = $this->getStatus();
        $subStatus = $this->resource->subStatus()
            ->orderBy('claim_status_claim.id', 'desc')
            ->first()
            ?->setHidden(['pivot']);
        $subStatuses = ClaimSubStatus::query()
            ->whereHas('claimStatuses', function ($query) use ($data) {
                $query->where('claim_status_id', $data->id ?? null);
            })
            ->get()
            ->setVisible(['id', 'name'])
            ->toArray() ?? [];

        $eobs = Eob::with('payment', 'claimBatches')->where('payment_id', $this->resource->id)->get();

        $eobDetails = $eobs->map(function ($eob) {
            return [
                'eob' => EobResource::make($eob),
                'payment' => PaymentResource::make($eob->payment),
                'claimBatch' => json_decode(json_encode($eob->claimBatches->first()), false),
            ];
        });

        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_company' => $this->billingCompany,
            'billing_provider' => $this->getBillingProvider(),
            'transmission_count' => $this->claimTransmissionResponses->count(),
            'company_information' => new CompanyResource(
                $this->resource->demographicInformation->company
            ),
            'facility_information' => new FacilityResource(
                $this->resource->demographicInformation->facility
            ),
            'health_professional_information' => HealthProfessionalResource::collection(
                $this->resource->demographicInformation->healthProfessionals
            ),
            'code' => $this->resource->code,
            'type' => $this->resource->type->value,
            'claim_type' => upperCaseWords($this->resource->type->getName()),
            'claim_format' => TypeForm::find($this->resource->type->value)?->form ?? '',
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
            'status' => $data,
            'sub_status' => $subStatus,
            'sub_statuses' => $subStatuses,
            'status_map' => $this->getStatusMap(),
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
            'denial_trackings' => $this->resource->getDenialTrackings(),
            'claim_number' => $this->getDenialTrackings()->last()->claim_number ?? '',
            'follow_up' => $this->resource->getDenialTrackings()->last()->follow_up ?? '',
            'denial_trackings_detail' => $this->getDenialTrackingsDetailsMap(),
            'denial_refile' => $this->resource->getDenialRefile(),
            'denial_refile_detail' => $this->getDenialRefileDetailsMap(),
            'refile_reasons' => $this->getRefileReasons(),
            'eob_details' => $eobDetails,
        ];
    }

    public function getStatus(): ClaimStatus|array
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

    private function getStatusMap(): array
    {
        $newStatuses = [];

        foreach (ClaimStatusMap::cases() as $status) {
            if ($status->getPublic()) {
                $statusDefaultOrder[] = $status->value;
            }
            $statusColors[$status->value] = $status->getColor();
        }

        $this->claimStatusClaims()
            ->where('claim_status_type', ClaimStatus::class)
            ->orderBy('id', 'asc')
            ->get()
            ->reduce(function ($carry, $claimStatusClaim) use (&$statusDefaultOrder) {
                if (0 === count($statusDefaultOrder)) {
                    return;
                }
                $statusName = $claimStatusClaim?->claimStatus?->status ?? '';
                if (!empty($statusName)) {
                    if ($statusName !== $statusDefaultOrder[0]
                        && 'Draft' === $statusDefaultOrder[0]) {
                        array_shift($statusDefaultOrder);
                    }
                    if ($statusName === $statusDefaultOrder[0]) {
                        array_shift($statusDefaultOrder);
                    } else {
                        $statusDefaultOrder = [];
                    }
                }
            }, []);

        $records = [];
        $active = true;
        $substatus = '';
        $history = $this->claimStatusClaims()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')
                        ->get() ?? [];
        foreach ($history as $status) {
            if (ClaimSubStatus::class == $status->claim_status_type && '' === $substatus) {
                $substatus = $status->claimStatus->name ?? '';
            } elseif (ClaimStatus::class == $status->claim_status_type) {
                $name = (empty($substatus))
                    ? $status->claimStatus->status
                    : $status->claimStatus->status.' - '.$substatus;
                array_push($records, [
                    'status' => $name,
                    'active' => $active,
                    'status_background_color' => $statusColors[$status->claimStatus->status] ?? '',
                    'status_font_color' => $status->claimStatus->font_color ?? '',
                ]);

                $substatus = '';

                if ($active) {
                    $active = false;
                }
            }
        }
        if (count($statusDefaultOrder) > 0) {
            foreach ($statusDefaultOrder as $value) {
                $status = ClaimStatus::whereStatus($value)->first();
                array_push($newStatuses, [
                    'status' => $status->status ?? '',
                    'active' => false,
                    'status_background_color' => $statusColors[$status->status] ?? '',
                    'status_font_color' => $status->font_color ?? '',
                ]);
            }
        }

        return array_merge(array_reverse($records, true), $newStatuses);
    }

    private function getDenialTrackingsDetailsMap(): array
    {
        $records = [
            'interface_type' => [
                InterfaceType::CALL => 0,
                InterfaceType::WEBSITE => 1,
                InterfaceType::EMAIL => 2,
                InterfaceType::OTHER => 3,
            ],
        ];

        return $records;
    }

    private function getDenialRefileDetailsMap(): array
    {
        $records = [
            'refile_type' => [
                InterfaceType::SECONDARY_INSURANCE => 0,
                InterfaceType::CORRECTED_CLAIMS => 1,
                InterfaceType::REFILE_ANOTHER_REASONS => 2,
            ],
        ];

        return $records;
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
            $denialTracking = DenialTracking::query()
                ->where('private_note_id', $note->id)
                ->first();

            array_push(
                $notes,
                [
                    'note' => $note->note,
                    'created_at' => $note->created_at,
                    'last_modified' => $note->last_modified,
                    'denial_tracking' => isset($denialTracking)
                        ? [
                            'interface_type' => $denialTracking->interface_type ?? '',
                            'is_reprocess_claim' => $denialTracking->is_reprocess_claim ?? '',
                            'is_contact_to_patient' => $denialTracking->is_contact_to_patient ?? '',
                            'contact_through' => $denialTracking->contact_through ?? '',
                            'claim_number' => $denialTracking->claim_number ?? '',
                            'rep_name' => $denialTracking->rep_name ?? '',
                            'ref_number' => $denialTracking->ref_number ?? '',
                            'claim_status' => isset($denialTracking->claimStatus)
                                ? [
                                    'id' => $denialTracking->claimStatus->id,
                                    'status' => $denialTracking->claimStatus->status ?? '',
                                ]
                                : null,
                            'claim_sub_status' => isset($denialTracking->claimSubStatus)
                            ? [
                                'id' => $denialTracking->claimSubStatus->id,
                                'status' => $denialTracking->claimSubStatus->name ?? '',
                            ]
                            : null,
                            'tracking_date' => $denialTracking->tracking_date ?? '',
                            'resolution_time' => $denialTracking->resolution_time ?? '',
                            'past_due_date' => $denialTracking->past_due_date ?? '',
                            'follow_up' => $denialTracking->follow_up ?? '',
                            'department_responsible' => $denialTracking->department_responsible ?? '',
                            'policy_responsible' => $denialTracking->policy_responsible ?? '',
                            'response_details' => $denialTracking->response_details ?? null,
                            'tracking_note' => $denialTracking->privateNote->note ?? '',
                            'claim_id' => $denialTracking->claim_id ?? '',
                        ]
                        : null,
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
            $insurancePolicyInfo = $this->getInsurancePolicyInfo($note);

            array_push(
                $recordSubstatus,
                [
                    'id' => $note->id,
                    'status' => $status->claimStatus->name ?? '',
                    'note' => $note->note,
                    'created_at' => $note->created_at,
                    'last_modified' => $note->last_modified,
                    'policy_id' => $insurancePolicyInfo['policy_id'] ?? '',
                    'policy_number' => $insurancePolicyInfo['policy_number'] ?? '',
                ]
            );
        }
    }

    private function setNote($status, &$records, &$recordSubstatus): void
    {
        $status->load('claimStatus', 'privateNotes');

        $statusData = [
            'status' => optional($status->claimStatus)->status ?? '',
            'status_background_color' => $status->claimStatus->background_color ?? '',
            'status_font_color' => $status->claimStatus->font_color ?? '',
        ];

        foreach ($recordSubstatus as $subNote) {
            $insurancePolicyInfo = $this->getInsurancePolicyInfo($subNote);

            $denialTracking = DenialTracking::query()
                ->with('insurancePolicy:id,policy_number')
                ->where('private_note_id', $subNote['id'] ?? null)
                ->orderBy('created_at', 'desc')
                ->first();

            $denialRefile = DenialRefile::with('insurancePolicy', 'privateNotes', 'refileReason')
                ->whereIn('claim_id', [$status->claim_id])
                ->where('private_note_id', $subNote['id'] ?? null)
                ->orderBy('created_at', 'desc')
                ->first();

            $statusData['denial_tracking'] = isset($denialTracking) ? [
                'interface_type' => $denialTracking->interface_type ?? '',
                'is_reprocess_claim' => $denialTracking->is_reprocess_claim ?? '',
                'is_contact_to_patient' => $denialTracking->is_contact_to_patient ?? '',
                'contact_through' => $denialTracking->contact_through ?? '',
                'claim_number' => $denialTracking->claim_number ?? '',
                'rep_name' => $denialTracking->rep_name ?? '',
                'ref_number' => $denialTracking->ref_number ?? '',
                'claim_status' => isset($denialTracking->claimStatus) ? [
                    'id' => $denialTracking->claimStatus->id,
                    'status' => $denialTracking->claimStatus->status ?? '',
                ] : null,
                'claim_sub_status' => isset($denialTracking->claimSubStatus) ? [
                    'id' => $denialTracking->claimSubStatus->id,
                    'status' => $denialTracking->claimSubStatus->name ?? '',
                ] : null,
                'tracking_date' => $denialTracking->tracking_date ?? '',
                'resolution_time' => $denialTracking->resolution_time ?? '',
                'past_due_date' => $denialTracking->past_due_date ?? '',
                'follow_up' => $denialTracking->follow_up ?? '',
                'department_responsible' => $denialTracking->department_responsible ?? '',
                'policy_responsible' => $denialTracking->policy_responsible ?? '',
                'response_details' => $denialTracking->response_details ?? null,
                'tracking_note' => $denialTracking->privateNote->note ?? '',
                'claim_id' => $denialTracking->claim_id ?? '',
                'policy_id' => $insurancePolicyInfo['policy_id'] ?? '',
                'policy_number' => $insurancePolicyInfo['policy_number'] ?? '',
            ] : null;

            $statusData['denial_refile'] = isset($denialRefile) ? [
                'policy_id' => $insurancePolicyInfo['policy_id'] ?? '',
                'policy_number' => $insurancePolicyInfo['policy_number'] ?? '',
                'refile_type' => $denialRefile->refile_type ?? '',
                'is_cross_over' => $denialRefile->is_cross_over ?? '',
                'cross_over_date' => $denialRefile->cross_over_date ?? '',
                'original_claim_id' => $denialRefile->original_claim_id ?? '',
                'refile_reason' => $denialRefile->refile_reason ?? '',
                'claim_id' => $denialRefile->claim_id ?? '',
                'note' => $denialRefile->note ?? '',
            ] : null;

            array_push(
                $records,
                [
                    'id' => $subNote['id'],
                    'note' => $subNote['note'],
                    'created_at' => $subNote['created_at'],
                    'last_modified' => $subNote['last_modified'],
                    'status' => $statusData['status'].' - '.$subNote['status'],
                    'status_background_color' => $statusData['status_background_color'],
                    'status_font_color' => $statusData['status_font_color'],
                    'policy_id' => $insurancePolicyInfo['policy_id'] ?? '',
                    'policy_number' => $insurancePolicyInfo['policy_number'] ?? '',
                    'denial_tracking' => $statusData['denial_tracking'],
                    'denial_refile' => $statusData['denial_refile'],
                ]
            );
        }

        $recordSubstatus = [];
        $notes = $status->privateNotes()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get() ?? [];

        foreach ($notes as $note) {
            $insurancePolicyInfo = $this->getInsurancePolicyInfo($note);
            $denialTracking = DenialTracking::query()
                ->with('insurancePolicy:id,policy_number')
                ->where('private_note_id', $note->id ?? null)
                ->first();

            $statusData['denial_tracking'] = $denialTracking ?? null;

            $recordData = [
                'note' => $note->note,
                'created_at' => $note->created_at,
                'last_modified' => $note->last_modified,
                'status' => $statusData['status'],
                'status_background_color' => $statusData['status_background_color'],
                'status_font_color' => $statusData['status_font_color'],
                'policy_id' => $insurancePolicyInfo['policy_id'] ?? '',
                'policy_number' => $insurancePolicyInfo['policy_number'] ?? '',
                'denial_tracking' => $statusData['denial_tracking'] ?? null,
            ];

            array_push($records, $recordData);
        }
    }

    private function getInsurancePolicy(): ?array
    {
        $policyPrimary = $this->resource
            ->insurancePolicies()
            ->wherePivot('order', 1)
            ->with(['insurancePlan.insuranceCompany', 'typeResponsibility'])
            ->first();

        return [
            'insurance_company_id' => $policyPrimary?->insurancePlan?->insuranceCompany?->id ?? '',
            'insurance_company' => $policyPrimary?->insurancePlan?->insuranceCompany?->name ?? '',
            'insurance_plan_id' => $policyPrimary?->insurancePlan?->id ?? '',
            'insurance_plan' => $policyPrimary?->insurancePlan?->name ?? '',
            'type_responsibility' => $policyPrimary?->typeResponsibility?->code ?? '',
            'batch' => $policyPrimary?->batch ?? '',
            'eff_date' => $policyPrimary?->eff_date ?? '',
            'end_date' => $policyPrimary?->end_date ?? '',
            'own' => $policyPrimary?->own ?? '',
        ];
    }

    private function getBillingProvider(): ?string
    {
        $billing = $this->resource->demographicInformation?->healthProfessionals()
            ->wherePivot('field_id', 5)
            ->first();

        return !empty($billing)
            ? $billing->profile->first_name.' '.$billing->profile->last_name
            : '';
    }

    private function getRefileReasons(): ?array
    {
        $refileReasons = RefileReason::all();

        return $refileReasons->toArray();
    }

    private function getInsurancePolicyInfo($note): array
    {
        $insurancePolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)
            ->first();

        return isset($insurancePolicy) ? [
            'insurance_plan_id' => optional($insurancePolicy->insurancePlan)->id ?? '',
            'insurance_company_id' => optional($insurancePolicy->insurancePlan->insuranceCompany)->id ?? '',
            'insurance_company' => optional($insurancePolicy->insurancePlan->insuranceCompany)->name ?? '',
            'policy_id' => $insurancePolicy->id ?? '',
            'policy_number' => $insurancePolicy->policy_number ?? '',
        ] : [];
    }
}
