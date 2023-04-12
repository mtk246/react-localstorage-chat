<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use App\Models\Reports\Report;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Report $resource */
final class ReportResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'use' => $this->resource->use,
            'description' => $this->resource->description,
            'type' => $this->resource->type->value,
            'range' => $this->resource->range,
            'begin_date' => now()->subDay($this->resource->range->format('D')),
            'end_date' => now(),
            'tags' => $this->resource->tags,
            'configuration' => $this->resource->configuration,
            'favorite' => $this->resource->favorite,
        ];
    }
}
