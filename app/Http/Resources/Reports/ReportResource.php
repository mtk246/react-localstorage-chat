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
            'description' => $this->resource->description,
            'type' => $this->resource->type->value,
            'url' => $this->resource->url ?? $this->resource->clasification->getUrl(),
            'clasification' => $this->resource->clasification->value,
            'color' => [
                'background' => $this->resource->clasification->getBackgroundColor(),
                'text' => $this->resource->clasification->getTextColor(),
            ],
            'icon' => $this->resource->clasification->getIcon(),
            'range' => $this->resource->range,
            'begin_date' => now()->subDay($this->resource->range),
            'end_date' => now(),
            'configuration' => $this->resource->configuration,
            'favorite' => $this->resource->favorite,
            'tableu' => $this->resource->tableu,
        ];
    }
}
