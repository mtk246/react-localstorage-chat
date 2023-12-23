<?php

declare(strict_types=1);

namespace App\Http\Resources\Payments;

use App\Http\Resources\Company\CompanyResource;
use App\Models\Payments\Batch;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Batch $resource */
final class BatchResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->resource->name,
            'posting_date' => $this->resource->posting_date,
            'currency' => $this->resource->currency,
            'amount' => $this->resource->amount->formatByDecimal(),
            'status' => $this->resource->status,
            'payments' => PaymentResource::collection($this->resource->payments->sortBy(['order', 'desc'])),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'close_at' => $this->resource->close_date,
            'company' => new CompanyResource($this->resource->company),
            'billing_company' => $this->resource->billingCompany,
        ];
    }
}
