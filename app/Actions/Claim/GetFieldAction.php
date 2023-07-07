<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\FieldHealthCareProfessional;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;

final class GetFieldAction
{
    public function all($type)
    {
        $enum = match ($type) {
            'healthcare-professional' => FieldHealthCareProfessional::cases(),
            'information-institutional' => FieldInformationInstitutional::cases(),
            'information-professional' => FieldInformationProfessional::cases(),
            default => throw new \InvalidArgumentException('Invalid type field'),
        };

        $exceptions = match ($type) {
            'healthcare-professional' => [],
            'information-institutional' => [
                1 => ['description'],
                2 => ['description'],
                3 => ['description'],
                4 => ['description'],
                5 => ['to_date'],
                6 => ['to_date'],
            ],
            'information-professional' => [
                1 => ['to_date', 'description'],
                2 => ['to_date', 'description'],
                3 => ['qualifier_id', 'description'],
                4 => ['qualifier_id', 'description'],
                5 => [],
            ],
            default => throw new \InvalidArgumentException('Invalid type field'),
        };

        $response = collect($enum)->map(function ($item) use ($exceptions) {
            return [
                'id' => $item->value,
                'name' => $item->getName(),
                'except' => $exceptions[$item->value] ?? [],
            ];
        })->toArray();

        return $response;
    }
}
