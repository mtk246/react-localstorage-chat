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
        $enum = ('healthcare-professional' === $type)
            ? FieldHealthCareProfessional::cases()
            : (('information-institutional' === $type)
                ? FieldInformationInstitutional::cases()
                : FieldInformationProfessional::cases());

        $exceptions = ('health-care-institutional' === $type)
            ? []
            : (('information-institutional' === $type)
                ? [
                    1 => ['description'],
                    2 => ['description'],
                    3 => ['description'],
                    4 => ['description'],
                    5 => ['to_date'],
                    6 => ['to_date'],
                ]
                : [
                    1 => ['to_date', 'description'],
                    2 => ['to_date', 'description'],
                    3 => ['qualifier_id', 'description'],
                    4 => ['qualifier_id', 'description'],
                    5 => [],
                ]);

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
