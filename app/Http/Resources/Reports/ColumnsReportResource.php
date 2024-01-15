<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use App\Enums\Reports\ColumnsAdminDetailPatinetType;
use App\Enums\Reports\ColumnsAdminPayerMixType;
use App\Enums\Reports\ColumnsAdminProfessionalProductivityType;
use App\Enums\Reports\ColumnsAdminViewBaddebtCost;
use App\Enums\Reports\ColumnsAdminViewPostedPaymentTransactionAudit;
use App\Enums\Reports\ColumnsBillingDetailPatinetType;
use App\Enums\Reports\ColumnsBillingGeneralFacilityType;
use App\Enums\Reports\ColumnsBillingGeneralHealthcareProfessionalType;
use App\Enums\Reports\ColumnsBillingGeneralPatinetType;
use App\Enums\Reports\ColumnsGeneralFacilityType;
use App\Enums\Reports\ColumnsGeneralHealthcareProfessionalType;
use App\Enums\Reports\ColumnsGeneralPatinetType;
use App\Enums\Reports\ColumnsPayerMixType;
use App\Enums\Reports\ColumnsProfessionalProductivityType;
use App\Enums\Reports\ColumnsviewBaddebtCost;
use App\Enums\Reports\ColumnsViewChangeModule;
use App\Enums\Reports\ColumnsViewDailyInsuranceResponsibilityAging;
use App\Enums\Reports\ColumnsViewPostedPaymentTransactionAudit;
use App\Enums\Reports\TypeReportAllRecords;
use App\Http\Resources\Enums\EnumResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

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
            TypeReportAllRecords::DETAILED_PATIENT => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsAdminDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_PATIENT => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_FACILITY => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsGeneralFacilityType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingGeneralFacilityType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::GENERAL_HEALTHCARE_PROFESSIONAL => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsGeneralHealthcareProfessionalType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsBillingGeneralHealthcareProfessionalType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::PAYER_MIX => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsAdminPayerMixType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsPayerMixType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::PROFESSIONAL_PRODUCTIVITY => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsAdminProfessionalProductivityType::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsProfessionalProductivityType::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::BAD_DEBT_COST => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsAdminViewBaddebtCost::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsviewBaddebtCost::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::CHANGE_BY_MODULE => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsViewChangeModule::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsViewChangeModule::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::DAYLY_INSURANCE_AGAING => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsViewDailyInsuranceResponsibilityAging::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsViewDailyInsuranceResponsibilityAging::cases()), ColumnsAdminDetailPatinetResource::class),

            TypeReportAllRecords::POSTED_PAYMENT_TRANSACTION_AUDIT => Gate::check('is-admin')
                ? new EnumResource(collect(ColumnsAdminViewPostedPaymentTransactionAudit::cases()), ColumnsAdminDetailPatinetResource::class)
                : new EnumResource(collect(ColumnsViewPostedPaymentTransactionAudit::cases()), ColumnsAdminDetailPatinetResource::class)
        };
    }
}
