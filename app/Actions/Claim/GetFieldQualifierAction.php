<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;
use App\Models\TypeCatalog;

final class GetFieldQualifierAction
{
    public function all(array $data)
    {
        if ('information-professional' === $data['type']) {
            $enums = collect(FieldInformationProfessional::cases());
            $item = $enums->first(fn ($item) => $item->value === (int) $data['id']);

            return getList(
                TypeCatalog::class,
                ['code', '-', 'description'],
                ['relationship' => 'type', 'where' => ['description' => $item?->getName()]],
                null,
                ['code'],
            );
        } elseif ('information-institutional' === $data['type']) {
            $enums = collect(FieldInformationInstitutional::cases());
            $item = $enums->first(fn ($item) => $item->value === (int) $data['id']);

            $description = (in_array($data['id'], [1, 2, 3, 4]))
                ? 'Occurrence span code and date'
                : ((in_array($data['id'], [5, 6]))
                    ? 'Occurrence code and date'
                    : '');

            return getList(
                TypeCatalog::class,
                ['code', '-', 'description'],
                ['relationship' => 'type', 'where' => ['description' => ($item) ? $description : null]],
                null,
                ['code'],
            );
        } else {
            return getList(
                TypeCatalog::class,
                ['code', '-', 'description'],
                ['relationship' => 'type', 'where' => ['description' => 'Health care institutional qualifier reference']],
                null,
                ['code'],
            );
        }
    }
}
