<?php

declare(strict_types=1);

namespace App\Actions\HealthProfessional;

use App\Http\Resources\HealthProfessional\DoctorBodyResource;
use App\Models\HealthProfessional;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

final class GetDoctorAction
{
    public function single(HealthProfessional $doctor, User $user)
    {
        $doctor->query()
            ->when(
                Gate::check('is-admin'),
                fn (Builder $query) => $this->loadAdminModel($query),
                fn (Builder $query) => $this->loadModel($query, $user->billing_company_id)
            );

        return new DoctorBodyResource($doctor);
    }

    private function loadAdminModel(Builder &$query): void
    {
        $query->with([
            'user' => function (Builder $query) {
                $query->with(['roles']);
            },
            'taxonomies',
            'companies' => function ($query) {
                $query->with(['taxonomies', 'nicknames']);
            },
            'healthProfessionalType',
            'company' => function ($query) {
                $query->with(['taxonomies', 'nicknames']);
            },
            'privateNotes',
            'publicNote',
            'billingCompanies',
            'profile' => function (Builder $query) {
                $query->with(['socialMedias', 'addresses', 'contacts']);
            },
        ]);
    }

    private function loadModel(Builder &$query, int $bc): void
    {
        $query->with([
            'user' => function ($query) {
                $query->with(['roles']);
            },
            'taxonomies',
            'companies' => function ($query) use ($bc) {
                $query->where('billing_company_id', $bc)
                    ->with(['taxonomies', 'nicknames']);
            },
            'healthProfessionalType',
            'company' => function ($query) use ($bc) {
                $query->with([
                        'taxonomies',
                        'nicknames' => function ($q) use ($bc) {
                            $q->where('billing_company_id', $bc);
                        },
                    ]);
            },
            'privateNotes' => function ($query) use ($bc) {
                $query->where('billing_company_id', $bc);
            },
            'publicNote',
            'billingCompanies' => function ($query) use ($bc) {
                $query->where('billing_company_id', $bc);
            },
            'profile' => function ($query) use ($bc) {
                $query->with([
                    'socialMedias',
                    'addresses' => function ($query) use ($bc) {
                        $query->where('billing_company_id', $bc);
                    },
                    'contacts' => function ($query) use ($bc) {
                        $query->where('billing_company_id', $bc);
                    },
                ]);
            },
        ]);
    }
}
