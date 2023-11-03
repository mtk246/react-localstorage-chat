<?php

declare(strict_types=1);

namespace App\Casts\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class FieldCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \App\Enums\Interfaces\RelatedEnumsInterface
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        return match ($model->claim->type) {
            ClaimType::INSTITUTIONAL => FieldInformationInstitutional::tryFrom((int) $value),
            ClaimType::PROFESSIONAL => FieldInformationProfessional::tryFrom((int) $value),
            default => null,
        };
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
