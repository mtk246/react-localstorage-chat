<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use App\Enums\Reports\ColumnsAdminDetailPatinetType;
use App\Enums\Reports\ColumnsBillingDetailPatinetType;
use App\Enums\Reports\ColumnsGeneralPatinetType;
use App\Enums\Reports\TypeReportAllRecords;
use App\Http\Resources\Enums\EnumResource;
use Gate;
use Illuminate\Http\Resources\Json\JsonResource;

final class ColumnsReportResource extends JsonResource
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
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        match ($this->module) {
            TypeReportAllRecords::DETAILED_PATIENT => Gate::check('is-admin') 
                ? new EnumResource(collect(ColumnsAdminDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_PATIENT => new EnumResource(collect(ColumnsGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),
        };
    }
}
