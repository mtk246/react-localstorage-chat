<?php

declare(strict_types=1);

namespace App\Http\Resources\Diagnoses;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\Diagnoses\DiagnosesType;
use App\Casts\Enum\ColorTypeCast;

final class DiagnosesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $id = isset($this->type->value) ? $this->type->value : $this->type;
        $enum = DiagnosesType::tryFrom((int)$id);

        $data['type'] = [
            'id' => $enum->value,
            'name' => $enum->name
        ];

        return $data;
       
    }
}
