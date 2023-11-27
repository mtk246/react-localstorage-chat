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
            'name' => $this->resource->value,
            'field' => $this->resource->value,
            'align' => $this->resource->getAlign(),
            'sortable' => true,
            'label' => $this->resource->getText(),
            'type' => $this->resource->getType(),
        ];
    }
}
