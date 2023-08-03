<?php

declare(strict_types=1);

namespace App\Http\Resources\InsurancePlan;

use App\Http\Resources\RequestWrapedResource;

final class ContactResource extends RequestWrapedResource
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
            'phone' => $this->resource->phone ?? '',
            'fax' => $this->resource->fax ?? '',
            'email' => $this->resource->email,
            'mobile' => $this->resource->mobile ?? '',
            'contact_name' => $this->resource->contact_name ?? '',
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
