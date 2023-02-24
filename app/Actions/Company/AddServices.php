<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Exceptions\User\NotHaveBillingCompany;
use App\Http\Requests\Models\Company\Service;
use App\Models\BillingCompany;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

final class AddServices
{
    public function invoke(Collection $services, Company $company, User $user)
    {
        return DB::transaction(function() use (&$company, $services, $user){
            $billingCompany = $this->getBillingCompany($user);

            $this->detachProcedures($user, $company, $billingCompany);

            $procedures = $company->procedures();

            $services->each(fn(Service $service)  => $procedures
                ->attach($service->getProcedureId(), [
                    'billing_company_id'     => $service->getBillingCompanyId() ?? $billingCompany->id,
                    'mac_locality_id'        => $service->getMacLocality(),
                    'price'                  => $service['price'] ?? null,
                    'price_percentage'       => $service['price_percentage'] ?? null,
                    'modifier_id'            => $service['modifier_id'] ?? null,
                    'insurance_label_fee_id' => $service['insurance_label_fee_id'] ?? null,
                    'clia'                   => $service['clia'] ?? null,
                ])
            );

            if($user->cannot('super')) {
                $procedures = $procedures->wherePivot('billing_company_id', $billingCompany->id);
            }

            return $procedures->get();
        });

    }

    /** @todo move to model */
    private function getBillingCompany(User $user): BillingCompany
    {
        $billingCompany = $user->billingCompanies->first();

        if($user->cannot('super') && is_null($billingCompany)) {
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
}
