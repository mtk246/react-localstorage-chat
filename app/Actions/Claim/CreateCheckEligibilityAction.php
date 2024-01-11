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

            $patient = Patient::query()
                ->with(
                    [
                        'insurancePolicies' => function ($query) {
                            $query->with('typeResponsibility');
                        },
                        'profile',
                    ]
                )
                ->find($data['demographic_information']['patient_id']);
            $insurancePolicies = [];
            $company = Company::query()
                ->find($data['demographic_information']['company_id']);

            foreach ($patient->insurancePolicies ?? [] as $insurancePolicy) {
                if (false == $insurancePolicy->status) {
                    continue;
                }

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
                            ->find($service['type_of_service_id'] ?? null);
                        $encounter['beginningDateOfService'] = str_replace('-', '', $service['from_service']);
                        $encounter['endDateOfService'] = str_replace('-', '', $service['to_service']);
                        if ($typeOfService) {
                            array_push($serviceCodes, $typeOfService->code);
                        }
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
                        config('claim.connections.url_eligibility'),
                        $dataReal
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
                $insurancePolicy['note'] = '';

                array_push($insurancePolicies, $insurancePolicy);
            }
            $order = ['P', 'S', 'T'];

            usort($insurancePolicies, function ($a, $b) use ($order) {
                $a_index = array_search($a->typeResponsibility->code, $order);
                $b_index = array_search($b->typeResponsibility->code, $order);

                return $a_index - $b_index;
            });

            array_push($insurancePolicies, [
                'id' => 0,
                'own' => true,
                'status' => true,
                'eff_date' => null,
                'end_date' => null,
                'release_info' => false,
                'assign_benefits' => false,
                'policy_number' => 'Self Pay',
                'group_number' => 'Self Pay',
                'insurance_plan_id' => null,
                'insurance_policy_type_id' => null,
                'type_responsibility_id' => null,
                'type_responsibility' => [
                    'code' => 'SP',
                ],
                'payer_responsibility_id' => null,
                'payment_responsibility_level_code' => null,
                'patient_id' => $patient->id,
                'billing_company_id' => $data['billing_company_id'] ?? null,
                'claim_elegibility' => null,
                'note' => ' The patient will pay for the service',
            ]);

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
