<?php

declare(strict_types=1);

namespace App\Http\Resources\Diagnoses;

use Illuminate\Http\Resources\Json\JsonResource;

final class DiagnosesResource extends JsonResource
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
        $data['discriminatory'] = $this->resource->discriminatory;
        $data['type'] = [
            'id' => $this->type->value,
            'name' => $this->type->getName(),
        ];

        return array_merge(parent::toArray($this->resource), $data);
    }
}
