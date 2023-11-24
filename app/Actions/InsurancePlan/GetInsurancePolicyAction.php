<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Models\InsurancePolicy;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

final class GetInsurancePolicyAction
{
    public function allPrimary(Patient $patient, array $request, User $user): array
    {
        return InsurancePolicy::query()
            ->select('id', 'policy_number as name')
            ->when(Gate::allows('is-admin'), function (Builder $query) use ($request) {
                $query->where('billing_company_id', $request['billing_company_id'] ?? null);
            },
                function (Builder $query) use ($user) {
                    $query->where('billing_company_id', $user->billing_company_id);
                })
            ->where('patient_id', $patient->id)
            ->whereHas('typeResponsibility', function (Builder $query) {
                $query->where('code', 'P');
            })
            ->toBase()
            ->get('id', 'name')
            ->toArray() ?? [];
    }
}
