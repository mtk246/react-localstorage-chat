<?php

declare(strict_types=1);

namespace App\Http\Resources\Ledger;

use Illuminate\Http\Resources\Json\JsonResource;

final class PatientLedgerResource extends JsonResource
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
            'profile' => ProfileResource::make($this->resource->profile),
            'medical_number' => $this->resource->companies->pluck('pivot.med_num') ?? null,
            'patient_number' => $this->resource->code ?? null,
            'companies' => $this->getCompanies(),
        ];
    }

    private function getCompanies()
    {
        return isset($this->resource->claimDemographics)
            ? $this->resource->claimDemographics->map(function ($claimDemographic) {
                return [
                    'id' => $claimDemographic->company->id,
                    'name' => $claimDemographic->company->name,
                ];
            })
            : null;
    }
}
