<?php

declare(strict_types=1);

namespace App\Http\Resources\Payments;

use App\Models\Payments\Eob;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Eob $resource */
final class EobResource extends JsonResource
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
            'date' => $this->resource->date,
            'file_name' => $this->resource->file_name,
            'file_url' => $this->resource->file_url,
        ];
    }
}
