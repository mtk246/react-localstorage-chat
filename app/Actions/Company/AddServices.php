<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Exceptions\User\NotHaveBillingCompany;
use App\Http\Casts\Company\MedicationRequestCast;
use App\Http\Casts\Company\ServiceRequestCast;
use App\Http\Resources\Company\ServiceResource;
use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\CompanyProcedure;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddServices
{
    public function invoke(Collection $services, Company $company, User $user): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($company, $services, $user): AnonymousResourceCollection {
            $billingCompany = $this->getBillingCompany($user);

            $this->syncServices($company, $services, $billingCompany?->id);

            $services->each(fn (ServiceRequestCast $service) => tap(
                CompanyProcedure::updateOrCreate([
                    'id' => $service->getId(),
                    'company_id' => $company->id,
                    'billing_company_id' => $service->getBillingCompanyId() ?? $billingCompany->id,
                ], [
                    'procedure_id' => $service->getProcedureId(),
                    'mac_locality_id' => $service->getMacLocality()?->id,
                    'price' => $service->getPrice(),
                    'price_percentage' => $service->getPricePercentage(),
                    'modifier_id' => $service->getModifierId(),
                    'insurance_label_fee_id' => $service->getInsuranceLabelFeeId(),
                    'clia' => $service->getClia(),
                ]),
                fn (CompanyProcedure $cProcedure) => $this->setMedications(
                    $cProcedure,
                    $service->getMedications(),
                )
            ));

            $procedures = CompanyProcedure::query()
                ->where('company_id', $company->id)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompany): void {
                    $query->where('billing_company_id', $billingCompany->id);
                })
                ->get();

            return ServiceResource::collection($procedures);
        });
    }

    private function syncServices(Company $company, collection $services, ?int $billingCompanyId): void
    {
        CompanyProcedure::query()
            ->where('company_id', $company->id)
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('id', $services->map(fn (ServiceRequestCast $services) => $services->getId())
                ->toArray())
            ->delete();
    }

    /** @todo move to model */
    private function getBillingCompany(User $user): ?BillingCompany
    {
        $billingCompany = $user->billingCompanies->first();

        if (Gate::denies('is-admin') && is_null($billingCompany)) {
            throw new NotHaveBillingCompany();
        }

        return $billingCompany;
    }

    private function setMedications(CompanyProcedure $cProcedure, Collection $medications): void
    {
        $cProcedure->medications()
            ->whereNotIn(
                'id',
                $medications->map(fn (MedicationRequestCast $medication) => $medication->getId())
                    ->toArray(),
            )
            ->delete();

        $medications->each(
            fn (MedicationRequestCast $medication) => $cProcedure->medications()->updateOrCreate(
                ['id' => $medication->getId()],
                [
                    'date' => $medication->getDate(),
                    'drug_code' => $medication->getDrugCode(),
                    'batch' => $medication->getBatch(),
                    'quantity' => $medication->getQuantity(),
                    'frequency' => $medication->getFrequency(),
                ],
            )
        );
    }
}
