<?php

declare(strict_types=1);

namespace App\Http\Resources\Payments;

use App\Models\Claims\Claim;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Claim $resource */
final class ClaimResource extends JsonResource
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
        $patient = $this->resource
                ->demographicInformation
                ->patient
                ->profile;

        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'patient' => collect([
                    $patient->last_name,
                    $patient->nameSuffix?->code,
                ])->filter()->join(' ')
                .' '.collect([
                    $patient->first_name,
                    $patient->middle_name,
                ])->filter()->join(' '),
            'insurance_plan' => $this->resource
                ->insurancePolicies()
                ->wherePivot('order', 1)
                ->first()
                ?->insurancePlan
                ?->name,
            'billed_amount' => $this->resource->billed_amount,
            'paid_amount' => $this->resource->paid_amount,
            'services' => $this->resource->service->services->map(function ($service) {
                $service->setAttribute('payment', $this->resource->payment->services->where(
                    'pivot.service_id',
                    $service->id
                )->first()?->pivot);

                return new ServiceResource($service);
            }),
        ];
    }
}
