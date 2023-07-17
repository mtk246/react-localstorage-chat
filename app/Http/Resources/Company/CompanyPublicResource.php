<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Company $resource */
final class CompanyPublicResource extends JsonResource
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
            'clia' => $this->resource->clia ?? '',
            'other_name' => $this->resource->other_name ?? '',
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'public_note' => $this->resource->publicNote?->note ?? '',
            'last_modified' => $this->resource->last_modified,

            'taxonomies' => TaxonomiesResource::collection($this->resource->taxonomies),
        ];
    }
}
