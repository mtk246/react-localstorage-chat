<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Models\Company;
use App\Models\HealthProfessional;
use App\Models\HealthProfessionalType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\HealthProfessional\HealthProfessionalType as HealthProfessionalTypeEnum;
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
                        'address' => $this->getAddress($model->id),
                        'contact' => $this->getContact($model->id),
                        'privateNote' => $this->getPrivateNote($model->id),
                        'is_provider' => $model->pivot->is_provider,
                        'npi_company' => $model->pivot->npi_company,
                        'health_professional_type_id' => $this->getHealthProfessionalTypeId($model->id)['id'],
                        'health_professional_type' => $this->getHealthProfessionalTypeId($model->id),
                        'company_id' => $model->pivotcompany_id,
                        'company' => $this->getCompany($model->pivot->company_id, $model->id)
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

    private function getAddress(int $billingCompanyId)
    {
        return $this->resource
            ->user
            ->addresses
            ->filter(
                fn ($address) => $address->billing_company_id === $billingCompanyId,
            )[0] ?? null;
    }

    private function getContact(int $billingCompanyId)
    {
        return $this->resource
            ->user
            ->contacts
            ->filter(
                fn ($contact) => $contact->billing_company_id === $billingCompanyId,
            )[0] ?? null;
    }

    private function getPrivateNote(int $billingCompanyId)
    {
        return $this->resource
            ->privateNotes
            ->filter(
                fn ($privateNote) => $privateNote->billing_company_id === $billingCompanyId,
            )[0] ?? null;
    }

    private function getHealthProfessionalTypeId(int $billingCompanyId)
    {
        $hpt =  HealthProfessionalType::where('health_professional_id', $this->resource->id)
            ->where('billing_company_id', $billingCompanyId)->first()->type;

        return $this->getHealthProfessionalType((int)$hpt);
        
    }

    private function getHealthProfessionalType(?int $id)
    {
        $enums = collect(HealthProfessionalTypeEnum::cases());
        $item = $enums->first(fn ($item) => $item->value === (int) $id);
        return ($item)
            ? [
                'id' => $item->value,
                'name' => $item->name
            ] 
            : null;
    }

    private function getCompany(?int $companyId, int $billingCompanyId)
    {
        $company = Company::find($companyId);

        return [
            'id' => $company->id,
            'name' => $company->name,
            'nickname' => $company->nicknames->filter(
                fn ($nickname) => $nickname->billing_company_id === $billingCompanyId,
            )[0]->nickname ?? null,
            'taxonomies' => $company->taxonomies ?? [],
        ];
    }
}
