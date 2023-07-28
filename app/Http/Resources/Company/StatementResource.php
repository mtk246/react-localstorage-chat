<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\StoreStatementRequestCast;
use App\Models\CompanyStatement;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property CompanyStatement $resource
 * @property StoreStatementRequestCast $request
 */
final class StatementResource extends JsonResource
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
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_company' => $this->resource->billingCompany->name ?? '',
            'rule_id' => $this->resource->rule_id,
            'rule' => $this->resource->rule->description ?? '',
            'when_id' => $this->resource->when_id,
            'when' => $this->resource->when->description ?? '',
            'start_date' => $this->resource->start_date,
            'end_date' => $this->resource->end_date,
            'apply_to_ids' => $this->resource->apply_to_ids,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
