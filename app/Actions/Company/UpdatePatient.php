<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\CompanyPatientWrapper;
use App\Http\Resources\Company\CompanyPatientResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class UpdatePatient
{
    public function invoke(Company $company, Collection $request): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($company, $request): AnonymousResourceCollection {
            $company->patients()
                ->when(Gate::denies('is-admin'), function ($query) {
                    $query->where('company_patient.billing_company_id', request()->user()->billing_company_id);
                })
                ->whereNotIn('company_patient.id', $request->map(
                    fn (CompanyPatientWrapper $companyPatient) => $companyPatient->getId(),
                )->toArray())
                ->detach();

            $request->each(function (CompanyPatientWrapper $companyPatient) use ($company): void {
                $company->patients()
                    ->attach($companyPatient->getPatientId(), [
                        'billing_company_id' => $companyPatient->getBillingCompanyId(),
                        'med_num' => $companyPatient->getMedicalNumber(),
                    ]);
            });

            return CompanyPatientResource::collection(
                $company->patients()
                    ->when(Gate::denies('superuser'), function ($query) {
                        $query->where('company_patient.billing_company_id', request()->user()->billing_company_id);
                    })
                    ->orderBy('id')
                    ->get(),
                $request,
            );
        });
    }
}
