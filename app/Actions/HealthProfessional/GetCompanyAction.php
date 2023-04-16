<?php

declare(strict_types=1);

namespace App\Actions\HealthProfessional;

use App\Http\Resources\HealthProfessional\CompanyHealthProfessionalResource;
use App\Models\CompanyHealthProfessional;
use App\Models\HealthProfessional;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class GetCompanyAction
{
    public function all(User $user, HealthProfessional $doctor): AnonymousResourceCollection
    {
        $companyCollection = CompanyHealthProfessional::query()
            ->where('health_professional_id', $doctor->id)
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $user->profile->billing_company_id),
            )
            ->with([
                'company',
                'healthProfessional',
            ])
            ->get();

        return CompanyHealthProfessionalResource::collection($companyCollection);
    }
}
