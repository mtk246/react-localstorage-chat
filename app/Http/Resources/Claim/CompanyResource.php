<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Http\Resources\Company\TaxonomiesResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Company $resource */
final class CompanyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'npi' => $this->resource->npi,
            'company_name' => $this->resource->name,
            'code' => $this->resource->code,
            'ein' => $this->resource->ein,
            'taxonomies' => TaxonomiesResource::collection(
                $this->resource->taxonomies()->orderBy('id')->get()
            ),
        ];
    }
}
