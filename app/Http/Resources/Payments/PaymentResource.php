<?php

declare(strict_types=1);

namespace App\Http\Resources\Payments;

use App\Models\Payments\Payment;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Payment $resource */
final class PaymentResource extends JsonResource
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
            'order' => $this->resource->order,
            'source' => $this->resource->source,
            'payment_date' => $this->resource->payment_date,
            'total_amount' => $this->resource->total_amount->formatByDecimal(),
            'payment_method' => $this->resource->payment_method,
            'reference' => $this->resource->reference,
            'card_number' => $this->resource->card?->card_number,
            'expiration_date' => $this->resource->card?->expiration_date,
            'statement' => $this->resource->statement,
            'note' => $this->resource->note,
            'eobs' => new EobResource($this->resource->eobs),
            'insurance_plan' => $this->resource->insurancePlan,
            'insurance_company' => $this->resource->insurancePlan?->insuranceCompany,
            'claims' => ClaimResource::collection($this->resource->claims),
        ];
    }
}
