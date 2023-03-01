<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Exceptions\User\NotHaveBillingCompany;
use App\Http\Requests\Models\Company\Medication;
use App\Http\Requests\Models\Company\Service;
use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\CompanyProcedure;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddServices
{
    public function invoke(Collection $services, Company $company, User $user): Collection
    {
        return DB::transaction(function () use ($company, $services, $user) {
            $billingCompany = $this->getBillingCompany($user);

            $this->detachProcedures($company, $billingCompany?->id);

            $services->each(fn (Service $service) => tap(
                CompanyProcedure::create([
                    'company_id' => $company->id,
                    'procedure_id' => $service->getProcedureId(),
                    'mac_locality_id' => $service->getMacLocality()?->id,
                    'billing_company_id' => $service->getBillingCompanyId() ?? $billingCompany->id,
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

            $procedures = CompanyProcedure::query();

            if (Gate::denies('is-admin')) {
                $procedures = $procedures->where('billing_company_id', $billingCompany->id)
                    ->with('medications');
            }

            return $procedures->get();
        });
    }

    /** @todo move to model */
    private function detachProcedures(Company $company, ?int $billingCompanyId): void
    {
        $query = $company->procedures();

        if (Gate::denies('is-admin')) {
            $query = $query->wherePivot('billing_company_id', $billingCompanyId);
        }

        $query->detach();
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
        $medications->each(
            fn (Medication $medication) => $cProcedure->medications()->updateOrCreate(
                [
                    'date' => $medication->getDate(),
                    'drug_code' => $medication->getDrugCode(),
                    'batch' => $medication->getBatch(),
                    'quantity' => $medication->getQuantity(),
                    'frequency' => $medication->getFrequency(),
                ],
                ['code' => $medication->getCode()],
            )
        );
    }
}
