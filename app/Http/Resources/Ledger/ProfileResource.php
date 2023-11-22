<?php

declare(strict_types=1);

namespace App\Http\Resources\Ledger;

use Illuminate\Http\Resources\Json\JsonResource;

final class ProfileResource extends JsonResource
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
            'first_name' => $this->resource->first_name ?? '',
            'last_name' => $this->resource->last_name ?? '',
            'dob' => $this->resource->date_of_birth ?? '',
            'ssn' => $this->resource->ssn ?? '',
        ];
    }
}

