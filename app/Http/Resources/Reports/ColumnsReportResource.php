<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use App\Enums\Reports\ColumnsAdminDetailPatinetType;
use App\Enums\Reports\ColumnsBillingDetailPatinetType;
use App\Enums\Reports\ColumnsBillingGeneralFacilityType;
use App\Enums\Reports\ColumnsBillingGeneralHealthcareProfessionalType;
use App\Enums\Reports\ColumnsBillingGeneralPatinetType;
use App\Enums\Reports\ColumnsGeneralFacilityType;
use App\Enums\Reports\ColumnsGeneralHealthcareProfessionalType;
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
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return match ($this->module) {
            TypeReportAllRecords::DETAILED_PATIENT => \Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsAdminDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_PATIENT => \Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_FACILITY => \Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsGeneralFacilityType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingGeneralFacilityType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_HEALTHCARE_PROFESSIONAL => \Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsGeneralHealthcareProfessionalType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingGeneralHealthcareProfessionalType::cases()), ColumnsAdminDetailPatinetResource::class)
        };
    }
}
