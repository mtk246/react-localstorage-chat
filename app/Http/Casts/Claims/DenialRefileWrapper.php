<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use App\Models\Claims\Claim;
use App\Models\Claims\DenialRefile;

final class DenialRefileWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'refile_type' => $this->get('refile_type'),
            'policy_id' => (string) $this->get('policy_id'),
            'is_cross_over' => $this->get('is_cross_over'),
            'cross_over_date' => $this->get('cross_over_date'),
            'note' => $this->get('note'),
            'original_claim_id' => $this->get('original_claim_id'),
            'refile_reason' => $this->get('refile_reason'),
            'claim_id' => $this->get('claim_id'),
        ];
    }

    public function getClaim(): Claim
    {
        return Claim::find($this->get('claim_id'));
    }

    public function getRefile(): ?DenialRefile
    {
        return DenialRefile::find($this->get('refile_id'));
    }
}
