<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

final class PatientInformationResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'admission_date' => $this->resource->admission_date,
            'admission_time' => $this->resource->admission_time,
            'discharge_date' => $this->resource->discharge_date,
            'discharge_time' => $this->resource->discharge_time,
            'condition_code_ids' => $this->resource->condition_code_ids,
            'condition_codes' => $this->resource->condition_codes,
            'admission_type_id' => (int) $this->resource->admission_type_id,
            'admission_source_id' => (int) $this->resource->admission_source_id,
            'patient_status_id' => (int) $this->resource->patient_status_id,
            'bill_classification_id' => (int) $this->resource->bill_classification_id,
        ];
    }
}
