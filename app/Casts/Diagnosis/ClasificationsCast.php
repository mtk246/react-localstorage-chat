<?php

declare(strict_types=1);

namespace App\Casts\Diagnosis;

use App\Enums\Diagnoses\DiagnosesType;
use App\Http\Resources\Enums\ColorTypeResource;
use App\Http\Resources\Enums\TypeResource;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class ClasificationsCast implements CastsAttributes
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string|null $value
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        $clasifications = (object) json_decode($value);

        $type_id = isset($model->type?->value) ? $model->type->value : $model->type;

        $type = DiagnosesType::tryFrom((int) $type_id);

        $general = $this->checkProperty($clasifications, 'general') && $type->getChild()
            ? new ColorTypeResource($type->getChild()::from((int) $clasifications->general))
            : null;

        $specific = $this->checkProperty($clasifications, 'specific')
            && $this->checkProperty($clasifications, 'specific')
            && $general
            && $general->getChild()
            ? new TypeResource(
                $type
                    ->getChild()::from((int) $clasifications->general)
                    ->getChild()::from((int) $clasifications->specific)
            )
            : null;

        return [
            'general' => $general,
            'specific' => $specific,
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value);
    }

    private function checkProperty(object $object, string $property): bool
    {
        return property_exists($object, $property) && !is_null($object->{$property});
    }
}
