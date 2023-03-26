<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\UpdateContactDataRequestCast;
use App\Http\Resources\RequestWrapedResource;
use App\Models\Company;

/**
 * @property Company $resource
 * @property UpdateContactDataRequestCast $request
 */
final class ContactDataResource extends RequestWrapedResource
{
    /**
     * @param UpdateContactDataRequestCast $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'contact' => new ContactResource($this->resource->contacts()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first(), $request),
            'address' => new AddressResource($this->resource->addresses()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->where('address_type_id', 1)
                ->first(), $request),
            'payment_address' => new AddressResource($this->resource->addresses()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->where('address_type_id', 3)
                ->first(), $request),
        ];
    }
}
