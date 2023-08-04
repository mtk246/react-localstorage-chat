<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\Contact;

/** @property Contact $resource */
final class ContactResource extends RequestWrapedResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
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
