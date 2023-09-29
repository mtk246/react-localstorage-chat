<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Http\Resources\API\TaxonomiesResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class HealthProfessionalNpiResource extends JsonResource
{
    /** @return array<key, string> */
    public function toArray($request): array
    {
        $address = array_first($this->resource['api']?->addresses ?? [], function ($address) {
            return 'MAILING' == $address->address_purpose;
        });

        if ('public' == $this->resource['type']) {
            return $this->getPublicData($address);
        }

        if ('api' == $this->resource['type']) {
            return $this->getApiData($address);
        }
    }

    private function getPublicData($address): array
    {
        return [
            'id' => $this->resource['data']->id,
            'npi' => $this->resource['data']->npi,
            'user_id' => $this->resource['data']->profile->user_id,
            'created_at' => $this->resource['data']->created_at,
            'updated_at' => $this->resource['data']->updated_at,
            'code' => $this->resource['data']->code,
            'is_provider' => $this->resource['data']->is_provider,
            'npi_company' => $this->resource['data']->npi_company,
            'company_id' => $this->resource['data']->company_id,
            'nppes_verified_at' => $this->resource['data']->nppes_verified_at,
            'ein' => $this->resource['data']->ein,
            'upin' => $this->resource['data']->upin,
            'profile_id' => $this->resource['data']->profile_id,
            'user' => $this->resource['data']->user,
            'status' => $this->resource['data']->status,
            'last_modified' => $this->resource['data']->last_modified,
            'companies_providers' => $this->resource['data']->companies_providers,
            'verified_on_nppes' => $this->resource['data']->verified_on_nppes,
            'companies' => $this->resource['data']->companies,
            'public_note' => $this->resource['data']->publicNote,
            'profile' => $this->resource['data']->profile,

            'taxonomies' => TaxonomiesResource::collection($this->resource['api']?->taxonomies ?? []),
            'contact' => $this->getContact($address),
            'address' => $this->getAddress($address),
        ];
    }

    private function getApiData($address): array
    {
        return [
            'id' => $this->resource->id ?? null,
            'npi' => $this->resource['api']->number ?? null,
            'user_id' => $this->resource['api']->user_id ?? null,
            'created_at' => $this->resource['api']->created_at ?? null,
            'updated_at' => $this->resource['api']->updated_at ?? null,
            'code' => $this->resource['api']->code ?? null,
            'is_provider' => $this->resource['api']->is_provider ?? null,
            'npi_company' => $this->resource['api']->npi_company ?? null,
            'company_id' => $this->resource['api']->company_id ?? null,
            'nppes_verified_at' => $this->resource['api']->nppes_verified_at ?? null,
            'ein' => $this->resource['api']->ein ?? null,
            'upin' => $this->resource['api']->upin ?? null,
            'profile_id' => $this->resource['api']->profile_id ?? null,
            'user' => $this->resource['api']->user ?? null,
            'status' => $this->resource['api']->status ?? null,
            'last_modified' => $this->resource['api']->last_modified ?? null,
            'companies_providers' => $this->resource['api']->companies_providers ?? null,
            'verified_on_nppes' => $this->resource['api']->verified_on_nppes ?? null,
            'companies' => $this->resource['api']->companies ?? null,
            'public_note' => $this->resource['api']->publicNote ?? null,
            'profile' => $this->getProfileData(),

            'taxonomies' => TaxonomiesResource::collection($this->resource['api']->taxonomies),
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

    private function getProfileData(): array
    {
        return [
            'ssn' => $this->resource['api']->ssn ?? null,
            'first_name' => $this->resource['api']->basic->first_name,
            'middle_name' => $this->resource['api']->middle_name ?? null,
            'last_name' => $this->resource['api']->basic->last_name ?? null,
            'sex' => $this->resource['api']->basic->gender ?? null,
            'date_of_birth' => $this->resource['api']->certification_date ?? null,
            'avatar' => $this->resource['api']->avatar ?? null,
            'credit_score' => $this->resource['api']->credit_score ?? null,
            'name_suffix_id' => $this->resource['api']->name_suffix_id ?? null,
            'deceased_date' => $this->resource['api']->deceased_date ?? null,
            'language' => $this->resource['api']->language ?? null,
        ];
    }
}
