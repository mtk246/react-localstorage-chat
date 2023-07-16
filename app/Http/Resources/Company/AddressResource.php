<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\Address;

/** @property Address $resource */
final class AddressResource extends RequestWrapedResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
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
