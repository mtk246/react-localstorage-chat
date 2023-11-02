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
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        $name = match ($model->claim->type) {
            ClaimType::INSTITUTIONAL => FieldInformationInstitutional::tryFrom((int) $value)->getName(),
            ClaimType::PROFESSIONAL => FieldInformationProfessional::tryFrom((int) $value)->getName(),
            default => null,
        };

        return (object) [
            'id' => $value,
            'value' => $name,
        ];
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
