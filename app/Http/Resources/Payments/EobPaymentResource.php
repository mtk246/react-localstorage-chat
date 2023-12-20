<?php

declare(strict_types=1);

namespace App\Http\Resources\Payments;

use App\Models\Payments\Eob;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Eob $resource */
final class EobPaymentResource extends JsonResource
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
            'name' => $this->resource->name,
            'date' => $this->resource->date,
            'file_name' => $this->resource->file_name,
            'file_url' => $this->resource->file_url,
            'payment_id' => $this->resource->payment_id,
            'payment_amount' => $this->resource->payment->total_amount->formatByDecimal(),
            'payment_reference' => $this->resource->payment->reference,
            'payment_order' => $this->resource->payment->order,
            'insurance_plan_name' => $this->resource->payment->insurancePlan->name,
        ];
    }
}
