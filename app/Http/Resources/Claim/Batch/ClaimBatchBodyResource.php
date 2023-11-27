<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim\Batch;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimBatchBodyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'type' => $this->resource->claims->first()?->type->value,
            'claim_type' => upperCaseWords($this->resource->claims->first()?->type->getName()),
            'claim_batch_status' => $this->resource->claimBatchStatus,
            'claim_batch_status_id' => $this->resource->claim_batch_status_id,
            'shipping_date' => $this->resource->shipping_date,
            'fake_transmission' => $this->resource->fake_transmission,
            'company_id' => $this->resource->company_id,
            'billing_company_id' => $this->resource->billing_company_id,
            'claims_reconciled' => $this->resource->claims_reconciled,
            'total_processed' => $this->resource->total_processed,
            'claim_ids' => $this->resource->claim_ids,
            'total_claims' => $this->resource->total_claims,
            'total_accepted' => $this->resource->total_accepted,
            'total_denied' => $this->resource->total_denied,
            'total_accepted_by_clearing_house' => $this->resource->total_accepted_by_clearing_house,
            'total_denied_by_clearing_house' => $this->resource->total_denied_by_clearing_house,
            'total_accepted_by_payer' => $this->resource->total_accepted_by_payer,
            'total_denied_by_payer' => $this->resource->total_denied_by_payer,
            'company' => isset($this->resource->company)
                ? [
                    'id' => $this->resource->company->id,
                    'npi' => $this->resource->company->npi,
                    'name' => $this->resource->company->name,
                    'abbreviation' => $this->resource->company
                        ->abbreviations()
                        ->where('billing_company_id', $this->resource->billing_company_id)
                        ->first()?->abbreviation ?? '',
                ] : null,
            'claims' => $this->resource->claims,
            'billing_company' => [
                'id' => $this->resource->billingCompany->id,
                'name' => $this->resource->billingCompany->name,
                'created_at' => $this->resource->billingCompany->created_at,
                'updated_at' => $this->resource->billingCompany->updated_at,
                'code' => $this->resource->billingCompany->code,
                'status' => $this->resource->billingCompany->status,
                'logo' => $this->resource->billingCompany->logo,
                'abbreviation' => $this->resource->billingCompany->abbreviation,
            ],
            'last_modified' => $this->resource->last_modified,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
