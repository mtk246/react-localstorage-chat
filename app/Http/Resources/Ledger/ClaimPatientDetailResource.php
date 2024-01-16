<?php

declare(strict_types=1);

namespace App\Http\Resources\Ledger;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimPatientDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'medical_number' => $this->resource->companies->pluck('pivot.med_num') ?? null,
            'patient_number' => $this->resource->code ?? null,
            'profile' => ProfileResource::make($this->resource->profile),
            'claims' => $this->getClaimsData()
        ];
    }

    private function getClaimsData()
    {
        $claimsDemographics = $this->resource->claimDemographics()->orderBy('created_at', 'desc')->get();

        if (request()->has('status')) {
            $claimsDemographics = $this->resource->claimDemographics->filter(function ($claimDemographic) {
                return $claimDemographic->claim->claimStatusClaims->first()->claim_status_id === request()->status;
            });
        }

        return ClaimDetailResource::collection($claimsDemographics);
    }
}
