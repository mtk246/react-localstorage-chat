<?php

declare(strict_types=1);

namespace App\Http\Resources\Ledger;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimServiceResource extends JsonResource
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
            'claim_service_id' => $this->resource->claim_service_id,
            'procedure_id' => $this->resource->procedure_id,
            'modifier_ids' => $this->resource->modifier_ids,
            'diagnostic_pointers' => $this->resource->diagnostic_pointers,
            'from_service' => $this->resource->from_service,
            'to_service' => $this->resource->to_service,
            'price' => $this->resource->price,
            'total_charge' => $this->resource->total_charge,
            'copay' => $this->resource->copay,
            'revenue_code_id' => $this->resource->revenue_code_id,
            'place_of_service_id' => $this->resource->place_of_service_id,
            'type_of_service_id' => $this->resource->type_of_service_id,
            'days_or_units' => $this->resource->days_or_units,
            'emg' => $this->resource->emg,
            'epsdt_id' => $this->resource->epsdt_id,
            'family_planning_id' => $this->resource->family_planning_id,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'modifiers' => $this->resource->modifiers,
        ];
    }
}
