<?php

declare(strict_types=1);

namespace App\Http\Resources\Ledger;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimDetailResource extends JsonResource
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
            'id' => $this->resource->claim->id,
            'code' => $this->resource->claim->code,
            'submiter_name' => $this->resource->claim->submiter_name,
            'created_at' => $this->resource->claim->created_at,
            'status' => $this->resource->claim->claimStatusClaims->first()->claimStatus,
            'privateNote' => $this->resource->claim->private_note,
            'billed_amount' => $this->resource->claim->billed_amount,
            'amount_paid' => $this->resource->claim->amount_paid,
            'past_due_date' => $this->resource->claim->past_due_date,
            'date_of_service' => $this->resource->claim->date_of_service,
            'user_created' => $this->resource->claim->user_created,
            'charge' => $this->resource->claim->billed_amount, // charge field in claim_demographic_information model
            'services' => ClaimServiceResource::collection($this->resource->claim->service->services),
            'health_professional' => $this->resource->healthProfessionals->first(),
            'insurance_policies' => $this->resource->claim->insurancePolicies->first()->insurancePlan,
        ];
    }
}
