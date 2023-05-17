<?php

declare(strict_types=1);

namespace App\Http\Resources\Procedure;

use App\Enums\Procedure\ProcedureType;
use App\Http\Resources\Enums\ChildTypeResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\RequestWrapedResource;

/** @property int $resource */
final class ClassificationResource extends RequestWrapedResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        $type = ProcedureType::from($this->resource);

        $general = $request->general && $type->getChild()
            ? $type->getChild()::from((int) $request->general)
            : null;

        $specific = $request->general && $request->specific && $general && $general->getChild()
            ? $general->getChild()::from((int) $request->specific)
            : null;

        return [
            'general' => new ChildTypeResource($type, TypeResource::class),
            'specific' => new ChildTypeResource($general, TypeResource::class),
            'sub_specific' => new ChildTypeResource($specific, TypeResource::class),
        ];
    }
}
