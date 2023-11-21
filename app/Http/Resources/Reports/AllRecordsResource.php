<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @todo: Refactor when upgrading to laravel 10
 */
final class AllRecordsResource extends JsonResource
{
    private string $module;

    public function __construct($resource, $module)
    {
        parent::__construct($resource);
        $this->resource = $resource;

        $this->module = $module;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => "$this->module List successfully.",
            'data' => $this->resource,
            'colums' => new ColumnsReportResource($this->resource, $this->module),
        ];
    }
}
