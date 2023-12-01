<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Models\Company;
use App\Models\CompanyHealthProfessionalType;
use App\Models\HealthProfessional;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class GetBilllingProviderAction
{
    public function all(array $request, User $user): array
    {
        $companyId = $request['company_id'] ?? null;
        $billingCompanyId = Gate::denies('is-admin')
            ? $user->billing_company_id
            : $request['billing_company_id'] ?? null;

        $billing_provider = CompanyHealthProfessionalType::whereType('Billing provider')->first();
        $healthProfessionals = HealthProfessional::query()
            ->with('profile', 'companies')
            ->whereHas('billingCompanies', function ($query) use ($billingCompanyId) {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereHas('companies', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->get()
            ->when(empty($request['all_health_professional']), function ($query) use ($billing_provider) {
                return $query->filter(function (HealthProfessional $healthProfessional) use ($billing_provider) {
                    foreach ($healthProfessional->companies_providers as $provider) {
                        $auth = $provider->authorization->map(function ($item) {
                            return $item->value;
                        })->toArray() ?? [];

                        return in_array($billing_provider->id, $auth);
                    }
                });
            })
            ->map(function (HealthProfessional $healthProfessional) {
                $taxIdOptions = [];

                if (!empty($healthProfessional->ein)) {
                    $taxIdOptions[] = [
                        'id' => str_replace('-', '', $healthProfessional->ein ?? ''),
                        'name' => 'EIN - '.str_replace('-', '', $healthProfessional->ein ?? ''),
                    ];
                }

                if (!empty($healthProfessional->profile?->ssn)) {
                    $taxIdOptions[] = [
                        'id' => str_replace('-', '', $healthProfessional->profile->ssn ?? ''),
                        'name' => 'SSN - '.str_replace('-', '', $healthProfessional->profile->ssn ?? ''),
                    ];
                }

                return [
                    'id' => 'healthProfessional:'.$healthProfessional->id,
                    'name' => $healthProfessional?->profile->first_name.' '.$healthProfessional?->profile->last_name,
                    'npi' => $healthProfessional->npi,
                    'tax_id_options' => $taxIdOptions,
                    'taxonomy_options' => $healthProfessional->taxonomies->map(fn ($model) => [
                        'id' => $model->id,
                        'name' => $model->tax_id.' - '.$model->name,
                        'primary' => $model->primary,
                    ]),
                ];
            })
            ->toArray();

        $company = Company::query()->find($companyId);

        $taxIdOptions = [];
        if (!empty($company->ein)) {
            $taxIdOptions[] = [
                'id' => str_replace('-', '', $company->ein ?? ''),
                'name' => 'EIN - '.str_replace('-', '', $company->ein ?? ''),
            ];
        }

        return empty($request['all_health_professional'])
            ? array_merge(
                [
                    [
                        'id' => 'company:'.$company->id,
                        'name' => $company->name,
                        'npi' => str_replace('-', '', $company->npi ?? ''),
                        'tax_id_options' => $taxIdOptions,
                        'taxonomy_options' => $company->taxonomies->map(fn ($model) => [
                            'id' => $model->id,
                            'name' => $model->tax_id.' - '.$model->name,
                            'primary' => $model->primary,
                        ]),
                    ],
                ],
                $healthProfessionals
            ) : $healthProfessionals;
    }
}
