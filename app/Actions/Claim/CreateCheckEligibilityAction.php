<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\Claims\ClaimEligibility;
use App\Models\Claims\ClaimEligibilityStatus;
use App\Models\Company;
use App\Models\Patient;
use App\Models\TypeOfService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class CreateCheckEligibilityAction
{
    public function invoke(string $token, array $data): ?array
    {
        try {
            DB::beginTransaction();
            $dataENV = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3',
                    'body' => [
                        'controlNumber' => '123456789',
                        'tradingPartnerServiceId' => 'CMSMED',
                        'provider' => [
                            'organizationName' => 'provider_name',
                            'npi' => '0123456789',
                            'serviceProviderNumber' => '54321',
                            'providerCode' => 'AD',
                            'referenceIdentification' => '54321g',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000000',
                            'firstName' => 'johnOne',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '18800102',
                            'ssn' => '555443333',
                            'idCard' => 'card123',
                        ],
                        'dependents' => [
                            [
                                'firstName' => 'janeOne',
                                'lastName' => 'doeone',
                                'gender' => 'F',
                                'dateOfBirth' => '18160421',
                                'groupNumber' => '1111111111',
                            ],
                        ],
                        'encounter' => [
                            'beginningDateOfService' => '20100102',
                            'endDateOfService' => '20100102',
                            'serviceTypeCodes' => [
                              '98',
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/eligibility/v3',
                    'body' => null,
                ],
            ];

            $patient = Patient::query()
                ->with(
                    [
                        'insurancePolicies' => function ($query) {
                            $query->with('typeResponsibility');
                        },
                        'user.profile',
                    ]
                )
                ->find($data['demographic_information']['patient_id']);
            $insurancePolicies = [];
            $company = Company::query()
                ->find($data['demographic_information']['company_id']);

            foreach ($patient->insurancePolicies ?? [] as $insurancePolicy) {
                $newCode = 1;
                $targetModel = ClaimEligibility::query()
                    ->select('id', 'control_number')
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')
                    ->first();

                $newCode += ($targetModel) ? (int) $targetModel->control_number : 0;
                $newCode = str_pad((string) $newCode, 9, '0', STR_PAD_LEFT);

                if ($data['demographic_information']['automatic_eligibility']) {
                    $encounter = [];
                    $serviceCodes = [];

                    foreach ($data['claim_services']['services'] ?? [] as $service) {
                        $typeOfService = TypeOfService::query()
                            ->find($service['type_of_service_id']);
                        $encounter['beginningDateOfService'] = str_replace('-', '', $service['from_service']);
                        $encounter['endDateOfService'] = str_replace('-', '', $service['to_service']);
                        array_push($serviceCodes, $typeOfService->code);
                    }
                    $encounter['serviceTypeCodes'] = $serviceCodes;

                    $dataReal = [
                        'controlNumber' => $newCode,
                        'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany?->payer_id ?? null,
                        'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                        'provider' => [
                            'organizationName' => $company->name ?? null,
                            'npi' => $company->npi ?? null,
                            'serviceProviderNumber' => $company?->sevices_number ?? null,
                            'providerCode' => 'AD',
                            'referenceIdentification' => $company?->reference_identification ?? null,
                        ],
                        'subscriber' => [
                            'memberId' => $insurancePolicy->subscriber?->member_id ?? null,
                            'firstName' => $insurancePolicy->subscriber->first_name ?? $patient->user->profile->first_name,
                            'lastName' => $insurancePolicy->subscriber->last_name ?? $patient->user->profile->last_name,
                            'gender' => $insurancePolicy->subscriber ? null : strtoupper($patient->user->profile->sex),
                            'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace('-', '', $patient->user->profile->date_of_birth),
                            'ssn' => $insurancePolicy->subscriber->ssn ?? $patient->user->profile->ssn,
                            'idCard' => $insurancePolicy->subscriber->id_card ?? null,
                        ],
                        'dependents' => [
                            [
                                'firstName' => $patient->user->profile->first_name,
                                'lastName' => $patient->user->profile->last_name,
                                'gender' => strtoupper($patient->user->profile->sex),
                                'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                                'groupNumber' => $insurancePolicy->subscriber->group_number ?? null,
                            ],
                        ],
                        'encounter' => $encounter,
                    ];

                    $response = Http::withToken($token)->acceptJson()->post(
                        $dataENV[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                        $dataENV[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
                    );
                    $responseData['response'] = json_decode($response->body());
                    $responseData['request'] = $dataReal;

                    $claimEligibilityStatus = match (true) {
                        $response->successful() => ClaimEligibilityStatus::whereStatus('Eligible policy')->first(),
                        $response->serverError() => ClaimEligibilityStatus::whereStatus('Unknow')->first(),
                        default => ClaimEligibilityStatus::whereStatus('Ineligible policy')->first(),
                    };
                } else {
                    $eligibilityCurrent = $insurancePolicy
                        ->claimEligibilities()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'asc')
                        ->first();
                    $claimEligibilityStatus = isset($eligibilityCurrent)
                        ? $eligibilityCurrent->claimEligibilityStatus
                        : ClaimEligibilityStatus::query()
                            ->whereStatus('Unknow')
                            ->first();
                }

                $claimEligibility = ClaimEligibility::updateOrCreate([
                    'control_number' => $newCode,
                    'company_id' => $company->id,
                    'patient_id' => $patient->id,
                    'subscriber_id' => $insurancePolicy->subscriber->id ?? null,
                    'insurance_policy_id' => $insurancePolicy->id,
                    'claim_eligibility_status_id' => $claimEligibilityStatus->id,
                    'response_details' => isset($responseData) ? json_encode($responseData) : null,
                    'insurance_company_id' => $insurancePolicy->insurance_company_id,
                ]);

                $claimEligibilityCurrent = ClaimEligibility::query()
                    ->with(['claimEligibilityStatus'])
                    ->find($claimEligibility->id);
                $insurancePolicy['claim_eligibility'] = (isset($claimEligibilityCurrent))
                    ? [
                        'control_number' => $claimEligibilityCurrent->control_number ?? null,
                        'insurance_policy' => $claimEligibilityCurrent->insurancePolicy ?? null,
                        'insurance_policy_id' => $claimEligibilityCurrent->insurance_policy_id ?? null,
                        'response_details' => json_decode($claimEligibilityCurrent->response_details ?? ''),
                        'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                        'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                    ]
                    : null;

                array_push($insurancePolicies, $insurancePolicy);
            }
            $order = ['P', 'S', 'T'];

            usort($insurancePolicies, function ($a, $b) use ($order) {
                $a_index = array_search($a->typeResponsibility->code, $order);
                $b_index = array_search($b->typeResponsibility->code, $order);

                return $a_index - $b_index;
            });

            DB::commit();

            return [
                'insurance_policies' => $insurancePolicies,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }
}
