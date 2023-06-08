<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\FieldHealthCareInstitutional;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;

final class GetFieldAction
{
    public function all($type)
    {
        $enum = ('health-care-institutional' === $type)
            ? FieldHealthCareInstitutional::cases()
            : (('information-institutional' === $type)
                ? FieldInformationInstitutional::cases()
                : FieldInformationProfessional::cases());

        $exceptions = ('health-care-institutional' === $type)
            ? []
            : (('information-institutional' === $type)
                ? [
                    1 => ['through'],
                    2 => ['through'],
                    3 => ['through'],
                    4 => ['through'],
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
