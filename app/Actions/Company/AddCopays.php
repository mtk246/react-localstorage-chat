<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Requests\Casts\CopayRequestCast;
use App\Models\Company;
use App\Models\Copay;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class AddCopays
{
    public function invoke(Collection $copays, Company $company): Collection
    {
        return DB::transaction(function () use ($copays, $company): Collection {
            $company->copays()->update(['company_id' => null]);

            $copays->each(fn (CopayRequestCast $copayData) => tap(
                Copay::create([
                    'billing_company_id' => $copayData->getBillingCompanyId(),
                    'insurance_plan_id' => $copayData->getInsurancePlanId(),
                    'insurance_company_id' => $copayData->getInsuranceCompanyId(),
                    'company_id' => $company->id,
                    'copay' => $copayData->getCopay(),
                    'private_note' => $copayData->getPrivateNote(),
                ]),
                fn (Copay $copay) => $this->afterCreate($copay, $copayData->getProceduresIds())
            ));

            return $company->copays()->get();
        });
    }

    private function afterCreate(Copay $copay, Collection $proceduresIds): void
    {
        $proceduresIds->each(
            fn (int $procedureId) => $copay->procedures()->attach($procedureId)
        );
    }
}
