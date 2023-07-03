<?php

declare(strict_types=1);

namespace App\Http\Resources\Diagnoses;

use App\Enums\Diagnoses\DiagnosesType;
use App\Http\Resources\Enums\ChildTypeResource;
use App\Http\Resources\Enums\ColorTypeResource;
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

        $general = $request->general && $type->getChild()
            ? $type->getChild()::from((int) $request->general)
            : null;

        $specific = $request->general && $request->specific && $general && $general->getChild()
            ? $general->getChild()::from((int) $request->specific)
            : null;

        return [
            'general' => new ChildTypeResource($type, ColorTypeResource::class),
            'specific' => new ChildTypeResource($general, TypeResource::class),
        ];
    }
}
