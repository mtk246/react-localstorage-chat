<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class CheckStatusRequestWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'response_details' => $this->get('response_details'),
            'interface_type' => $this->get('interface_type'),
            'interface' => $this->get('interface'),
            'consultation_date' => $this->get('consultation_date'),
            'resolution_time' => $this->get('resolution_time'),
            'past_due_date' => $this->get('past_due_date'),
            'follow_up_date' => $this->get('follow_up_date'),
            'department_responsibility' => $this->get('department_responsibility'),
            'insurance_policy_id' => $this->get('insurance_policy_id'),
        ];
    }

    public function getPrivateNote(): string
    {
        return $this->get('private_note');
    }
}
