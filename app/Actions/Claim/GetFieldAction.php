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

        $exceptions = ('information-institutional' === $type)
            ? [] : [
                1 => ['to_date', 'description'],
                2 => ['to_date', 'description'],
                3 => ['qualifier_id', 'description'],
                4 => ['qualifier_id', 'description'],
                5 => [],
            ];

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
