<?php

declare(strict_types=1);

namespace App\Casts\Procedure;

use App\Enums\Procedure\ProcedureType;
use App\Http\Resources\Enums\TypeResource;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class ClasificationsCast implements CastsAttributes
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string|null $value
     *
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        $clasifications = json_decode($value);

        $type = ProcedureType::from((int) $model->type->value);

        $general = property_exists($clasifications, 'general') && $type->getChild()
            ? new TypeResource($type->getChild()::from((int) $clasifications->general))
            : null;

        $specific = property_exists($clasifications, 'general')
            && property_exists($clasifications, 'specific')
            && $general
            && $general->getChild()
            ? new TypeResource(
                $type
                    ->getChild()::from((int) $clasifications->general)
                    ->getChild()::from((int) $clasifications->specific)
            )
            : null;

        $subSpecific = property_exists($clasifications, 'general')
            && property_exists($clasifications, 'specific')
            && property_exists($clasifications, 'sub_specific')
            && $specific
            && $specific->getChild()
            ? new TypeResource(
                $type
                    ->getChild()::from((int) $clasifications->general)
                    ->getChild()::from((int) $clasifications->specific)
                    ->getChild()::from((int) $clasifications->sub_specific)
            )
            : null;

        return [
            'general' => $general,
            'specific' => $specific,
            'sub_specific' => $subSpecific,
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param mixed $value
     *
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value);
    }
}
