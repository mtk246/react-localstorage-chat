<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\Claims\Claim;
use App\Models\Company;
use App\Models\Patient;
use App\Services\ClearingHouse\ClearingHouseAPI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class GetCheckStatusAction
{
    private function getByApi(string $key, Claim $claim): string
    {
        $api = new ClearingHouseAPI();

        return $api->getDataByPayerID(
            $claim->higherInsurancePlan()?->payer_id,
            $claim->higherInsurancePlan()?->name,
            $claim->type->value,
            $claim->claimTransmissionResponses->orderBy('created_at', 'desc')->first()?->claimBatch?->fake_transmission ?? false,
            $key
        );
    }

    public function single(string $token, Claim $claim)
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

            $encounter['beginningDateOfService'] = str_replace('-', '', $claim->service->from);
            $encounter['endDateOfService'] = str_replace('-', '', $claim->service->to);
            foreach ($claim->service->services ?? [] as $service) {
                if ($service->typeOfService) {
                    array_push($serviceCodes, $service->typeOfService->code);
                }
            }
            $encounter['serviceTypeCodes'] = $serviceCodes;

            $body = [
                'controlNumber' => str_pad((string) $claim->id, 9, '0', STR_PAD_LEFT),
                'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? null,
                'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                'tradingPartnerServiceId' => $this->getByApi('cpid', $claim),
                'tradingPartnerName' => $this->getByApi('name', $claim),
                'providers' => [
                    [
                        'organizationName' => $claim->billingCompany?->name,
                        'taxId' => $claim->billingCompany?->tax_id,
                        'providerType' => 'BillingProvider',
                    ],
                    [
                        'organizationName' => $company?->name,
                        'npi' => str_replace('-', '', $company?->npi ?? '') ?? null,
                        'providerType' => 'ServiceProvider',
                    ],
                ],
                'subscriber' => [
                    'memberId' => $claim->higherOrderPolicy()?->policy_number,
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

            $body = array_filter_recursive($body);

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
