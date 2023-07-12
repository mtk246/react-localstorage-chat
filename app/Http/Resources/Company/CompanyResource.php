<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Facades\Pagination;
use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/** @property Company $resource */
final class CompanyResource extends JsonResource
{
    /** @return array<key, string> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'npi' => $this->resource->npi,
            'ein' => $this->resource->ein,
            'upin' => $this->resource->upin,
            'clia' => $this->resource->clia,
            'status' => (bool) $this->resource->status,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'public_note' => $this->resource->publicNote?->note ?? null,
            'last_modified' => $this->resource->last_modified,

            'taxonomies' => TaxonomiesResource::collection($this->resource->taxonomies),
            'facilities' => $this->getFacilities(),
            'services' => ServiceResource::collection($this->resourceProcedures)->resource,
            'copays' => $copays,
            'contract_fees' => $contracFees,
            'addresses' => $this->resource->addresses,
            'contacts' => $this->resource->contacts,
        ];
    }

    private function getFacilities(): Collection
    {
        $facilities = $this->resource->facilities()
            ->when(!empty($bC), fn ($query) => $query->wherePivot('billing_company_id', $bC))
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return FacilityResource::collection($this->resource->facilities);
    }
}
