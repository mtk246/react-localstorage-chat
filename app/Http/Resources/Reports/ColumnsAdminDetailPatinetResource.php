<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

final class ColumnsAdminDetailPatinetResource extends JsonResource
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
            'name' => $this->resource->value,
            'value' => $this->resource->value,
            'type' => $this->resource->getType(),
            'align' => $this->resource->getAlign(),
            'text' => $this->resource->getText(),
            'width' => $this->resource->getWidth(),
        ];
    }
}
