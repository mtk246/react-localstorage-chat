<?php

declare(strict_types=1);

namespace App\Http\Resources\Facility;

use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Company $resource */
final class CompanyResource extends JsonResource
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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
