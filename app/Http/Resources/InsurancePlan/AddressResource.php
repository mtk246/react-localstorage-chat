<?php

declare(strict_types=1);

namespace App\Http\Resources\InsurancePlan;

use App\Http\Resources\RequestWrapedResource;

final class AddressResource extends RequestWrapedResource
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
            'address' => $this->resource->address,
            'city' => $this->resource->city,
            'state' => $this->resource->state,
            'zip' => $this->resource->zip,
            'country' => $this->resource->country,
            'apt_suite' => $this->resource->apt_suite ?? '',
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
