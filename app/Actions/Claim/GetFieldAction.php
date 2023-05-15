<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\Enums\EnumResource;
use App\Enums\Claim\FieldInformationProfessional;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldHealthCareInstitutional;

final class GetFieldAction
{
    public function all($type)
    {
        $enum = ('health-care-institutional' === $type)
            ? FieldHealthCareInstitutional::cases()
            : (('information-institutional' === $type)
                ? FieldInformationInstitutional::cases()
                : FieldInformationProfessional::cases());
        return new EnumResource(collect($enum), TypeResource::class);
    }
}
