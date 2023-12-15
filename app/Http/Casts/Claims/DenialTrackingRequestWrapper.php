<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class DenialTrackingRequestWrapper extends CastsRequest
{
    public function getStatus(): int
    {
        return $this->getInt('claim_status');
    }

    public function getSubStatus(): ?int
    {
        return $this->getInt('claim_sub_status');
    }

    public function getTrackingNote(): ?string
    {
        return $this->get('tracking_note');
    }

    public function getData(): array
    {
        return [
            'interface_type' => $this->getInt('interface_type'),
            'is_reprocess_claim' => $this->getBool('is_reprocess_claim'),
            'is_contact_to_patient' => $this->getBool('is_contact_to_patient'),
            'contact_through' => $this->get('contact_through'),
            'claim_number' => $this->get('claim_number'),
            'rep_name' => $this->get('rep_name'),
            'ref_number' => $this->get('ref_number'),
            'claim_status' => $this->get('claim_status'),
            'claim_sub_status' => $this->getInt('claim_sub_status'),
            'tracking_date' => $this->get('tracking_date'),
            'resolution_time' => $this->get('resolution_time'),
            'past_due_date' => $this->get('past_due_date'),
            'follow_up' => $this->get('follow_up'),
            'department_responsible' => $this->get('department_responsible'),
            'policy_responsible' => $this->get('policy_responsible'),
            'response_details' => $this->get('response_details'),
            'policy_id' => $this->get('policy_id'),
        ];
    }
}
