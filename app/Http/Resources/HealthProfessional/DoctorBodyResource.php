<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

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
            'nppes_verified_at' => $this->resource->nppes_verified_at,
            'ein' => $this->resource->ein,
            'upin' => $this->resource->upin,
            'status' => $this->resource->status,
            'last_modified' => $this->resource->last_modified,
            'verified_on_nppes' => $this->resource->verified_on_nppes,
            'user' => $this->resource->user,
            'taxonomies' => $this->resource->taxonomies,
            'public_note' => $this->resource->publicNote,
            'billing_companies' => $this->resource->billingCompanies
                ->map(function ($model) {
                    $model->private_health_professional = [
                        'socialMedias' => $this->getSocialMedias($model->id),
                        'addresses' => $this->getAddresses($model->id),
                        'contacts' => $this->getContacts($model->id),
                        'privateNotes' => $this->getPrivateNotes($model->id),

                        /* @todo Mapear esta información como data privada */
                        'is_provider' => $this->resource->is_provider,
                        'npi_company' => $this->resource->npi_company,
                        'health_professional_type_id' => $this->resource->health_professional_type_id,
                        'health_professional_type' => $this->resource->healthProfessionalType,
                        'company_id' => $this->resource->company_id,
                        'company' => [
                            'id' => $this->resource->company->id,
                            'name' => $this->resource->company->name,
                            'nickname' => '',
                            'taxonomies' => $this->resource->company->taxonomies ?? [],
                        ],
                    ];

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
