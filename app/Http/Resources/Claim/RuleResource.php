<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Models\Claims\Rules;
use App\Models\InsurancePlan;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/** @property Rules $resource */
final class RuleResource extends JsonResource
{
    public $preserveKeys = true;

    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'billing_company' => $this->resource->billingCompany->only(['id', 'name', 'code', 'logo', 'abbreviation']),
            'insurance_plans' => $this->resource->insurancePlans->reduce(function (Collection $carry, InsurancePlan $plan) {
                if (!$carry->contains(fn ($item) => $item['id'] === $plan->insurance_company_id)) {
                    $carry->push([
                        'id' => $plan->insurance_company_id,
                        'code' => $plan->insuranceCompany->code,
                        'name' => $plan->insuranceCompany->name,
                        'group_values' => collect(),
                    ]);
                }

                $carry->first(fn ($item) => $item['id'] === $plan->insurance_company_id)['group_values']->push([
                    'id' => $plan->id,
                    'name' => $plan->name,
                    'abbreviation' => $plan
                        ->abbreviations
                        ->where('billing_company_id', $this->resource->billing_company_id)
                        ->first()
                        ?->abbreviation ?? '',
                ]);

                return $carry;
            }, collect()),
            'format' => $this->resource->format,
            'responsibilities' => $this->resource->typesOfResponsibilities?->map(fn ($type) => [
                'id' => $type->id,
                'name' => $type->code,
            ]),
            'rules' => collect(config('claim.formats.'.(RuleFormatType::INSTITUTIONAL == $this->resource->format ? '2' : '1')))
                ->map(fn ($format, $formatKey) => new RuleListResource($format, $formatKey)),
            'parameters' => $this->resource->parameters,
            'active' => $this->resource->active,
            'note' => $this->resource->note,
        ];
    }
}
