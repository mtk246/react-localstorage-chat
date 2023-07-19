<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;

final class CompanyPublicResource extends JsonResource
{
    /** @return array<key, string> */
    public function toArray($request): array
    {
        $address = array_first($this->resource['api']->addresses, function ($address) {
            return 'MAILING' == $address->address_purpose;
        });

        return [
            'id' => $this->resource['data']->id,
            'code' => $this->resource['data']->code,
            'name' => $this->resource['data']->name,
            'npi' => $this->resource['data']->npi,
            'ein' => $this->resource['data']->ein,
            'clia' => $this->resource['data']->clia ?? '',
            'other_name' => $this->resource['data']->other_name ?? '',
            'created_at' => $this->resource['data']->created_at,
            'updated_at' => $this->resource['data']->updated_at,
            'public_note' => $this->resource['data']->publicNote?->note ?? '',
            'last_modified' => $this->resource['data']->last_modified,

            'taxonomies' => TaxonomiesResource::collection($this->resource['data']->taxonomies),
            'contact' => $this->getContact($address),
            'address' => $this->getAddress($address),
        ];
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
