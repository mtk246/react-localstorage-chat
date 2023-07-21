<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Exceptions\User\NotHaveBillingCompany;
use App\Http\Casts\Company\MedicationRequestCast;
use App\Http\Casts\Company\ServiceRequestCast;
use App\Http\Resources\Company\ServiceResource;
use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\CompanyService;
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
                CompanyService::updateOrCreate([
                    'id' => $service->getId(),
                    'company_id' => $company->id,
                    'billing_company_id' => $service->getBillingCompanyId() ?? $billingCompany->id,
                ], [
                    'mac_locality_id' => $service->getMacLocality()?->id,
                    'price' => $service->getPrice(),
                    'price_percentage' => $service->getPricePercentage(),
                    'insurance_label_fee_id' => $service->getInsuranceLabelFeeId(),
                    'clia' => $service->getClia(),
                ]),
                function (CompanyService $cService) use ($service): void {
                    $cService->procedures()->sync($service->getProcedureIds());
                    $cService->modifiers()->sync($service->getModifierIds());
                    $this->setMedications(
                        $cService,
                        $service->getMedications());
                }
            ));

            $services = CompanyService::query()
                ->where('company_id', $company->id)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompany): void {
                    $query->where('billing_company_id', $billingCompany->id);
                })
                ->get();

            return ServiceResource::collection($services);
        });
    }

    private function syncServices(Company $company, collection $services, ?int $billingCompanyId): void
    {
        $companyServices = CompanyService::query()
            ->where('company_id', $company->id)
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('id', $services->map(fn (ServiceRequestCast $services) => $services->getId())
                ->toArray());

        $companyServices
            ->get()
            ->each(function (CompanyService $companyService) {
                $companyService->procedures()->detach();
                $companyService->modifiers()->detach();
            });

        $companyServices->delete();
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

    private function setMedications(CompanyService $cService, Collection $medications): void
    {
        $cService->medications()
            ->whereNotIn(
                'id',
                $medications->map(fn (MedicationRequestCast $medication) => $medication->getId())
                    ->toArray(),
            )
            ->delete();

        $medications->each(
            fn (MedicationRequestCast $medication) => $cService->medications()->updateOrCreate(
                ['id' => $medication->getId()],
                [
                    'drug_code' => $medication->getDrugCode(),
                    'measurement_unit_id' => $medication->getMeasurementUnitId(),
                    'units' => $medication->getUnits(),
                    'units_limit' => $medication->getUnitsLimit(),
                    'link_sequence_number' => $medication->getLinkSequenceNumber(),
                    'pharmacy_prescription_number' => $medication->getPharmacyPrescriptionNumber(),
                    'repackaged_NDC' => $medication->getRepackagedNDC(),
                    'code_NDC' => $medication->getCodeNDC(),
                    'note' => $medication->getNote(),
                ],
            )
        );
    }
}
