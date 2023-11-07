<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Models\Claims\ClaimCheckStatus;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimSubStatus;
use App\Models\TypeForm;
use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimBodyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_company' => $this->billingCompany,
            'billing_provider' => $this->getBillingProvider(),
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
            'status' => $this->getStatus(),
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

    private function getStatusMap(): array
    {
        $newStatuses = [];
        $statusDefaultOrder = ['Draft', 'Not submitted', 'Submitted', 'Approved', 'Complete'];
        $statusColors = [
            'Draft' => '#808080',
            'Not submitted' => '#FEA54C',
            'Submitted' => '#FFE18D',
            'Approved' => '#87F8BA',
            'Complete' => '#87F8BA',
            'Rejected' => '#FC8989',
            'Denied' => '#FC8989',
        ];

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
            foreach (array_reverse($statusDefaultOrder, true) as $value) {
                $status = ClaimStatus::whereStatus($value)->first();
                array_push($newStatuses, [
                    'status' => $status->status ?? '',
                    'active' => false,
                    'status_background_color' => $statusColors[$status->status] ?? '',
                    'status_font_color' => $status->font_color ?? '',
                ]);
            }
        }

        return array_merge($newStatuses, $records);
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
                        'follow_up_date' => $check->follow_up_date ?? '',
                        'department_responsibility_id' => $check->department_responsibility_id ?? '',
                        'department_responsibility' => isset($check->department_responsibility_id)
                            ? [
                                'id' => $check->department_responsibility_id ?? '',
                                'name' => $check->department_responsibility_id->getName() ?? '',
                            ]
                            : null,
                        'insurance_policy_id' => $check->insurance_policy_id ?? '',
                        'insurance_policy' => isset($check->insurancePolicy)
                            ? [
                                'id' => $check->insurance_policy_id,
                                'policy_number' => $check->insurancePolicy->policy_number ?? '',
                                'type_responsibility' => $check->insurancePolicy->typeResponsibility->code ?? '',
                            ]
                            : null,
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
                    'status' => $status->claimStatus->status.' - '.$subNote['status'],
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
            $claimResponse = json_decode($this->claimTransmissionResponses()
                ->whereDate('created_at', '>=', $status->created_at)
                ->orderBy('created_at', 'asc')
                ->first()?->response_details ?? '')?->response;
            $moreinfo = isset($claimResponse->status) && ('SUCCESS' !== $claimResponse->status)
                ? $claimResponse?->errors ?? $claimResponse
                : $claimResponse?->errors ?? '';

            if ('Rejected' === $status->claimStatus->status) {
                $fields = [
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
                        'follow_up_date' => $check->follow_up_date ?? '',
                        'department_responsibility_id' => $check->department_responsibility_id ?? '',
                        'department_responsibility' => isset($check->department_responsibility_id)
                            ? [
                                'id' => $check->department_responsibility_id ?? '',
                                'name' => $check->department_responsibility_id->getName() ?? '',
                            ]
                            : null,
                        'insurance_policy_id' => $check->insurance_policy_id ?? '',
                        'insurance_policy' => isset($check->insurancePolicy)
                            ? [
                                'id' => $check->insurance_policy_id,
                                'policy_number' => $check->insurancePolicy->policy_number ?? '',
                                'type_responsibility' => $check->insurancePolicy->typeResponsibility->code ?? '',
                            ]
                            : null,
                    ] : null,
                    'status' => $status->claimStatus->status ?? '',
                    'status_background_color' => $status->claimStatus->background_color ?? '',
                    'status_font_color' => $status->claimStatus->font_color ?? '',
                    'more_information' => is_array($moreinfo)
                        ? array_map(function ($info) {
                            $index = strpos($info->description ?? '', "\n");
                            $shortDescription = ($index > 0) ? substr($info->description ?? '', 0, $index) : $info->description ?? '';

                            return [
                                'field' => $info->field ?? '',
                                'short_description' => $shortDescription ?? '',
                                'description' => $info->description ?? '',
                            ];
                        }, $moreinfo)
                        : $moreinfo,
                ];
            } else {
                $fields = [
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
                        'follow_up_date' => $check->follow_up_date ?? '',
                        'department_responsibility_id' => $check->department_responsibility_id ?? '',
                        'department_responsibility' => isset($check->department_responsibility_id)
                            ? [
                                'id' => $check->department_responsibility_id ?? '',
                                'name' => $check->department_responsibility_id->getName() ?? '',
                            ]
                            : null,
                        'insurance_policy_id' => $check->insurance_policy_id ?? '',
                        'insurance_policy' => isset($check->insurancePolicy)
                            ? [
                                'id' => $check->insurance_policy_id,
                                'policy_number' => $check->insurancePolicy->policy_number ?? '',
                                'type_responsibility' => $check->insurancePolicy->typeResponsibility->code ?? '',
                            ]
                            : null,
                    ] : null,
                    'status' => $status->claimStatus->status ?? '',
                    'status_background_color' => $status->claimStatus->background_color ?? '',
                    'status_font_color' => $status->claimStatus->font_color ?? '',
                ];
            }
            array_push(
                $records,
                $fields
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
