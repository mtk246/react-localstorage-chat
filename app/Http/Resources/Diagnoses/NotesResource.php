<?php

declare(strict_types=1);

namespace App\Http\Resources\Diagnoses;

use Illuminate\Http\Resources\Json\JsonResource;

final class NotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'public_note' => $this->publicNote()->first(['note'])->note,
        ];
    }
}
