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
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type = ProcedureType::from($this->resource);

        return [
            'general' => new ChildTypeResource($type, TypeResource::class),
            'specific' => $request->general
                ? new ChildTypeResource($type->getChild()::from((int) $request->general), TypeResource::class)
                : null,
            'sub_specific' => $request->general && $request->specific
                ? new ChildTypeResource($type->getChild()::from((int) $request->general)?->getChild()::from((int) $request->specific), TypeResource::class)
                : null,
        ];
    }
}
