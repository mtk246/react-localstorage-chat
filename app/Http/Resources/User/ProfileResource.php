<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Models\Profile;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Profile $resource */
final class ProfileResource extends JsonResource
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
            'ssn' => $this->resource->ssn,
            'first_name' => $this->resource->first_name,
            'middle_name' => $this->resource->middle_name,
            'last_name' => $this->resource->last_name,
            'sex' => $this->resource->sex,
            'date_of_birth' => $this->resource->date_of_birth,
            'avatar' => $this->resource->avatar,
            'name_suffix_id' => $this->resource->name_suffix_id ?? '',
            'name_suffix' => $this->resource->nameSuffix?->code ?? '',
        ];
    }
}
