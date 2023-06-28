<?php

declare(strict_types=1);

namespace App\Http\Resources\Diagnoses;

use App\Enums\Diagnoses\DiagnosesType;
use App\Http\Resources\Enums\ChildTypeResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\RequestWrapedResource;

final class ClassificationResource extends RequestWrapedResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        $type = DiagnosesType::from($this->resource);

        $specific = $request->specific && $type->getChild()
            ? $type->getChild()::from((int) $request->specific)
            : null;

        $subspecific = $request->specific && $request->subspecific && $specific && $specific->getChild()
            ? $specific->getChild()::from((int) $request->subspecific)
            : null;

        return [
            'specific' => new ChildTypeResource($type, TypeResource::class),
            'sub_specific' => new ChildTypeResource($specific, TypeResource::class),
        ];
    }
}
