<?php

declare(strict_types=1);

namespace App\Http\Resources\Diagnoses;

use App\Enums\Diagnoses\DiagnosesType;
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
        $data = parent::toArray($this->resource);
        $data['discriminatory'] = $this->resource->discriminatory;

        $id = isset($this->type->value) ? $this->type->value : $this->type;
        $enum = DiagnosesType::tryFrom((int) $id);

        $data['type'] = [
            'id' => $enum->value,
            'name' => $enum->name,
        ];

        return $data;
    }
}
