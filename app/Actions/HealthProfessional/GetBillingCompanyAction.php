<?php

declare(strict_types=1);

namespace App\Actions\HealthProfessional;

use App\Http\Resources\HealthProfessional\BillingCompanyHealthProfessionalResource;
use App\Models\HealthProfessional;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class GetBillingCompanyAction
{
    public function all(User $user, HealthProfessional $doctor): AnonymousResourceCollection
    {
        $billingCompanyCollection = $doctor
            ->with('billingCompanies')
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->whereHas('billingCompanies', function (Builder $query) use ($user) {
                    $query->where('billing_company_id', $user->billing_company_id);
                })
            )
            ->get();

        return BillingCompanyHealthProfessionalResource::collection($billingCompanyCollection);
    }
}
