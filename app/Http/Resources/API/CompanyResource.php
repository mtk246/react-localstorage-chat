<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

final class CompanyResource extends JsonResource
{
    /** @return array<key, string> */
    public function toArray($request): array
    {
        $address = array_first($this->resource->addresses, function ($address) {
            return 'MAILING' == $address->address_purpose;
        });

        return [
            'id' => '',
            'code' => '',
            'name' => $this->getOrganizationName(),
            'npi' => $this->resource->number ?? '',
            'ein' => '',
            'clia' => '',
            'other_name' => $this->getOtherName(),

            'taxonomies' => TaxonomiesResource::collection($this->resource->taxonomies),
            'contact' => $this->getContact($address),
            'address' => $this->getAddress($address),
        ];
    }

    private function getOrganizationName(): string
    {
        $other_name = $this->resource->other_names[0]?->organization_name ?? null;

        return $other_name ?? $this->resource->basic->organization_name;
    }

    private function getOtherName(): string
    {
        $other_name = $this->resource->other_names[0]?->organization_name ?? null;

        return !empty($other_name) ? $this->resource->basic->organization_name : '';
    }

    private function getContact($data): array
    {
        return [
            'phone' => str_replace('-', '', $data?->telephone_number ?? ''),
            'fax' => str_replace('-', '', $data?->fax_number ?? ''),
            'email' => '',
            'mobile' => '',
            'contact_name' => '',
        ];
    }

    private function getAddress($data): array
    {
        return [
            'address' => $data?->address_1 ?? '',
            'city' => $data?->city ?? '',
            'state' => $data?->state ?? '',
            'zip' => $data?->postal_code ?? '',
            'country' => $data?->country_code ?? '',
            'apt_suite' => '',
        ];
    }
}
