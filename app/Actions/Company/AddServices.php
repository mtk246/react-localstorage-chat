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

final class AddServices
{
    public function invoke(Collection $services, Company $company, User $user): Collection
    {
        return DB::transaction(function () use ($company, $services, $user) {
            $billingCompany = $this->getBillingCompany($user);

            $this->detachProcedures($user, $company, $billingCompany);

            $procedures = $company->procedures();

            $services->each(fn (Service $service) => tap(
                CompanyProcedure::create([
                    'billing_company_id' => $service->getBillingCompanyId() ?? $billingCompany->id,
                    'mac_locality_id' => $service->getMacLocality(),
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

            if ($user->cannot('super')) {
                $procedures = $procedures->wherePivot('billing_company_id', $billingCompany->id);
            }

            return $procedures->get();
        });
    }

    /** @todo move to model */
    private function getBillingCompany(User $user): BillingCompany
    {
        $billingCompany = $user->billingCompanies->first();

        if ($user->cannot('super') && is_null($billingCompany)) {
            throw new NotHaveBillingCompany();
        }

        return $billingCompany;
    }

    /** @todo move to model */
    private function detachProcedures(User $user, Company $company, BillingCompany $billingCompany): void
    {
        $query = $company->procedures();

        if ($user->cannot('super')) {
            $query = $query->wherePivot('billing_company_id', $billingCompany->id);
        }

        $query->detach();
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
