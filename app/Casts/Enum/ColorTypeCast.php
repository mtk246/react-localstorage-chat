<?php

declare(strict_types=1);

namespace App\Casts\Enum;

use App\Http\Resources\Enums\ColorTypeResource;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class ColorTypeCast implements CastsAttributes
{
    public function __construct(
        protected readonly string $enumClass,
    ) {
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new ColorTypeResource($this->enumClass::from(is_object($value)
            ? $value->value
            : (int) $value
        ), $this->enumClass);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
