<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\FieldHealthCareInstitutional;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;

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
