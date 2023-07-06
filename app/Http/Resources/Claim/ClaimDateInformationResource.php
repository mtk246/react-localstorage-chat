<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'field_id' => $this->resource->field_id,
            'field' => match ($this->resource->field_id) {
                FieldInformationInstitutional::FIELD_31->value => FieldInformationInstitutional::FIELD_31->getName(),
                FieldInformationInstitutional::FIELD_32->value => FieldInformationInstitutional::FIELD_32->getName(),
                FieldInformationInstitutional::FIELD_33->value => FieldInformationInstitutional::FIELD_33->getName(),
                FieldInformationInstitutional::FIELD_34->value => FieldInformationInstitutional::FIELD_34->getName(),
                FieldInformationInstitutional::FIELD_35->value => FieldInformationInstitutional::FIELD_35->getName(),
                FieldInformationInstitutional::FIELD_36->value => FieldInformationInstitutional::FIELD_36->getName(),
                FieldInformationProfessional::FIELD_14->value => FieldInformationProfessional::FIELD_14->getName(),
                FieldInformationProfessional::FIELD_15->value => FieldInformationProfessional::FIELD_15->getName(),
                FieldInformationProfessional::FIELD_16->value => FieldInformationProfessional::FIELD_16->getName(),
                FieldInformationProfessional::FIELD_18->value => FieldInformationProfessional::FIELD_18->getName(),
                FieldInformationProfessional::FIELD_19->value => FieldInformationProfessional::FIELD_19->getName(),
                default => '',
            },
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
