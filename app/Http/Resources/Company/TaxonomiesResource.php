<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\UpdateCompanyRequestCast;
use App\Http\Resources\RequestWrapedResource;
use App\Models\Taxonomy;

/** @property Taxonomy $resource */
final class TaxonomiesResource extends RequestWrapedResource
{
    /**
     * Transform the resource into an array.
     *
     * @param UpdateCompanyRequestCast $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'tax_id' => $this->resource->tax_id,
            'name' => $this->resource->name,
            'primary' => $this->resource->pivot->primary ?? false,
            'created_at' => $this->resource->pivot->created_at,
            'updated_at' => $this->resource->pivot->updated_at,
        ];
    }
}
