<?php

declare(strict_types=1);

namespace App\Http\Resources\InsurancePlan;

use App\Http\Resources\RequestWrapedResource;
use App\Models\Company;
use App\Models\ContractFee;
use App\Models\HealthProfessional;
use App\Models\Modifier;
use App\Models\Procedure;

/**
 * @property ContractFee $resource
 */
final class ContractFeeResource extends RequestWrapedResource
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
            'billing_company_id' => $this->resource->billing_company_id,
            'type_id' => $this->resource->contract_fee_type_id,
            'procedure_ids' => $this->resource->procedures
                ->map(fn (Procedure $procedure) => $procedure->id)->toArray(),
            'procedures' => $this->resource->procedures
                ->map(function (Procedure $procedure) {
                    return [
                        'id' => $procedure->id,
                        'name' => $procedure->code,
                        'description' => $procedure->description,
                    ];
                })->toArray(),
            'companies_ids' => $this->resource->companies
                ->map(fn (Company $company) => $company->id)->toArray(),
            'companies' => $this->resource->companies
                ->map(function (Company $company) {
                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                    ];
                })->toArray(),
            'modifier_ids' => $this->resource->modifiers
                ->map(fn (Modifier $modifier) => $modifier->id)->toArray(),
            'modifiers' => $this->resource->modifiers
                ->map(function (Modifier $modifier) {
                    return [
                        'id' => $modifier->id,
                        'modifier' => $modifier->modifier,
                        'description' => $modifier->description,
                        'color' => $modifier->classification->getColor(),
                    ];
                })->toArray(),
            'patients' => $this->resource->patients->map(fn ($model) => [
                'patient_id' => $model->id,
                'start_date' => $model->pivot?->start_date ?? '',
                'end_date' => $model->pivot?->end_date ?? '',
            ]) ?? [],
            'have_contract_specifications' => count($this->resource->contractFeeSpecifications ?? []) > 0,
            'contract_specifications' => $this->resource->contractFeeSpecifications->map(fn ($model) => [
                'id' => $model->id,
                'contract_fee_id' => $model->contract_fee_id,
                'billing_provider_id' => !empty($model->billing_provider_id)
                    ? ((HealthProfessional::class == $model->billing_provider_type)
                        ? 'healthProfessional:'.$model->billing_provider_id
                        : 'company:'.$model->billing_provider_id)
                    : '',
                'billing_provider_tax_id' => $model->billing_provider_tax_id,
                'billing_provider_taxonomy_id' => $model->billing_provider_taxonomy_id,
                'health_professional_id' => 'healthProfessional:'.$model->health_professional_id,
                'health_professional_tax_id' => $model->health_professional_tax_id,
                'health_professional_taxonomy_id' => $model->health_professional_taxonomy_id,
            ]),
            'mac' => $this->resource->macLocality?->mac,
            'locality_number' => $this->resource->macLocality?->locality_number,
            'state' => $this->resource->macLocality?->state,
            'fsa' => $this->resource->macLocality?->fsa,
            'counties' => $this->resource->macLocality?->counties,
            'insurance_label_fee_id' => $this->resource->insurance_label_fee_id,
            'price' => (float) $this->resource->price,
            'price_percentage' => (float) $this->resource->price_percentage,
            'private_note' => $this->resource->private_note,
        ];
    }
}
