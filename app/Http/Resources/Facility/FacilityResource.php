<?php

declare(strict_types=1);

namespace App\Http\Resources\Facility;

use App\Http\Resources\API\TaxonomiesResource as ApiTaxonomiesResource;
use App\Http\Resources\Company\TaxonomiesResource as PublicTaxonomiesResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class FacilityResource extends JsonResource
{
    // ** @return array<key, string> */
    public function toArray($request): array
    {
        $address = array_first($this->resource['api']->addresses, function ($address) {
            return 'MAILING' == $address->address_purpose;
        });

        if ( $this->resource['type'] == 'public') {
            return $this->getPublicData($address);
        }

        if ($this->resource['type'] == 'api') {
            return $this->getApiData($address);
        }
    }

    private function getPublicData($address)
    {
        return [
            'id' => $this->resource['data']->id,
            'name' => $this->resource['data']->name,
            'npi' => $this->resource['data']->npi,
            'created_at' => $this->resource['data']->created_at,
            'updated_at' => $this->resource['data']->updated_at,
            'code' => $this->resource['data']->code,
            'nppes_verified_at' => $this->resource['data']->nppes_verified_at,
            'other_name' => $this->resource['data']->other_name,
            'status' => $this->resource['data']->status,
            'last_modified' => $this->resource['data']->last_modified,
            'verified_on_nppes' => $this->resource['data']->verified_on_nppes,

            'taxonomies' => PublicTaxonomiesResource::collection($this->resource['data']->taxonomies),
            'contact' => $this->getContact($address),
            'address' => $this->getAddress($address),
        ];
    }

    private function getApiData($address)
    {
        return [
            'id' => '',
            'code' => '',
            'name' => $this->getOrganizationName(),
            'npi' => $this->resource->number ?? '',
            'ein' => '',
            'clia' => '',
            'other_name' => $this->getOtherName(),

            'taxonomies' => ApiTaxonomiesResource::collection($this->resource['api']->taxonomies),
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

    private function getOrganizationName(): string
    {
        $other_name = $this->resource['api']->other_names[0]?->organization_name ?? null;

        return $other_name ?? $this->resource['api']->basic->organization_name;
    }

    private function getOtherName(): string
    {
        $other_name = $this->resource['api']->other_names[0]?->organization_name ?? null;

        return !empty($other_name) ? $this->resource['api']->basic->organization_name : '';
    }
}
