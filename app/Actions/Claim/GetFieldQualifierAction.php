<?php

declare(strict_types=1);

namespace App\Actions\Claim;

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
                ['relationship' => 'type', 'where' => ['description' => $item->getName()]],
                null,
                ['code'],
            );
        } else {
            return [];
        }
    }
}
