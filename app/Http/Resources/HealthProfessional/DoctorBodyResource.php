<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Http\Resources\Enums\TypeResource;
use App\Models\CompanyHealthProfessional;
use App\Models\HealthProfessional;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property HealthProfessional $resource */
final class DoctorBodyResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'npi' => $this->resource->npi,
            'user_id' => $this->resource->user_id,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'code' => $this->resource->code,
            'is_provider' => $this->resource->is_provider,
            'npi_company' => $this->resource->npi_company,
            'health_professional_type_id' => $this->resource->health_professional_type_id,
            'company_id' => $this->resource->company_id,
            'nppes_verified_at' => $this->resource->nppes_verified_at,
            'ein' => $this->resource->ein,
            'upin' => $this->resource->upin,
            'status' => $this->resource->status,
            'last_modified' => $this->resource->last_modified,
            'companies_providers' => $this->resource->companies_providers->map(
                fn (CompanyHealthProfessional $companyProvider) => [
                    'health_professional_id' => $companyProvider->health_professional_id,
                    'company_id' => $companyProvider->company_id,
                    'authorization' => TypeResource::collection($companyProvider->authorization),
                    'billing_company_id' => $companyProvider->billing_company_id,
                    'created_at' => $companyProvider->created_at,
                    'updated_at' => $companyProvider->updated_at,
                ],
            ),
            'verified_on_nppes' => $this->resource->verified_on_nppes,
            'user' => $this->resource->user,
            'taxonomies' => $this->resource->taxonomies,
            'companies' => $this->resource->companies,
            'health_professional_type' => $this->resource->healthProfessionalType,
            'company' => $this->resource->company,
            'public_note' => $this->resource->publicNote,
            'billing_companies' => $this->resource->billingCompanies
                ->map(function ($model) {
                    $model->socialMedias = $this->getSocialMedias($model->id);
                    $model->addresses = $this->getAddresses($model->id);
                    $model->contacts = $this->getContacts($model->id);
                    $model->privateNotes = $this->getPrivateNotes($model->id);

                    return $model;
                }),
        ];
    }

    private function getSocialMedias(int $billingCompanyId): Collection
    {
        return $this->resource
            ->user
            ->profile
            ->socialMedias
            ->filter(
                fn ($socialMedia) => $socialMedia->billing_company_id === $billingCompanyId,
            );
    }

    private function getAddresses(int $billingCompanyId): Collection
    {
        return $this->resource
            ->user
            ->addresses
            ->filter(
                fn ($address) => $address->billing_company_id === $billingCompanyId,
            );
    }

    private function getContacts(int $billingCompanyId): Collection
    {
        return $this->resource
            ->user
            ->contacts
            ->filter(
                fn ($contact) => $contact->billing_company_id === $billingCompanyId,
            );
    }

    private function getPrivateNotes(int $billingCompanyId): Collection
    {
        return $this->resource
            ->privateNotes
            ->filter(
                fn ($privateNote) => $privateNote->billing_company_id === $billingCompanyId,
            );
    }
}
