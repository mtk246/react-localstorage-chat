<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Models\Claims\ClaimDateInformation;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ClaimDateInformation $resource */
final class ClaimDateInformationResource extends JsonResource
{
    public function __construct($resource, protected int $type)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $commonFields = [
            'id' => $this->resource->id,
            'field_id' => $this->resource->field_id?->value ?? '',
            'field' => $this->resource->field_id?->getName() ?? '',
            'qualifier_id' => $this->resource->qualifier_id,
            'qualifier' => $this->resource->qualifier?->code,
            'from_date' => $this->resource->from_date,
            'to_date' => $this->resource->to_date,
            'description' => $this->resource->description,
        ];

        $specificFields = match ($this->type) {
            ClaimType::INSTITUTIONAL->value => [
                'amount' => $this->resource->amount,
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }
}
