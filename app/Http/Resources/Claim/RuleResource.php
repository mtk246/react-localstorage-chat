<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Claims\Rules;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Rules $resource */
final class RuleResource extends JsonResource
{
    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'insurance_company' => $this->resource->insuranceCompany(),
            'format' => $this->resource->format,
            'rules' => array_replace_recursive(
                config("claim.formats.{$this->resource->format}"),
                $this->resource->rules,
            ),
            'parameters' => $this->resource->parameters,
        ];
    }
}
