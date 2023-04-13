<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use App\Enums\Reports\ReportType;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ReportType $resource */
final class ReportTypeResource extends JsonResource
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
            'id' => $this->resource->value,
            'url' => $this->resource->getUrl(),
            'name' => $this->resource->getDescription(),
        ];
    }
}
