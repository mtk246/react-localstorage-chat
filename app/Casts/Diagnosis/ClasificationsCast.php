<?php

declare(strict_types=1);

namespace App\Casts\Diagnosis;


use App\Enums\Diagnoses\DiagnosesType;
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

        $type_id = isset($model->type?->value)  ? $model->type->value : $model->type;

        $type = DiagnosesType::tryFrom((int) $type_id);

        $specific = $this->checkProperty($clasifications, 'specific') && $type->getChild()
            ? new TypeResource($type->getChild()::from((int) $clasifications->specific))
            : null;

        $subSpecific = $this->checkProperty($clasifications, 'specific')
            && $this->checkProperty($clasifications, 'sub_specific')
            && $specific
            && $specific->getChild()
            ? new TypeResource(
                $type
                    ->getChild()::from((int) $clasifications->specific)
                    ->getChild()::from((int) $clasifications->sub_specific)
            )
            : null;

        return [
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

    private function checkProperty(object $object, string $property): bool
    {
        return property_exists($object, $property) && !is_null($object->{$property});
    }
}
