<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Models\Claims\Rules;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'insurance_plan' => $this->resource->insurancePlan,
            'format' => $this->resource->format,
            'responsibilities' => $this->resource->typesOfResponsibilities?->map(fn ($type) => [
                'id' => $type->id,
                'name' => $type->code,
            ]),
            'rules' => collect(config('claim.formats.'.(RuleFormatType::INSTITUTIONAL == $this->resource->format ? '2' : '1')))
                ->map(fn ($format, $formatKey) => collect($format)
                    ->mapWithKeys(function (array $rule, $key) use ($formatKey) {
                        $rule['value'] = $this->resource->rules[$formatKey][$key] ?? $rule['value'];

                        return [$key => $rule];
                    })
                ),
            'parameters' => $this->resource->parameters,
            'active' => $this->resource->active,
        ];
    }
}
