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
            $item = $enums->first(function ($item) use ($data) {
                return $item->value === (int) $data['id'];
            });
            $typeCatalog = getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => $item->getName()]], null, ['code']);
            foreach ($typeCatalog as $key => $value) {
                if (('14. Date of current illnes, injury or pregnancy (LMP)' === $item->getName()) ||
                    ('15. Other date' === $item->getName())) {
                    $typeCatalog[$key]['except'] = ['to_date', 'description'];
                } elseif (('16. Dates patient unable to work in current occupation' === $item->getName()) ||
                    ('18. Hospitalization dates related to current services' === $item->getName())) {
                    $typeCatalog[$key]['except'] = ['description'];
                } else {
                    $typeCatalog[$key]['except'] = [];
                }
            }
            return $typeCatalog;
        } else {
            return [];
        }
    }
}
