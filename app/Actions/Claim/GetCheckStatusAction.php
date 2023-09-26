<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\Claims\Claim;
use App\Models\Company;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class GetCheckStatusAction
{
    public function single(string $token, Claim $claim): Claim
    {
        return DB::transaction(function () use ($token, $claim) {
            $patient = Patient::query()
                ->with(
                    [
                        'insurancePolicies' => function ($query) {
                            $query->with('typeResponsibility');
                        },
                        'profile',
                    ]
                )
                ->find($claim->demographicInformation->patient_id);

            $company = Company::query()->find($claim->demographicInformation->company_id);

            $insurancePolicy = $claim->insurancePolicies->first();
            $encounter = [];
            $serviceCodes = [];

            foreach ($claim->service->services ?? [] as $service) {
                $encounter['beginningDateOfService'] = str_replace('-', '', $service->from_service);
                $encounter['endDateOfService'] = str_replace('-', '', $service->to_service);
                array_push($serviceCodes, $service->typeOfService->code);
            }
            $encounter['serviceTypeCodes'] = $serviceCodes;

            $body = [
                'controlNumber' => $claim->control_number ?? '',
                'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? null,
                'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                'provider' => [
                    'organizationName' => $company->name ?? null,
                    'npi' => $company->npi ?? null,
                    'serviceProviderNumber' => $company?->sevices_number ?? null,
                    'providerCode' => 'AD',
                    'referenceIdentification' => $company?->reference_identification ?? null,
                ],
                'subscriber' => [
                    'memberId' => $insurancePolicy->subscriber->member_id ?? null,
                    'firstName' => $insurancePolicy->subscriber->first_name ?? $patient->profile->first_name,
                    'lastName' => $insurancePolicy->subscriber->last_name ?? $patient->profile->last_name,
                    'gender' => $insurancePolicy->subscriber ? null : strtoupper($patient->profile->sex),
                    'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace('-', '', $patient->profile->date_of_birth),
                    'ssn' => $insurancePolicy->subscriber->ssn ?? $patient->profile->ssn,
                    'idCard' => $insurancePolicy->subscriber->id_card ?? null,
                ],
                'dependents' => [
                    [
                        'firstName' => $patient->profile->first_name,
                        'lastName' => $patient->profile->last_name,
                        'gender' => strtoupper($patient->profile->sex),
                        'dateOfBirth' => str_replace('-', '', $patient->profile->date_of_birth),
                        'groupNumber' => $insurancePolicy->subscriber->group_number ?? null,
                    ],
                ],
                'encounter' => $encounter,
            ];

            $response = Http::withToken($token)->acceptJson()->post(
                config('claim.connections.url_status'),
                $body
            );
            $responseData = json_decode($response->body(), true);

            return [
                'claim_id' => $claim->id,
                'response' => $responseData,
            ];
        });
    }
}
