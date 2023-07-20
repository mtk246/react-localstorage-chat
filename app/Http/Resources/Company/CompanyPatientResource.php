<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\UpdatePatientRequest;
use App\Models\BillingCompany;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property $resource
 * @property UpdatePatientRequest $request
 */
final class CompanyPatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->pivot->id,
            'patient_id' => $this->resource->pivot->patient_id,
            'patient' => (isset($this->resource->user->profile))
                ? [
                    'id' => $this->resource->pivot->patient_id,
                    'name' => $this->resource->code.' - '.
                        $this->resource->user->profile->first_name.' '.
                        substr($this->resource->user->profile->middle_name, 0, 1).' '.
                        $this->resource->user->profile->last_name,
                ]
                : null,
            'med_num' => $this->resource->pivot->med_num ?? '',
            'billing_company_id' => $this->resource->pivot->billing_company_id,
            'billing_company' => (isset($this->resource->pivot->billing_company_id))
                ? [
                    'id' => $this->resource->pivot->billing_company_id,
                    'name' => BillingCompany::find($this->resource->pivot->billing_company_id)->value('name'),
                ]
                : null,
        ];
    }
}
