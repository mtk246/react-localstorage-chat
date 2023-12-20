<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Http\Resources\Company\TaxonomiesResource;
use App\Models\Company;
use App\Models\HealthProfessional;
use App\Models\HealthProfessionalType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

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
            'taxonomies' => TaxonomiesResource::collection(
                $this->resource->taxonomies()
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_company_id', request()->user()->billing_company_id)
                )
                ->distinct('taxonomy_id')->get()
            ),
            'public_note' => $this->resource->publicNote,
            'profile' => $this->resource->profile,
            'billing_companies' => $this->resource->billingCompanies()
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_company_id', request()->user()->billing_company_id)
                )
                ->get()
                ->map(function ($model) {
                    $type = $this->getHealthProfessionalType($model->id);
                    $model->private_health_professional = [
                        'taxonomy' => TaxonomiesResource::collection($this->resource->taxonomies()
                            ->wherePivot('billing_company_id', $model->id)
                            ->get()),
                        'socialMedias' => $this->getSocialMedias($model->id),
                        'address' => $this->getAddress($model->id),
                        'contact' => $this->getContact($model->id),
                        'privateNote' => $this->getPrivateNote($model->id),
                        'is_provider' => $model->pivot->is_provider,
                        'npi_company' => $model->pivot->npi_company,
                        'health_professional_type_id' => $type['id'] ?? null,
                        'health_professional_type' => $type,
                        'company_id' => $model->pivot->company_id,
                        'company' => $this->getCompany($model->pivot->company_id, $model->id),
                        'miscellaneous' => $model->pivot->miscellaneous,
                    ];

                    return $model;
                }),
        ];
    }

    private function getSocialMedias(int $billingCompanyId): Collection
    {
        return $this->resource
            ->profile
            ->socialMedias
            ->filter(
                fn ($socialMedia) => $socialMedia->billing_company_id === $billingCompanyId,
            );
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

    private function getContact(int $billingCompanyId)
    {
        return $this->resource
            ->profile
            ->contacts
            ->first(
                fn ($contact) => $contact->billing_company_id === $billingCompanyId,
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

    private function getHealthProfessionalType(int $billingCompanyId)
    {
        $type = HealthProfessionalType::query()
            ->where('health_professional_id', $this->resource->id)
            ->where('billing_company_id', $billingCompanyId)
            ->first()?->type;

        return ($type)
            ? [
                'id' => $type->value,
                'name' => $type->getName(),
            ]
            : null;
    }

    private function getCompany(?int $companyId, int $billingCompanyId)
    {
        $company = Company::find($companyId);

        return ($company)
            ? [
                'id' => $company->id,
                'name' => $company->name,
                'nickname' => $company->nicknames->filter(
                    fn ($nickname) => $nickname->billing_company_id === $billingCompanyId,
                )[0]->nickname ?? '',
                'taxonomies' => $company->taxonomies()->wherePivot(
                    'billing_company_id', '=', $billingCompanyId
                )->get() ?? [],
            ]
            : null;
    }
}
