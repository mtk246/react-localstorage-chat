<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class DenialRefileWrapper extends CastsRequest
{
    public function getData(): array
    {
        $refileData = [
            'refile_id' => $this->get('refile_id') ?? null,
            'refile_type' => $this->get('refile_type'),
            'policy_id' => (string) $this->get('policy_id'),
            'is_cross_over' => $this->get('is_cross_over'),
            'cross_over_date' => $this->get('cross_over_date'),
            'note' => $this->get('note'),
            'original_claim_id' => $this->get('original_claim_id'),
            'refile_reason' => $this->get('refile_reason'),
            'claim_id' => $this->get('claim_id'),
        ];

        return [
            'denial_refile_data' => $refileData,
        ];
    }
}
