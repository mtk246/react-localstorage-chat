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
            'data' => $this->resource['data'],
            'links' => [
                'first' => $this->resource['first_page_url'],
                'last' => $this->resource['last_page_url'],
                'prev' => $this->resource['prev_page_url'],
                'next' => $this->resource['next_page_url'],
            ],
            'meta' => [
                'current_page' => $this->resource['current_page'],
                'from' => $this->resource['from'],
                'last_page' => $this->resource['last_page'],
                'links' => $this->resource['links'],
                'path' => $this->resource['path'],
                'per_page' => $this->resource['per_page'],
                'to' => $this->resource['to'],
                'total' => $this->resource['total'],
            ],
            'headers' => new ColumnsReportResource($this->resource, $this->module),
        ];
    }
}
