<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Http\Resources\InsurancePlan\InsurancePlanResource;
use App\Models\InsurancePlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetInsurancePlan
{
    public function single(InsurancePlan $insurance, User $user): InsurancePlanResource
    {
        return DB::transaction(function () use ($insurance, $user) {
            $insurance->query()
                ->when(
                    Gate::check('is-admin'),
                    fn (Builder $query) => $this->loadModel($query, $user->billing_company_id)
                );

            return InsurancePlanResource::make($insurance);
        });
    }

    private function loadModel(Builder &$query, int $bC): void
    {
        $query->with([
            'billingCompanies' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
        ]);
    }
}
