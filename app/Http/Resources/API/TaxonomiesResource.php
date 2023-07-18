<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use App\Models\Taxonomy;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Taxonomy $resource */
final class TaxonomiesResource extends JsonResource
{
    /** @return array<key, string> */
    public function toArray($request): array
    {
        return [
            'tax_id' => $this->resource->code ?? '',
            'name' => $this->resource->desc ?? '',
            'primary' => $this->resource->primary,
        ];
    }
}
