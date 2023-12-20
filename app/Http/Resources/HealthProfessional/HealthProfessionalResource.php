<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

final class HealthProfessionalResource extends JsonResource
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
            'id' => $this->resource->id,
            'npi' => $this->resource->npi,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'code' => $this->resource->code,
            'is_provider' => $this->resource->is_provider,
            'npi_company' => $this->resource->npi_company,
            'company_id' => $this->resource->company_id,
            'nppes_verified_at' => $this->resource->nppes_verified_at,
            'ein' => $this->resource->ein,
            'upin' => $this->resource->upin,
            'profile_id' => $this->resource->profile_id,
            'user' => $this->resource->user,
            'status' => $this->resource->status,
            'last_modified' => $this->resource->last_modified,
            'companies_providers' => $this->resource->companies_providers,
            'verified_on_nppes' => $this->resource->verified_on_nppes,
            'profile' => $this->resource->profile,
            'billing_companies' => $this->resource->billingCompanies,
            'taxonomies' => $this->resource->taxonomies->unique('name'),
            'companies' => $this->getCompanies(),
            'health_professional_type' => $this->resource->healthProfessionalType?->unique('type')
                ?->map(fn ($type) => ['id' => $type->type->value, 'name' => $type->type->getName()]) ?? [],
        ];
    }

    private function getContact(int $billingCompanyId)
    {
        return $this->resource
            ->profile
            ->contacts
            ->filter(
                fn ($contact) => $contact->billing_company_id === $billingCompanyId,
            )[0] ?? null;
    }

    private function getAddress(int $billingCompanyId)
    {
        return $this->resource
            ->profile
            ->addresses
            ->first(
                fn ($address) => $address->billing_company_id === $billingCompanyId,
            ) ?? null;
    }

    private function getPrivateNote(int $billingCompanyId)
    {
        return $this->resource
            ->privateNotes
            ->first(
                fn ($privateNote) => $privateNote->billing_company_id === $billingCompanyId,
            ) ?? null;
    }

    private function getCompanies()
    {
        $companies = $this->resource->billingCompanies->map(function ($bC) {
            return Company::find($bC->pivot->company_id);
        });

        return ($companies->count() > 0) ? $companies : [];
    }
}
