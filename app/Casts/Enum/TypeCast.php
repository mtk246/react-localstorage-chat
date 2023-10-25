<?php

declare(strict_types=1);

namespace App\Casts\Enum;

use App\Http\Resources\Enums\TypeResource;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class TypeCast implements CastsAttributes
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
        return new TypeResource($this->enumClass::from((int) $value), $this->enumClass);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
