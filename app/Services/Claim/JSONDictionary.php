<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FormatType;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

final class JSONDictionary extends Dictionary
{
    protected string $format = FormatType::JSON->value;

    protected function getSingleArrayFormat(string $value): array
    {
        return array_filter_recursive($this->getSingleFormat($value)->toArray());
    }

    protected function getClaimAttribute(string $key): string|Collection|null
    {
        return match ($key) {
            'controlNumber' => str_pad((string) $this->claim->id, 9, '0', STR_PAD_LEFT),
            'tradingPartnerServiceId' => '9496', /* Caso de prueba */
            'tradingPartnerName' => 'Begento Technologies LLC',
            'usageIndicator' => 'T',  /* Caso de prueba */
            default => collect($this->{'get'.Str::ucfirst(Str::camel($key))}()),
        };
    }

    protected function getSubmitter(): array
    {
        return match ($this->claim->type) {
            ClaimType::PROFESSIONAL => [
                'organizationName' => $this->claim->billingCompany->name,
                // 'lastName' => 'doeOne',
                // 'firstName' => 'janeone',
                // 'middleName' => 'middleone',
                'contactInformation' => [
                    'name' => $this->claim->billingCompany->contact?->contact_name ?? $this->claim->billingCompany->name ?? 'Contact Billing',
                    'phoneNumber' => str_replace('-', '', $this->claim->billingCompany->contact?->phone ?? ''),
                    'faxNumber' => str_replace('-', '', $this->claim->billingCompany->contact?->fax ?? ''),
                    'email' => $this->claim->billingCompany->contact?->email ?? '',
                    // 'phoneExtension' => '1234'
                ],
            ],
            ClaimType::INSTITUTIONAL => [
                'organizationName' => $this->claim->billingCompany->name,
                'taxId' => $this->claim->billingCompany?->tax_id,
                'contactInformation' => [
                    'name' => $this->claim->billingCompany->contact?->contact_name ?? $this->claim->billingCompany->name ?? 'Contact Billing',
                    'phoneNumber' => str_replace('-', '', $this->claim->billingCompany->contact?->phone ?? ''),
                    'faxNumber' => str_replace('-', '', $this->claim->billingCompany->contact?->fax ?? ''),
                    'email' => $this->claim->billingCompany->contact?->email ?? '',
                    'validContact' => true,
                ],
            ],
            default => [],
        };
    }

    protected function getReceiver(): array
    {
        return [
            'organizationName' => $this->claim->higherInsurancePlan()?->insuranceCompany?->name ?? null,
        ];
    }

    protected function getSubscriber(): array
    {
        $subscriber = $this->claim->subscriber();
        $subscriberAddress = $subscriber?->addresses()
            ?->first() ?? null;
        $subscriberContact = $subscriber?->contacts()
            ->first() ?? null;

        return match ($this->claim->type) {
            ClaimType::PROFESSIONAL => [
                'memberId' => $subscriber->member_id ?? $subscriber->id,
                'ssn' => $subscriber->ssn,
                'paymentResponsibilityLevelCode' => $this->claim->higherOrderPolicy()?->typeResponsibility?->code ?? 'U',
                // 'organizationName' => 'string',
                // 'insuranceTypeCode' => '12',
                // 'subscriberGroupName' => 'Subscriber Group Name',
                'firstName' => $subscriber->first_name,
                'lastName' => $subscriber->last_name,
                'middleName' => $subscriber->middle_name ?? null,
                'suffix' => $subscriber->nameSuffix?->code ?? null,
                'gender' => strtoupper($subscriber->sex ?? 'U'),
                'dateOfBirth' => str_replace('-', '', $subscriber->date_of_birth),
                'policyNumber' => $this->claim->higherOrderPolicy()->policy_number ?? null,
                // 'groupNumber' => 'string',

                'contactInformation' => [
                    'name' => $subscriberContact->contact_name ?? $subscriber->first_name,
                    'phoneNumber' => str_replace('-', '', $subscriberContact?->phone ?? '') ?? null,
                    'faxNumber' => str_replace('-', '', $subscriberContact?->fax ?? '') ?? null,
                    'email' => $subscriberContact?->email,
                    // 'phoneExtension' => '1234'
                ],
                'address' => [
                    'address1' => $subscriberAddress?->address,
                    'address2' => null,
                    'city' => $subscriberAddress?->city,
                    'state' => substr($subscriberAddress?->state ?? '', 0, 2) ?? null,
                    'postalCode' => str_replace('-', '', $subscriberAddress?->zip ?? '') ?? null,
                    'countryCode' => $subscriberAddress?->country,
                    'countrySubDivisionCode' => $subscriberAddress?->country_subdivision_code,
                ],
            ],
            ClaimType::INSTITUTIONAL => [
                'memberId' => $subscriber->member_id ?? $subscriber->id,
                'standardHealthId' => '', /* Identificador sanitario, se envia si no se envia el memberId */
                'ssn' => $subscriber->ssn,
                'firstName' => $subscriber->first_name,
                'lastName' => $subscriber->last_name,
                'middleName' => $subscriber->middle_name ?? null,
                'suffix' => $subscriber->nameSuffix?->code ?? null,
                'gender' => strtoupper($subscriber->sex ?? 'U'),
                'dateOfBirth' => str_replace('-', '', $subscriber->date_of_birth),
                // 'groupNumber' => 'string',
                'paymentResponsibilityLevelCode' => $this->claim->higherOrderPolicy()->payment_responsibility_level_code,
                'address' => [
                    'address1' => $subscriberAddress?->address,
                    'address2' => null,
                    'city' => $subscriberAddress?->city,
                    'state' => substr($subscriberAddress?->state ?? '', 0, 2) ?? null,
                    'postalCode' => str_replace('-', '', $subscriberAddress?->zip ?? '') ?? null,
                    'countryCode' => $subscriberAddress?->country,
                    'countrySubDivisionCode' => $subscriberAddress?->country_subdivision_code,
                ],
            ],
        };
    }

    protected function getDependent(): ?array
    {
        $patient = $this->claim
            ?->demographicInformation
            ?->patient;
        $patientAddress = $patient?->profile?->addresses()
            ?->first() ?? null;
        $patientContact = $patient?->profile->contacts()
            ->first() ?? null;

        if (true == ($this->claim->higherOrderPolicy()?->own ?? false)) {
            return null;
        }

        return match ($this->claim->type) {
            ClaimType::PROFESSIONAL => [
                'firstName' => $patient->profile->first_name,
                'lastName' => $patient->profile->last_name,
                'middleName' => $patient->profile->middle_name ?? null,
                'suffix' => $patient->profile?->nameSuffix?->code,
                'gender' => strtoupper($patient->profile?->sex ?? 'U'),
                'dateOfBirth' => str_replace('-', '', $patient->profile?->date_of_birth ?? ''),
                'ssn' => $patient->profile?->ssn,
                'memberId' => $patient->code,
                'relationshipToSubscriberCode' => $this->claim->subscriber()->relationship->code ?? '21',
                'contactInformation' => [
                    'name' => $patientContact?->contact_name ?? $patient->profile->first_name,
                    'phoneNumber' => str_replace('-', '', $patientContact?->phone ?? '') ?? null,
                    'faxNumber' => str_replace('-', '', $patientContact?->fax ?? '') ?? null,
                    'email' => $patientContact?->email,
                    'phoneExtension' => null,
                ],
                'address' => [
                    'address1' => $patientAddress?->address,
                    'address2' => null,
                    'city' => $patientAddress?->city,
                    'state' => substr($patientAddress?->state ?? '', 0, 2) ?? null,
                    'postalCode' => str_replace('-', '', $patientAddress?->zip ?? '') ?? null,
                    'countryCode' => $patientAddress?->country,
                    'countrySubDivisionCode' => $patientAddress?->country_subdivision_code,
                ],
            ],
            ClaimType::INSTITUTIONAL => [
                'firstName' => $patient->profile->first_name,
                'lastName' => $patient->profile->last_name,
                'middleName' => $patient->profile->middle_name ?? null,
                'suffix' => $patient->profile?->nameSuffix?->code,
                'gender' => strtoupper($patient->profile?->sex ?? 'U'),
                'dateOfBirth' => str_replace('-', '', $patient->profile?->date_of_birth ?? ''),
                'ssn' => $patient->profile?->ssn,
                'relationshipToSubscriberCode' => $this->claim->subscriber()->relationship->code ?? '21',
                'address' => [
                    'address1' => $patientAddress?->address,
                    'address2' => null,
                    'city' => $patientAddress?->city,
                    'state' => substr($patientAddress?->state ?? '', 0, 2) ?? null,
                    'postalCode' => str_replace('-', '', $patientAddress?->zip ?? '') ?? null,
                    'countryCode' => $patientAddress?->country,
                    'countrySubDivisionCode' => $patientAddress?->country_subdivision_code,
                ],
            ],
        };
    }

    protected function getClaimInformation(): array
    {
        $claimServiceLinePrincipal = $this->claim->service->services->first();
        $diagnosisPrincipal = $this->claim->service->diagnoses->first();
        $admittingDiagnosis = $this->claim->service->diagnoses->first(function ($diagnosis) {
            return $diagnosis->pivot->admission ?? false;
        });
        $relatedCausesCode = array_filter([
            (true === $this->claim->demographicInformation?->auto_accident_related_condition) ? 'AA' : null,
            (true === $this->claim->demographicInformation?->employment_related_condition) ? 'EM' : null,
            (true === $this->claim->demographicInformation?->other_accident_related_condition) ? 'OA' : null,
        ]);
        $pointers = [
            'A' => 1,
            'B' => 2,
            'C' => 3,
            'D' => 4,
            'E' => 5,
            'F' => 6,
            'G' => 7,
            'H' => 8,
            'I' => 9,
            'J' => 10,
            'K' => 11,
            'L' => 12,
        ];
        $qualifierFields = [
            // '' => 'lastMenstrualPeriodDate',
            // '' => 'disabilityBeginDate',
            // '' => 'disabilityEndDate',
            // '' => 'lastWorkedDate',
            // '' => 'authorizedReturnToWorkDate',
            // '' => 'admissionDate',
            // '' => 'dischargeDate',
            // '' => 'repricerReceivedDate',
            '431' => 'symptomDate',
            '304' => 'lastSeenDate',
            '444' => 'firstContactDate',
            '453' => 'acuteManifestationDate',
            '439' => 'accidentDate',
            '455' => 'lastXRayDate',
            '090' => 'assumedAndRelinquishedCareBeginDate',
            '091' => 'assumedAndRelinquishedCareEndDate',
            '454' => 'initialTreatmentDate',
            '471' => 'hearingAndVisionPrescriptionDate',
        ];
        $claimDateInfo = [];
        foreach ($this->claim->dateInformations ?? [] as $dateInfo) {
            $qualifier = $dateInfo?->qualifier?->code ?? '';
            if (isset($qualifierFields[$qualifier])) {
                if ((1 == $dateInfo->field_id) || (2 == $dateInfo->field_id)) {
                    $claimDateInfo[$qualifierFields[$qualifier]] = $dateInfo->from_date;
                } elseif (3 == $dateInfo->field_id) {
                    $claimDateInfo['lastWorkedDate'] = $dateInfo->from_date;
                    $claimDateInfo['authorizedReturnToWorkDate'] = $dateInfo->to_date;
                } elseif (4 == $dateInfo->field_id) {
                    $claimDateInfo['admissionDate'] = $dateInfo->from_date;
                    $claimDateInfo['dischargeDate'] = $dateInfo->to_date;
                }
            }
        }
        $serviceLines = [];
        foreach ($this->claim->service->services ?? [] as $service) {
            $valuesPoint = [];
            foreach ($service->diagnostic_pointers as $point) {
                array_push($valuesPoint, $pointers[$point]);
            }
            array_push($serviceLines, [
                'serviceDate' => str_replace('-', '', $service->from_service),
                'serviceDateEnd' => !empty($service->to_service)
                    ? str_replace('-', '', $service->to_service)
                    : null,
                'professionalService' => [
                    'procedureIdentifier' => 'HC' /* No esta, Loop2400 SV101-01 * */,
                    'lineItemChargeAmount' => str_replace(',', '', $service->price),
                    'procedureCode' => $service->procedure->code,
                    'measurementUnit' => 'UN', /**Si es el mismo dias se expresa en min 'MJ' */
                    'serviceUnitCount' => $service->days_or_units ?? '1',
                    'compositeDiagnosisCodePointers' => [
                        'diagnosisCodePointers' => $valuesPoint ?? [],
                    ],
                ],
            ]);
        }

        return match ($this->claim->type) {
            ClaimType::PROFESSIONAL => [
                'claimFilingCode' => 'CI',
                // 'propertyCasualtyClaimNumber' => 'string',
                // 'deathDate' => 'string',
                // 'patientWeight' => 'string',
                // 'pregnancyIndicator' => 'Y',
                'patientControlNumber' => $this->claim->demographicInformation?->patient?->code,
                'claimChargeAmount' => str_replace(',', '', $this->claim->billed_amount ?? '0.00'),
                'placeOfServiceCode' => $claimServiceLinePrincipal?->placeOfService?->code ?? '11',
                'claimFrequencyCode' => '1',
                'signatureIndicator' => isset($this->claim->demographicInformation)
                    ? ((true === $this->claim->demographicInformation->insured_signature)
                        ? 'Y'
                        : 'N')
                    : 'N',
                'planParticipationCode' => 'A', /* Código que indica si el proveedor aceptó la asignación.
                * A = Asignado
                * B = Asignación aceptada sólo en servicios de laboratorio clínico
                * C = No asignado */
                'benefitsAssignmentCertificationIndicator' => isset($this->claim->demographicInformation)
                    ? ((true === $this->claim->demographicInformation->accept_assignment)
                        ? 'Y'
                        : 'N')
                    : 'N',
                'releaseInformationCode' => 'Y', /* Código que indica si el proveedor tiene archivada una declaración firmada por el paciente autorizando la divulgación de datos médicos a otras organizaciones.
                * Informado = I, Sí = Y */
                // 'patientSignatureSourceCode' => false,
                'relatedCausesCode' => $relatedCausesCode,
                'autoAccidentStateCode' => in_array('AA', $relatedCausesCode) ? 'AA' : null,
                'autoAccidentCountryCode' => $this->claim->demographicInformation?->auto_accident_place_state,
                // 'specialProgramCode' => '02', /** Servicios especiales solo para medicaid */
                // 'delayReasonCode' => '1', /** Código de retraso */
                // 'patientAmountPaid' => 'string', /** Monto pagado por el paciente AMT02 */
                // 'fileInformation' => 'string', /** El segmento K3 sólo se utiliza para cumplir un requisito de datos inesperado de una autoridad legislativa. */
                /* 'fileInformationList' => [
                    'string'
                ],*/

                'claimDateInformation' => !empty($claimDateInfo) ? $claimDateInfo : null,
                /**'claimContractInformation' => [
                    'contractTypeCode' => '01', // Código que identifica un tipo de contrato. 02 -> Por dia
                    'contractAmount' => 'string',
                    'contractPercentage' => 'string',
                    'contractCode' => 'string',
                    'termsDiscountPercentage' => 'string',
                    'contractVersionIdentifier' => 'string'
                ],*/
                'claimSupplementalInformation' => [
                    /*'reportInformation' => [
                        'attachmentReportTypeCode' => '93',
                        'attachmentTransmissionCode' => 'AA',
                        'attachmentControlNumber' => 'string'
                    ],*/
                    'priorAuthorizationNumber' => $this->claim->demographicInformation?->prior_authorization_number ?? '',
                    'referralNumber' => '',
                    'claimControlNumber' => '',
                    'cliaNumber' => '',
                    'repricedClaimNumber' => '',
                    'adjustedRepricedClaimNumber' => '',
                    'investigationalDeviceExemptionNumber' => '',
                    'claimNumber' => '',
                    'mammographyCertificationNumber' => '',
                    'medicalRecordNumber' => '',
                    'demoProjectIdentifier' => '',
                    'carePlanOversightNumber' => '',
                    'medicareCrossoverReferenceId' => '',
                    'serviceAuthorizationExceptionCode' => '',
                ],
                /**'claimNote' => [
                    'additionalInformation' => 'string',
                    'certificationNarrative' => 'string',
                    'goalRehabOrDischargePlans' => 'string',
                    'diagnosisDescription' => 'string',
                    'thirdPartOrgNotes' => 'string'
                ],*/
                /**'ambulanceTransportInformation' => [
                    'patientWeightInPounds' => 'string',
                    'ambulanceTransportReasonCode' => 'A',
                    'transportDistanceInMiles' => 'string',
                    'roundTripPurposeDescription' => 'string',
                    'stretcherPurposeDescription' => 'string'
                ],*/
                /**'spinalManipulationServiceInformation' => [
                    'patientConditionCode' => 'string',
                    'patientConditionDescription1' => 'A',
                    'patientConditionDescription2' => 'string'
                ],*/
                /**'ambulanceCertification' => [
                    [
                        'certificationConditionIndicator' => 'N',
                        'conditionCodes' => [
                            '01'
                        ]
                    ]
                ],*/
                /**'patientConditionInformationVision' => [
                    [
                        'codeCategory' => 'E1',
                        'certificationConditionIndicator' => 'N',
                        'conditionCodes' => [
                            'L1'
                        ]
                    ]
                ],*/
                'homeboundIndicator' => true,
                'epsdtReferral' => [
                    'certificationConditionCodeAppliesIndicator' => isset($claimServiceLinePrincipal?->epsdt?->code) ? 'Y' : 'N',
                    'conditionCodes' => [
                        $claimServiceLinePrincipal?->epsdt?->code ?? 'NU',
                    ],
                ],
                'healthCareCodeInformation' => $this->claim->service->diagnoses
                    ->map(fn ($diagnosis, $index) => [
                        'diagnosisTypeCode' => (0 == $index) ? 'ABK' : 'ABF',
                        'diagnosisCode' => $diagnosis->code,
                    ]
                    ),
                /**'anesthesiaRelatedSurgicalProcedure' => [
                            'string'
                        ],*/
                /**'conditionInformation' => [
                            [
                                'conditionCodes' => [
                                    'string'
                                ]
                            ]
                        ],*/
                /**'claimPricingRepricingInformation' => [
                            'pricingMethodologyCode' => '01',
                            'repricedAllowedAmount' => '1',
                            'repricedSavingAmount' => 'string',
                            'repricingOrganizationIdentifier' => 'string',
                            'repricingPerDiemOrFlatRateAmoung' => 'string',
                            'repricedApprovedAmbulatoryPatientGroupCode' => 'string',
                            'repricedApprovedAmbulatoryPatientGroupAmount' => 'string',
                            'rejectReasonCode' => 'T1',
                            'policyComplianceCode' => '1',
                            'exceptionCode' => '1'
                        ],*/
                'serviceFacilityLocation' => [
                    'organizationName' => $this->getFacilityAttribute('name'),
                    'address' => [
                        'address1' => $this->getFacilityAddressAttribute('address', '1'),
                        'address2' => null,
                        'city' => $this->getFacilityAddressAttribute('city', '1'),
                        'state' => $this->getFacilityAddressAttribute('state', '1'),
                        'postalCode' => $this->getFacilityAddressAttribute('zip', '1'),
                        'countryCode' => $this->getFacilityAddressAttribute('country', '1'),
                        'countrySubDivisionCode' => $this->getFacilityAddressAttribute('country_subdivision_code', '1'),
                    ],
                    'npi' => $this->getFacilityAttribute('npi'),
                    /**'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ],*/
                    'phoneName' => $this->getFacilityContactAttribute('contact_name', '1'),
                    'phoneNumber' => $this->getFacilityContactAttribute('phone', '1'),
                    // 'phoneExtension' => 'string'
                ],
                /**'ambulancePickUpLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => 'string',
                            'countrySubDivisionCode' => 'string'
                        ],*/
                /**'ambulanceDropOffLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => 'string',
                            'countrySubDivisionCode' => 'string'
                        ],*/
                /*'otherSubscriberInformation' => [
                            [
                                'paymentResponsibilityLevelCode' => 'A',
                                'individualRelationshipCode' => '01',
                                'insuranceGroupOrPolicyNumber' => 'string',
                                'otherInsuredGroupName' => 'string',
                                'insuranceTypeCode' => '12',
                                'claimFilingIndicatorCode' => '11',
                                'claimLevelAdjustments' => [
                                    [
                                        'adjustmentGroupCode' => 'CO',
                                        'adjustmentDetails' => [
                                            [
                                                'adjustmentReasonCode' => 'string',
                                                'adjustmentAmount' => 'string',
                                                'adjustmentQuantity' => 'string'
                                            ]
                                        ]
                                    ]
                                ],
                                'payerPaidAmount' => 'string',
                                'nonCoveredChargeAmount' => 'string',
                                'remainingPatientLiability' => 'string',
                                'benefitsAssignmentCertificationIndicator' => 'N',
                                'patientSignatureGeneratedForPatient' => true,
                                'releaseOfInformationCode' => 'I',
                                'medicareOutpatientAdjudication' => [
                                    'reimbursementRate' => 'string',
                                    'hcpcsPayableAmount' => 'string',
                                    'claimPaymentRemarkCode' => [
                                        'string'
                                    ],
                                    'endStageRenalDiseasePaymentAmount' => 'string',
                                    'nonPayableProfessionalComponentBilledAmount' => 'string'
                                ],
                                'otherSubscriberName' => [
                                    'otherInsuredQualifier' => '1',
                                    'otherInsuredLastName' => 'string',
                                    'otherInsuredFirstName' => 'string',
                                    'otherInsuredMiddleName' => 'string',
                                    'otherInsuredNameSuffix' => 'string',
                                    'otherInsuredIdentifierTypeCode' => 'II',
                                    'otherInsuredIdentifier' => 'string',
                                    'otherInsuredAddress' => [
                                        'address1' => '123 address1',
                                        'address2' => 'apt 000',
                                        'city' => 'city1',
                                        'state' => 'wa',
                                        'postalCode' => '981010000',
                                        'countryCode' => 'string',
                                        'countrySubDivisionCode' => 'string'
                                    ],
                                    'otherInsuredAdditionalIdentifier' => 'string'
                                ],
                                'otherPayerName' => [
                                    'otherInsuredAdditionalIdentifier' => 'string',
                                    'otherPayerOrganizationName' => 'string',
                                    'otherPayerIdentifierTypeCode' => 'PI',
                                    'otherPayerIdentifier' => 'string',
                                    'otherPayerAddress' => [
                                        'address1' => '123 address1',
                                        'address2' => 'apt 000',
                                        'city' => 'city1',
                                        'state' => 'wa',
                                        'postalCode' => '981010000',
                                        'countryCode' => 'string',
                                        'countrySubDivisionCode' => 'string'
                                    ],
                                    'otherPayerAdjudicationOrPaymentDate' => 'string',
                                    'otherPayerSecondaryIdentifier' => [
                                        [
                                            'qualifier' => 'string',
                                            'identifier' => 'string',
                                            'otherIdentifier' => 'string'
                                        ]
                                    ],
                                    'otherPayerPriorAuthorizationNumber' => 'string',
                                    'otherPayerPriorAuthorizationOrReferralNumber' => 'string',
                                    'otherPayerClaimAdjustmentIndicator' => true,
                                    'otherPayerClaimControlNumber' => 'string'
                                ],
                                'otherPayerReferringProvider' => [
                                    [
                                        'otherPayerReferringProviderIdentifier' => [
                                            [
                                                'qualifier' => 'string',
                                                'identifier' => 'string',
                                                'otherIdentifier' => 'string'
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerRenderingProvider' => [
                                    [
                                        'entityTypeQualifier' => '1',
                                        'otherPayerRenderingProviderSecondaryIdentifier' => [
                                            [
                                                'qualifier' => 'string',
                                                'identifier' => 'string',
                                                'otherIdentifier' => 'string'
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerServiceFacilityLocation' => [
                                    [
                                        'otherPayerServiceFacilityLocationSecondaryIdentifier' => [
                                            [
                                                'qualifier' => 'string',
                                                'identifier' => 'string',
                                                'otherIdentifier' => 'string'
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerSupervisingProvider' => [
                                    [
                                        'otherPayerSupervisingProviderIdentifier' => [
                                            [
                                                'qualifier' => 'string',
                                                'identifier' => 'string',
                                                'otherIdentifier' => 'string'
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerBillingProvider' => [
                                    [
                                        'entityTypeQualifier' => '1',
                                        'otherPayerBillingProviderIdentifier' => [
                                            [
                                                'qualifier' => 'string',
                                                'identifier' => 'string',
                                                'otherIdentifier' => 'string'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],*/
                'serviceLines' => $serviceLines, /* [
                    [
                        'assignedNumber' => 'string',
                        'serviceDate' => '20050514',
                        'serviceDateEnd' => 'string',
                        'providerControlNumber' => 'string',
                        'professionalService' => [
                            'procedureIdentifier' => 'HC',
                            'procedureCode' => 'E0570',
                            'procedureModifiers' => [
                                'string'
                            ],
                            'description' => 'string',
                            'lineItemChargeAmount' => '25',
                            'measurementUnit' => 'UN',
                            'serviceUnitCount' => '1',
                            'placeOfServiceCode' => 'string',
                            'compositeDiagnosisCodePointers' => [
                                'diagnosisCodePointers' => 1
                            ],
                            'emergencyIndicator' => 'Y',
                            'epsdtIndicator' => 'Y',
                            'familyPlanningIndicator' => 'Y',
                            'copayStatusCode' => '0'
                        ],
                        'durableMedicalEquipmentService' => [
                            'days' => 'string',
                            'rentalPrice' => 'string',
                            'purchasePrice' => 'string',
                            'frequencyCode' => '1'
                        ],
                        'serviceLineSupplementalInformation' => [
                            [
                                'attachmentReportTypeCode' => '93',
                                'attachmentTransmissionCode' => 'AA',
                                'attachmentControlNumber' => 'string'
                            ]
                        ],
                        'durableMedicalEquipmentCertificateOfMedicalNecessity' => [
                            'attachmentTransmissionCode' => 'AB'
                        ],
                        'ambulanceTransportInformation' => [
                            'patientWeightInPounds' => 'string',
                            'ambulanceTransportReasonCode' => 'A',
                            'transportDistanceInMiles' => 'string',
                            'roundTripPurposeDescription' => 'string',
                            'stretcherPurposeDescription' => 'string'
                        ],
                        'durableMedicalEquipmentCertification' => [
                            'certificationTypeCode' => 'I',
                            'durableMedicalEquipmentDurationInMonths' => 'string'
                        ],
                        'ambulanceCertification' => [
                            [
                                'certificationConditionIndicator' => 'N',
                                'conditionCodes' => [
                                    '01'
                                ]
                            ]
                        ],
                        'hospiceEmployeeIndicator' => true,
                        'conditionIndicatorDurableMedicalEquipment' => [
                            'certificationConditionIndicator' => 'Y',
                            'conditionIndicator' => '38',
                            'conditionIndicatorCode' => '38'
                        ],
                        'serviceLineDateInformation' => [
                            'prescriptionDate' => 'string',
                            'certificationRevisionOrRecertificationDate' => 'string',
                            'beginTherapyDate' => 'string',
                            'lastCertificationDate' => 'string',
                            'treatmentOrTherapyDate' => 'string',
                            'hemoglobinTestDate' => 'string',
                            'serumCreatineTestDate' => 'string',
                            'shippedDate' => 'string',
                            'lastXRayDate' => 'string',
                            'initialTreatmentDate' => 'string'
                        ],
                        'ambulancePatientCount' => 0,
                        'obstetricAnesthesiaAdditionalUnits' => 0,
                        'testResults' => [
                            [
                                'measurementReferenceIdentificationCode' => 'OG',
                                'measurementQualifier' => 'HT',
                                'testResults' => 'string'
                            ]
                        ],
                        'contractInformation' => [
                            'contractTypeCode' => '01',
                            'contractAmount' => 'string',
                            'contractPercentage' => 'string',
                            'contractCode' => 'string',
                            'termsDiscountPercentage' => 'string',
                            'contractVersionIdentifier' => 'string'
                        ],
                        'serviceLineReferenceInformation' => [
                            'repricedLineItemReferenceNumber' => 'string',
                            'adjustedRepricedLineItemReferenceNumber' => 'string',
                            'priorAuthorization' => [
                                [
                                    'priorAuthorizationOrReferralNumber' => 'string',
                                    'otherPayerPrimaryIdentifier' => 'string'
                                ]
                            ],
                            'mammographyCertificationNumber' => 'string',
                            'clinicalLaboratoryImprovementAmendmentNumber' => 'string',
                            'referringCliaNumber' => 'string',
                            'immunizationBatchNumber' => 'string',
                            'referralNumber' => [
                                'string'
                            ]
                        ],
                        'salesTaxAmount' => 'string',
                        'postageTaxAmount' => 'string',
                        'fileInformation' => [
                            'string'
                        ],
                        'additionalNotes' => 'string',
                        'goalRehabOrDischargePlans' => 'string',
                        'thirdPartyOrganizationNotes' => 'string',
                        'purchasedServiceInformation' => [
                            'purchasedServiceProviderIdentifier' => '01',
                            'purchasedServiceChargeAmount' => '10'
                        ],
                        'linePricingRepricingInformation' => [
                            'pricingMethodologyCode' => '01',
                            'repricedAllowedAmount' => '1',
                            'repricedSavingAmount' => 'string',
                            'repricingOrganizationIdentifier' => 'string',
                            'repricingPerDiemOrFlatRateAmoung' => 'string',
                            'repricedApprovedAmbulatoryPatientGroupCode' => 'string',
                            'repricedApprovedAmbulatoryPatientGroupAmount' => 'string',
                            'rejectReasonCode' => 'T1',
                            'policyComplianceCode' => '1',
                            'exceptionCode' => '1'
                        ],
                        'drugIdentification' => [
                            'serviceIdQualifier' => 'EN',
                            'nationalDrugCode' => 'string',
                            'nationalDrugUnitCount' => 'string',
                            'measurementUnitCode' => 'F2',
                            'linkSequenceNumber' => 'string',
                            'pharmacyPrescriptionNumber' => 'string'
                        ],
                        'renderingProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => 'string',
                            'locationNumber' => 'string',
                            'payerIdentificationNumber' => 'string',
                            'employerIdentificationNumber' => 'string',
                            'claimOfficeNumber' => 'string',
                            'naic' => 'string',
                            'stateLicenseNumber' => 'string',
                            'providerUpinNumber' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johnone',
                            'lastName' => 'doeone',
                            'middleName' => 'middleone',
                            'suffix' => 'Jr',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                            'address' => [
                                'address1' => '123 address1',
                                'address2' => 'apt 000',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string'
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => 'string',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ]
                        ],
                        'purchasedServiceProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => 'string',
                            'locationNumber' => 'string',
                            'payerIdentificationNumber' => 'string',
                            'employerIdentificationNumber' => 'string',
                            'claimOfficeNumber' => 'string',
                            'naic' => 'string',
                            'stateLicenseNumber' => 'string',
                            'providerUpinNumber' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johnone',
                            'lastName' => 'doeone',
                            'middleName' => 'middleone',
                            'suffix' => 'Jr',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                            'address' => [
                                'address1' => '123 address1',
                                'address2' => 'apt 000',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string'
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => 'string',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ]
                        ],
                        'serviceFacilityLocation' => [
                            'organizationName' => 'HAPPY DOCTORS GROUP',
                            'address' => [
                                'address1' => '123 address1',
                                'address2' => 'apt 000',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string'
                            ],
                            'npi' => 'string',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ],
                            'phoneName' => 'string',
                            'phoneNumber' => 'string',
                            'phoneExtension' => 'string'
                        ],
                        'supervisingProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => 'string',
                            'locationNumber' => 'string',
                            'payerIdentificationNumber' => 'string',
                            'employerIdentificationNumber' => 'string',
                            'claimOfficeNumber' => 'string',
                            'naic' => 'string',
                            'stateLicenseNumber' => 'string',
                            'providerUpinNumber' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johnone',
                            'lastName' => 'doeone',
                            'middleName' => 'middleone',
                            'suffix' => 'Jr',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                            'address' => [
                                'address1' => '123 address1',
                                'address2' => 'apt 000',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string'
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => 'string',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ]
                        ],
                        'orderingProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => 'string',
                            'locationNumber' => 'string',
                            'payerIdentificationNumber' => 'string',
                            'employerIdentificationNumber' => 'string',
                            'claimOfficeNumber' => 'string',
                            'naic' => 'string',
                            'stateLicenseNumber' => 'string',
                            'providerUpinNumber' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johnone',
                            'lastName' => 'doeone',
                            'middleName' => 'middleone',
                            'suffix' => 'Jr',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                            'address' => [
                                'address1' => '123 address1',
                                'address2' => 'apt 000',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string'
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => 'string',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ]
                        ],
                        'referringProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => 'string',
                            'locationNumber' => 'string',
                            'payerIdentificationNumber' => 'string',
                            'employerIdentificationNumber' => 'string',
                            'claimOfficeNumber' => 'string',
                            'naic' => 'string',
                            'stateLicenseNumber' => 'string',
                            'providerUpinNumber' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johnone',
                            'lastName' => 'doeone',
                            'middleName' => 'middleone',
                            'suffix' => 'Jr',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                            'address' => [
                                'address1' => '123 address1',
                                'address2' => 'apt 000',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string'
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => 'string',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                    'otherIdentifier' => 'string'
                                ]
                            ]
                        ],
                        'ambulancePickUpLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => 'string',
                            'countrySubDivisionCode' => 'string'
                        ],
                        'ambulanceDropOffLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => 'string',
                            'countrySubDivisionCode' => 'string'
                        ],
                        'lineAdjudicationInformation' => [
                            [
                                'otherPayerPrimaryIdentifier' => 'string',
                                'serviceLinePaidAmount' => 'string',
                                'serviceIdQualifier' => 'ER',
                                'procedureCode' => 'string',
                                'procedureModifier' => [
                                    'string'
                                ],
                                'procedureCodeDescription' => 'string',
                                'paidServiceUnitCount' => 'string',
                                'bundledOrUnbundledLineNumber' => 'string',
                                'claimAdjustmentInformation' => [
                                    [
                                        'adjustmentGroupCode' => 'CO',
                                        'adjustmentDetails' => [
                                            [
                                                'adjustmentReasonCode' => 'string',
                                                'adjustmentAmount' => 'string',
                                                'adjustmentQuantity' => 'string'
                                            ]
                                        ]
                                    ]
                                ],
                                'adjudicationOrPaymentDate' => 'string',
                                'remainingPatientLiability' => 'string'
                            ]
                        ],
                        'formIdentification' => [
                            [
                                'formTypeCode' => 'AS',
                                'formIdentifier' => 'string',
                                'supportingDocumentation' => [
                                    [
                                        'questionNumber' => 'string',
                                        'questionResponseCode' => 'N',
                                        'questionResponse' => 'string',
                                        'questionResponseAsDate' => 'string',
                                        'questionResponseAsPercent' => 'string'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]*/
            ],
            ClaimType::INSTITUTIONAL => [
                'claimFilingCode' => 'CI',
                'planParticipationCode' => 'A', /* Código que indica si el proveedor aceptó la asignación.
                    * A = Asignado
                    * B = Asignación aceptada sólo en servicios de laboratorio clínico
                    * C = No asignado */
                'benefitsAssignmentCertificationIndicator' => isset($this->claim->demographicInformation)
                    ? ((true === $this->claim->demographicInformation->accept_assignment)
                        ? 'Y'
                        : 'N')
                    : 'N',
                'releaseInformationCode' => 'Y', /* Código que indica si el proveedor tiene archivada una declaración firmada por el paciente autorizando la divulgación de datos médicos a otras organizaciones.
                * Informado = I, Sí = Y */
                /**'fileInformation' => [
                    'string',
                ],
                'claimNotes' => [
                    'goalRehabOrDischargePlans' => [
                        'string',
                    ],
                    'diagnosisDescription' => [
                        'string',
                    ],
                    'allergies' => [
                        'string',
                    ],
                    'dme' => [
                        'string',
                    ],
                    'medications' => [
                        'string',
                    ],
                    'nutritionalRequirments' => [
                        'string',
                    ],
                    'ordersForDiscipLinesAndTreatments' => [
                        'string',
                    ],
                    'functionalLimitsOrReasonHomebound' => [
                        'string',
                    ],
                    'reasonsPatientLeavesHome' => [
                        'string',
                    ],
                    'timesAndReasonsPatientNotAtHome' => [
                        'string',
                    ],
                    'unusualHomeOrSocialEnv' => [
                        'string',
                    ],
                    'safetyMeasures' => [
                        'string',
                    ],
                    'supplementalPlanOfTreatment' => [
                        'string',
                    ],
                    'updatedInformation' => [
                        'string',
                    ],
                    'additionalInformation' => [
                        'string',
                    ],
                ],*/
                'claimDateInformation' => [
                    'admissionDateAndHour' => str_replace('-', '', $this->claim->patientInformation->admission_date ?? '').substr(str_replace(':', '', $this->claim->patientInformation->admission_time ?? ''), 0, 3),
                    'statementBeginDate' => str_replace('-', '', $this->claim->from ?? ''),
                    'statementEndDate' => str_replace('-', '', $this->claim->to ?? ''),
                    'dischargeHour' => str_replace('-', '', $this->claim->patientInformation->discharge_date ?? '').substr(str_replace(':', '', $this->claim->patientInformation->discharge_time ?? ''), 0, 3),
                    'repricerReceivedDate' => Carbon::now()->format('YmdHi'),
                ],
                /**'claimContractInformation' => [
                    'contractTypeCode' => '01',
                    'contractAmount' => 'string',
                    'contractPercentage' => 'string',
                    'contractCode' => 'string',
                    'termsDiscountPercentage' => 'string',
                    'contractVersionIdentifier' => 'string'
                ],*/
                'claimSupplementalInformation' => [
                    /*'reportInformation' => [
                        'attachmentReportTypeCode' => '03',
                        'attachmentTransmissionCode' => 'AA',
                        'attachmentControlNumber' => 'string'
                    ],*/
                    'priorAuthorizationNumber' => $this->claim->demographicInformation?->prior_authorization_number ?? '',
                    'referralNumber' => '',
                    'claimControlNumber' => '',
                    'repricedClaimNumber' => '',
                    'investigationalDeviceExemptionNumber' => '',
                    'claimNumber' => '',
                    'medicalRecordNumber' => '',
                    'demoProjectIdentifier' => '',
                    'serviceAuthorizationExceptionCode' => '',
                    'autoAccidentState' => $this->claim->demographicInformation?->auto_accident_place_state,
                    'peerReviewAuthorizationNumber' => '',
                    'adjustedRepricedClaimRefNumber' => '',
                ],
                // 'conditionCodes' => '1',
                'principalDiagnosis' => [
                    'qualifierCode' => 'ABK',
                    'principalDiagnosisCode' => $diagnosisPrincipal?->code,
                    'presentOnAdmissionIndicator' => (true === $diagnosisPrincipal?->pivot?->admission ?? false) ? 'Y' : 'N',
                ],
                'admittingDiagnosis' => isset($admittingDiagnosis)
                    ? [
                        'qualifierCode' => 'ABJ',
                        'admittingDiagnosisCode' => $admittingDiagnosis->code,
                    ]
                    : null,
                /*'patientReasonForVisits' => [
                    [
                        'qualifierCode' => 'APR',
                        'patientReasonForVisitCode' => 'string',
                    ],
                ],
                'externalCauseOfInjuries' => [
                    [
                        'qualifierCode' => 'ABN',
                        'externalCauseOfInjury' => 'string',
                        'presentOnAdmissionIndicator' => 'N',
                    ],
                ],*/
                'diagnosisRelatedGroupInformation' => [
                    'drugRelatedGroupCode' => $this->claim->service?->diagnosisRelatedGroup?->code ?? null,
                ],
                'otherDiagnosisInformationList' => [
                    $this->claim->service->diagnoses
                        ->skip(1)
                        ->map(fn ($diagnosis, $index) => [
                            'qualifierCode' => 'ABF',
                            'otherDiagnosisCode' => $diagnosis->code,
                            'presentOnAdmissionIndicator' => (true === $diagnosis->pivot?->admission ?? false) ? 'Y' : 'N',
                        ])->toArray(),
                ],
                'principalProcedureInformation' => isset($claimServiceLinePrincipal)
                    ? [
                        'qualifierCode' => null /* 'BBR' Códigos de procedimiento principal de modificación clínica de la clasificación internacional de enfermedades, 'BR' Códigos de procedimiento principal de modificación clínica de la clasificación internacional de enfermedades 'CAH' Códigos de conceptos avanzados de facturación (ABC). */,
                        'principalProcedureCode' => $claimServiceLinePrincipal->procedure?->code,
                        'principalProcedureDate' => str_replace('-', '', $claimServiceLinePrincipal->from_service),
                    ]
                    : null,
                'otherProcedureInformationList' => [
                    $this->claim->service->services
                        ->skip(1)
                        ->map(fn ($service, $index) => [
                            'qualifierCode' => 'BBQ',
                            'otherProcedureCode' => $service->procedure?->code,
                            'otherProcedureDate' => str_replace('-', '', $service->from_service),
                        ])->toArray(),
                ],
                'occurrenceSpanInformations' => [
                    [
                        [
                            'occurrenceSpanCode' => 'string',
                            'occurrenceSpanCodeStartDate' => 'string',
                            'occurrenceSpanCodeEndDate' => 'string',
                        ],
                    ],
                ],
                'valueInformationList' => [
                    [
                        [
                            'valueCode' => 'string',
                            'valueCodeAmount' => 'string',
                        ],
                    ],
                ],
                'occurrenceInformationList' => [
                    [
                        [
                            'occurrenceSpanCode' => 'string',
                            'occurrenceSpanCodeDate' => 'string',
                        ],
                    ],
                ],
                'treatmentCodeInformationList' => [
                    [
                        'string',
                    ],
                ],
                'conditionCodesList' => [
                    [
                        [
                            'conditionCode' => 'string',
                        ],
                    ],
                ],
                'claimPricingInformation' => [
                    'pricingMethodologyCode' => '00',
                    'repricedAllowedAmount' => 'string',
                    'repricedSavingAmount' => 'string',
                    'repricedOrgIdentifier' => 'string',
                    'repricedPerDiem' => 'string',
                    'repricedApprovedDRGCode' => 'string',
                    'repricedApprovedAmount' => 'string',
                    'repricedApprovedRevenueCode' => 'string',
                    'repricedApprovedServiceUnitCode' => 'DA',
                    'repricedApprovedServiceUnitCount' => 'string',
                    'rejectReasonCode' => 'T1',
                    'policyComplianceCode' => '1',
                    'exceptionCode' => '1',
                    'productOrServiceIDQualifier' => 'ER',
                    'repricedApprovedHCPCSCode' => 'string',
                ],
                'serviceFacilityLocation' => [
                    'address' => [
                        'address1' => '000 address1',
                        'address2' => 'string',
                        'city' => 'city1',
                        'state' => 'tn',
                        'postalCode' => '372030000',
                        'countryCode' => 'string',
                        'countrySubDivisionCode' => 'string',
                    ],
                    'organizationName' => 'ABC clinic',
                    'secondaryIdentificationQualifierCode' => '0B',
                    'secondaryIdentifier' => 'string',
                    'identificationCode' => 'string',
                ],
                /*'otherSubscriberInformation' => [
                    'paymentResponsibilityLevelCode' => 'A',
                    'individualRelationshipCode' => '01',
                    'claimFilingIndicatorCode' => '11',
                    'benefitsAssignmentCertificationIndicator' => 'N',
                    'releaseOfInformationCode' => 'I',
                    'medicareInpatientAdjudication' => [
                        'claimPaymentRemarkCode' => [
                            'string',
                        ],
                        'coveredDaysOrVisitsCount' => 'string',
                        'lifetimePsychiatricDaysCount' => 'string',
                        'claimDRGAmount' => 'string',
                        'claimDisproportionateShareAmount' => 'string',
                        'claimMspPassThroughAmount' => 'string',
                        'claimPpsCapitalAmount' => 'string',
                        'ppsCapitalHspDrgAmount' => 'string',
                        'capitalHSPDRGAmount' => 'string',
                        'ppsCapitalDshDrgAmount' => 'string',
                        'oldCapitalAmount' => 'string',
                        'ppsCapitalImeAmount' => 'string',
                        'ppsOperatingHospitalSpecificDrgAmount' => 'string',
                        'costReportDayCount' => 'string',
                        'ppsOperatingFederalSpecificDrgAmount' => 'string',
                        'claimPpsCapitalOutlierAmmount' => 'string',
                        'claimIndirectTeachingAmount' => 'string',
                        'nonPayableProfessionalComponentBilledAmount' => 'string',
                        'capitalExceptionAmount' => 'string',
                    ],
                    'medicareOutpatientAdjudication' => [
                        'claimPaymentRemarkCode' => [
                            'string',
                        ],
                        'reimbursementRate' => 'string',
                        'hcpcsPayableAmount' => 'string',
                        'endStageRenalDiseasePaymentAmount' => 'string',
                        'nonPayableProfessionalComponentBilledAmount' => 'string',
                    ],
                    'otherSubscriberName' => [
                        'otherInsuredQualifier' => '1',
                        'otherInsuredIdentifierTypeCode' => 'II',
                        'otherInsuredAdditionalIdentifier' => [
                            'string',
                        ],
                        'address' => [
                            'address1' => '000 address1',
                            'address2' => 'string',
                            'city' => 'city1',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                            'countryCode' => 'string',
                            'countrySubDivisionCode' => 'string',
                        ],
                        'otherInsuredLastName' => 'string',
                        'otherInsuredFirstName' => 'string',
                        'otherInsuredMiddleName' => 'string',
                        'otherInsuredSuffix' => 'string',
                        'otherInsuredIdentifier' => 'string',
                        'firstName' => 'string',
                    ],
                    'claimLevelAdjustments' => [
                        [
                            'adjustmentGroupCode' => 'CO',
                            'claimAdjustmentDetails' => [
                                [
                                    'adjustmentReasonCode' => 'string',
                                    'adjustmentAmount' => 'string',
                                    'adjustmentQuantity' => 'string',
                                ],
                            ],
                        ],
                    ],
                    'otherPayerName' => [
                        'otherPayerIdentifierTypeCode' => 'PI',
                        'otherPayerAddress' => [
                            'address1' => '000 address1',
                            'address2' => 'string',
                            'city' => 'city1',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                            'countryCode' => 'string',
                            'countrySubDivisionCode' => 'string',
                        ],
                        'otherPayerSecondaryIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                        'otherPayerClaimAdjustmentIndicator' => false,
                        'otherInsuredAdditionalIdentifier' => 'string',
                        'otherPayerOrganizationName' => 'string',
                        'otherPayerIdentifier' => 'string',
                        'otherPayerAdjudicationOrPaymentDate' => 'string',
                        'otherPayerPriorAuthorizationNumber' => 'string',
                        'otherPayerPriorAuthorizationOrReferralNumber' => 'string',
                        'otherPayerClaimControlNumber' => 'string',
                    ],
                    'otherPayerAttendingProvider' => [
                        'otherPayerAttendingProviderIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'otherPayerOperatingPhysician' => [
                        'otherPayerOperatingPhysicianIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'otherPayerOtherOperatingPhysician' => [
                        'otherPayerOtherOperatingPhysicianIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'otherPayerServiceFacilityLocation' => [
                        'otherPayerServiceFacilityLocationIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'otherPayerRenderingProvider' => [
                        'otherPayerRenderingProviderIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'otherPayerReferringProvider' => [
                        'otherPayerReferringProviderIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'otherPayerBillingProvider' => [
                        'otherPayerBillingProviderIdentifier' => [
                            [
                                'qualifier' => 'string',
                                'identifier' => 'string',
                            ],
                        ],
                    ],
                    'policyNumber' => 'string',
                    'groupNumber' => 'string',
                    'otherInsuredGroupName' => 'string',
                    'payerPaidAmount' => 'string',
                    'remainingPatientLiability' => 'string',
                    'nonCoveredChargeAmount' => 'string',
                ],*/
                'serviceLines' => $serviceLines, /*[
                    [
                        'lineAdjudicationInformation' => [
                            [
                                'procedureModifier' => [
                                    'string',
                                ],
                                'lineAdjustment' => [
                                    [
                                        'adjustmentGroupCode' => 'CO',
                                        'claimAdjustmentDetails' => [
                                            [
                                                'adjustmentReasonCode' => 'string',
                                                'adjustmentAmount' => 'string',
                                                'adjustmentQuantity' => 'string',
                                            ],
                                        ],
                                    ],
                                ],
                                'otherPayerPrimaryIdentifier' => 'string',
                                'serviceLinePaidAmount' => 'string',
                                'productOrServiceIDQualifier' => 'ER',
                                'procedureCode' => 'string',
                                'serviceLineRevenueCode' => 'string',
                                'procedureCodeDescription' => 'string',
                                'paidServiceUnitCount' => 'string',
                                'bundledLineNumber' => 'string',
                                'adjudicationOrPaymentDate' => 'string',
                                'remainingPatientLiability' => 'string',
                            ],
                        ],
                        'renderingProvider' => [
                            'providerType' => 'BillingProvider',
                            'address' => [
                                'address1' => '000 address1',
                                'address2' => 'string',
                                'city' => 'city1',
                                'state' => 'tn',
                                'postalCode' => '372030000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string',
                            ],
                            'contactInformation' => [
                                'name' => 'janetwo doetwo',
                                'phoneNumber' => '0000000001',
                                'faxNumber' => '0000000002',
                                'email' => 'email@email.com',
                                'validContact' => true,
                            ],
                            'referenceIdentification' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                ],
                            ],
                            'npi' => '1760854442',
                            'secondaryIdentificationQualifierCode' => '0B',
                            'secondaryIdentifier' => 'string',
                            'employerId' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johntwo',
                            'lastName' => 'doetwo',
                            'middleName' => 'middletwo',
                            'suffix' => 'string',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                        ],
                        'referringProvider' => [
                            'providerType' => 'BillingProvider',
                            'address' => [
                                'address1' => '000 address1',
                                'address2' => 'string',
                                'city' => 'city1',
                                'state' => 'tn',
                                'postalCode' => '372030000',
                                'countryCode' => 'string',
                                'countrySubDivisionCode' => 'string',
                            ],
                            'contactInformation' => [
                                'name' => 'janetwo doetwo',
                                'phoneNumber' => '0000000001',
                                'faxNumber' => '0000000002',
                                'email' => 'email@email.com',
                                'validContact' => true,
                            ],
                            'referenceIdentification' => [
                                [
                                    'qualifier' => 'string',
                                    'identifier' => 'string',
                                ],
                            ],
                            'npi' => '1760854442',
                            'secondaryIdentificationQualifierCode' => '0B',
                            'secondaryIdentifier' => 'string',
                            'employerId' => 'string',
                            'taxonomyCode' => 'string',
                            'firstName' => 'johntwo',
                            'lastName' => 'doetwo',
                            'middleName' => 'middletwo',
                            'suffix' => 'string',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                        ],
                        'lineSupplementInformation' => [
                            'reportInformation' => [
                                'attachmentReportTypeCode' => '03',
                                'attachmentTransmissionCode' => 'AA',
                                'attachmentControlNumber' => 'string',
                            ],
                            'priorAuthorizationNumber' => 'string',
                            'referralNumber' => 'string',
                            'claimControlNumber' => 'string',
                            'repricedClaimNumber' => 'string',
                            'investigationalDeviceExemptionNumber' => 'string',
                            'claimNumber' => 'string',
                            'medicalRecordNumber' => 'string',
                            'demoProjectIdentifier' => 'string',
                            'serviceAuthorizationExceptionCode' => '1',
                            'autoAccidentState' => 'string',
                            'peerReviewAuthorizationNumber' => 'string',
                            'adjustedRepricedClaimRefNumber' => 'string',
                        ],
                        'institutionalService' => [
                            'procedureModifiers' => [
                                '1234',
                            ],
                            'measurementUnit' => 'DA, UN',
                            'serviceLineRevenueCode' => 'string',
                            'procedureIdentifier' => 'ER',
                            'procedureCode' => '80199',
                            'description' => 'Some description text about the procedure',
                            'lineItemChargeAmount' => 'string',
                            'serviceUnitCount' => 'string',
                            'nonCoveredChargeAmount' => 'string',
                        ],
                        'serviceLineSupplementalInformation' => [
                            'attachmentReportTypeCode' => '03',
                            'attachmentTransmissionCode' => 'AA',
                            'attachmentControlNumber' => 'string',
                        ],
                        'serviceLineReferenceInformation' => [
                            'providerControlNumber' => 'string',
                            'repricedLineItemRefNumber' => 'string',
                            'adjustedRepricedLineItemRefNumber' => 'string',
                        ],
                        'drugIdentification' => [
                            'measurementUnitCode' => 'F2',
                            'nationalDrugCode' => 'string',
                            'nationalDrugUnitCount' => 'string',
                            'linkSequenceNumber' => 'string',
                            'pharmacyPrescriptionNumber' => 'string',
                        ],
                        'lineAdjustmentInformation' => [
                            'claimAdjustment' => [
                                'adjustmentGroupCode' => 'CO',
                            ],
                        ],
                        'operatingPhysician' => [
                            'organizationName' => 'string',
                            'identificationQualifierCode' => '0B',
                            'secondaryIdentifier' => 'string',
                            'firstName' => 'string',
                            'lastName' => 'string',
                            'middleName' => 'string',
                            'suffix' => 'string',
                            'npi' => 'string',
                        ],
                        'otherOperatingPhysician' => [
                            'organizationName' => 'string',
                            'identificationQualifierCode' => '0B',
                            'secondaryIdentifier' => 'string',
                            'firstName' => 'string',
                            'lastName' => 'string',
                            'middleName' => 'string',
                            'suffix' => 'string',
                            'npi' => 'string',
                        ],
                        'lineRepricingInformation' => [
                            'pricingMethodologyCode' => '00',
                            'repricedAllowedAmount' => 'string',
                            'repricedSavingAmount' => 'string',
                            'repricedOrgIdentifier' => 'string',
                            'repricedPerDiem' => 'string',
                            'repricedApprovedDRGCode' => 'string',
                            'repricedApprovedAmount' => 'string',
                            'repricedApprovedRevenueCode' => 'string',
                            'repricedApprovedServiceUnitCode' => 'DA',
                            'repricedApprovedServiceUnitCount' => 'string',
                            'rejectReasonCode' => 'T1',
                            'policyComplianceCode' => '1',
                            'exceptionCode' => '1',
                            'productOrServiceIDQualifier' => 'ER',
                            'repricedApprovedHCPCSCode' => 'string',
                        ],
                        'assignedNumber' => '1',
                        'serviceDate' => 'string',
                        'serviceDateEnd' => 'string',
                        'serviceTaxAmount' => 'string',
                        'facilityTaxAmount' => 'string',
                        'lineItemControlNumber' => 'string',
                        'repricedLineItemReferenceNumber' => 'string',
                        'description' => 'string',
                        'adjustedRepricedLineItemReferenceNumber' => 'string',
                        'lineNoteText' => 'string',
                    ],
                ],*/
                'claimCodeInformation' => [
                    'admissionTypeCode' => $this->claim->patientInformation?->admissionType?->code,
                    'admissionSourceCode' => $this->claim->patientInformation?->admissionSource?->code,
                    'patientStatusCode' => $this->claim->patientInformation?->patientStatus?->code,
                ],
                'epsdtReferral' => [
                    'certificationConditionCodeAppliesIndicator' => isset($claimServiceLinePrincipal?->epsdt?->code) ? 'Y' : 'N',
                    'conditionCodes' => [
                        $claimServiceLinePrincipal?->epsdt?->code ?? 'NU',
                    ],
                ],
                'propertyCasualtyClaimNumber' => '',
                'claimChargeAmount' => str_replace(',', '', $this->claim->billed_amount ?? '0.00'),
                'placeOfServiceCode' => $claimServiceLinePrincipal?->placeOfService?->code ?? '11',
                'claimFrequencyCode' => '1',
                'delayReasonCode' => '',
                'patientEstimatedAmountDue' => '',
                'billingNote' => '',
            ]
        };
    }

    protected function getPayToAddress(): ?array
    {
        $billingProviderPaymentAddress = $this->claim
            ?->demographicInformation
            ?->company
            ->addresses()
            ->where('billing_company_id', $this->claim->billing_company_id)
            ->where('address_type_id', '3')
            ?->first() ?? null;

        return isset($billingProviderPaymentAddress)
            ? [
                'address1' => $billingProviderPaymentAddress?->address,
                'address2' => null,
                'city' => $billingProviderPaymentAddress?->city,
                'state' => substr($billingProviderPaymentAddress?->state ?? '', 0, 2) ?? null,
                'postalCode' => str_replace('-', '', $billingProviderPaymentAddress?->zip) ?? null,
                'countryCode' => $billingProviderPaymentAddress?->country,
                'countrySubDivisionCode' => $billingProviderPaymentAddress?->country_subdivision_code,
            ]
            : null;
    }

    protected function getPayToPlan(): ?array
    {
        return null;
        /* @todo Se emplea cuando el pago se hace a otra compañia de seguro
         * Esta es la data del insurance al que hay que hacerle el pago
         * Actualmente no esta considerado en el sistema
         */
        return [
            'organizationName' => 'Example Org',
            'primaryIdentifierTypeCode' => 'PI',
            'primaryIdentifier' => 'string',
            'address' => [
                'address1' => '123 address1',
                'address2' => 'apt 000',
                'city' => 'city1',
                'state' => 'wa',
                'postalCode' => '981010000',
                'countryCode' => 'string',
                'countrySubDivisionCode' => 'string',
            ],
            'secondaryIdentifierTypeCode' => '2U',
            'secondaryIdentifier' => '11',
            'taxIdentificationNumber' => 'string',
        ];
    }

    protected function getPayerAddress(): ?array
    {
        return null;
        /* @todo Se emplea cuando el pago se hace a otra compañia de seguro
         * Esta es la data del insurance al que hay que hacerle el pago
         * Actualmente no esta considerado en el sistema
         */
        return [
            'address1' => '123 address1',
            'address2' => 'apt 000',
            'city' => 'city1',
            'state' => 'wa',
            'postalCode' => '981010000',
            'countryCode' => 'string',
            'countrySubDivisionCode' => 'string',
        ];
    }

    protected function getBilling(): array
    {
        $billingProvider = $this->claim
            ?->demographicInformation
            ?->company;
        $billingProviderAddress = $billingProvider
            ->addresses()
            ?->first() ?? null;
        $billingProviderContact = $billingProvider
            ->contacts()
            ?->first() ?? null;

        return [
            'providerType' => 'BillingProvider',
            'npi' => str_replace('-', '', $billingProvider?->npi ?? '') ?? null,
            'ssn' => $billingProvider?->ssn,
            'employerId' => str_replace('-', '', $billingProvider->ein ?? $billingProvider->npi),
            // 'commercialNumber' => 'string',
            // 'locationNumber' => 'string',
            // 'payerIdentificationNumber' => 'string',
            // 'employerIdentificationNumber' => 'string',
            // 'claimOfficeNumber' => 'string',
            // 'naic' => 'string',
            // 'stateLicenseNumber' => 'string',
            // 'providerUpinNumber' => 'string',
            // 'taxonomyCode' => 'string',
            // 'firstName' => 'johnone',
            // 'lastName' => 'doeone',
            // 'middleName' => 'middleone',
            // 'suffix' => 'Jr',
            'organizationName' => $billingProvider?->name,
            'address' => [
                'address1' => $billingProviderAddress?->address,
                'address2' => null,
                'city' => $billingProviderAddress?->city,
                'state' => substr($billingProviderAddress?->state ?? '', 0, 2) ?? null,
                'postalCode' => str_replace('-', '', $billingProviderAddress?->zip) ?? null,
                'countryCode' => $billingProviderAddress?->country,
                'countrySubDivisionCode' => $billingProviderAddress?->country_subdivision_code,
            ],
            'contactInformation' => [
                'name' => $billingProviderContact->contact_name ?? $billingProvider->first_name,
                'phoneNumber' => str_replace('-', '', $billingProviderContact->phone ?? '') ?? null,
                'faxNumber' => str_replace('-', '', $billingProviderContact->fax ?? '') ?? null,
                'email' => $billingProviderContact->email,
                // 'phoneExtension' => ''
            ],
        ];
    }

    protected function getReferring(): ?array
    {
        $referringProvider = $this->claim->provider();
        $referringProviderAddress = $referringProvider?->profile?->addresses()?->first();
        $referringProviderContact = $referringProvider?->profile?->contacts()?->first();

        return !isset($referringProvider)
        ? null
        : [
            'providerType' => 'ReferringProvider',
            'npi' => str_replace('-', '', $referringProvider->npi ?? ''),
            'ssn' => str_replace('-', '', $referringProvider->ssn ?? ''),
            'employerId' => str_replace('-', '', $referringProvider->ein ?? $referringProvider->npi ?? ''),
            // 'commercialNumber' => 'string',
            // 'locationNumber' => 'string',
            // 'payerIdentificationNumber' => 'string',
            // 'employerIdentificationNumber' => 'string',
            // 'claimOfficeNumber' => 'string',
            // 'naic' => 'string',
            // 'stateLicenseNumber' => 'string',
            'providerUpinNumber' => str_replace('-', '', $referringProvider->upin ?? ''),
            // 'taxonomyCode' => 'string',
            'firstName' => $referringProvider?->profile?->first_name,
            'lastName' => $referringProvider?->profile?->last_name,
            'middleName' => $referringProvider?->profile?->middle_name,
            'suffix' => $referringProvider?->profile?->nameSuffix?->code,
            // 'organizationName' => $referringProvider?->profile?->last_name,
            'address' => [
                'address1' => $referringProviderAddress?->address,
                'address2' => null,
                'city' => $referringProviderAddress?->city,
                'state' => substr($referringProviderAddress?->state ?? '', 0, 2) ?? null,
                'postalCode' => str_replace('-', '', $referringProviderAddress?->zip ?? '') ?? null,
                'countryCode' => $referringProviderAddress?->country,
                'countrySubDivisionCode' => $referringProviderAddress?->country_subdivision_code,
            ],
            'contactInformation' => [
                'name' => $referringProviderContact->contact_name ?? $referringProvider?->profile?->first_name,
                'phoneNumber' => str_replace('-', '', $referringProviderContact?->phone ?? '') ?? null,
                'faxNumber' => str_replace('-', '', $referringProviderContact?->fax ?? '') ?? null,
                'email' => $referringProviderContact?->email,
                'phoneExtension' => '',
            ],
        ];
    }

    protected function getRendering(): ?array
    {
        return [
            'providerType' => 'BillingProvider',
            'npi' => '1760854442',
            'ssn' => '000000000',
            'employerId' => '123456789',
            'commercialNumber' => 'string',
            'locationNumber' => 'string',
            'payerIdentificationNumber' => 'string',
            'employerIdentificationNumber' => 'string',
            'claimOfficeNumber' => 'string',
            'naic' => 'string',
            'stateLicenseNumber' => 'string',
            'providerUpinNumber' => 'string',
            'taxonomyCode' => 'string',
            'firstName' => 'johnone',
            'lastName' => 'doeone',
            'middleName' => 'middleone',
            'suffix' => 'Jr',
            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
            'address' => [
                'address1' => '123 address1',
                'address2' => 'apt 000',
                'city' => 'city1',
                'state' => 'wa',
                'postalCode' => '981010000',
                'countryCode' => 'string',
                'countrySubDivisionCode' => 'string',
            ],
            'contactInformation' => [
                'name' => 'SUBMITTER CONTACT INFO',
                'phoneNumber' => '5554567890',
                'faxNumber' => '5551234567',
                'email' => 'email@email.com',
                'phoneExtension' => '1234',
            ],
        ];
    }

    protected function getOrdering(): ?array
    {
        return [
            'providerType' => 'BillingProvider',
            'npi' => '1760854442',
            'ssn' => '000000000',
            'employerId' => '123456789',
            'commercialNumber' => 'string',
            'locationNumber' => 'string',
            'payerIdentificationNumber' => 'string',
            'employerIdentificationNumber' => 'string',
            'claimOfficeNumber' => 'string',
            'naic' => 'string',
            'stateLicenseNumber' => 'string',
            'providerUpinNumber' => 'string',
            'taxonomyCode' => 'string',
            'firstName' => 'johnone',
            'lastName' => 'doeone',
            'middleName' => 'middleone',
            'suffix' => 'Jr',
            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
            'address' => [
                'address1' => '123 address1',
                'address2' => 'apt 000',
                'city' => 'city1',
                'state' => 'wa',
                'postalCode' => '981010000',
                'countryCode' => 'string',
                'countrySubDivisionCode' => 'string',
            ],
            'contactInformation' => [
                'name' => 'SUBMITTER CONTACT INFO',
                'phoneNumber' => '5554567890',
                'faxNumber' => '5551234567',
                'email' => 'email@email.com',
                'phoneExtension' => '1234',
            ],
        ];
    }

    protected function getSupervising(): ?array
    {
        return [
            'providerType' => 'BillingProvider',
            'npi' => '1760854442',
            'ssn' => '000000000',
            'employerId' => '123456789',
            'commercialNumber' => 'string',
            'locationNumber' => 'string',
            'payerIdentificationNumber' => 'string',
            'employerIdentificationNumber' => 'string',
            'claimOfficeNumber' => 'string',
            'naic' => 'string',
            'stateLicenseNumber' => 'string',
            'providerUpinNumber' => 'string',
            'taxonomyCode' => 'string',
            'firstName' => 'johnone',
            'lastName' => 'doeone',
            'middleName' => 'middleone',
            'suffix' => 'Jr',
            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
            'address' => [
                'address1' => '123 address1',
                'address2' => 'apt 000',
                'city' => 'city1',
                'state' => 'wa',
                'postalCode' => '981010000',
                'countryCode' => 'string',
                'countrySubDivisionCode' => 'string',
            ],
            'contactInformation' => [
                'name' => 'SUBMITTER CONTACT INFO',
                'phoneNumber' => '5554567890',
                'faxNumber' => '5551234567',
                'email' => 'email@email.com',
                'phoneExtension' => '1234',
            ],
        ];
    }

    protected function getFacilityAttribute(string $key): string
    {
        return (string) $this->claim
        ->demographicInformation
        ->facility
        ?->{$key} ?? '';
    }

    public function getFacilityAddressAttribute(string $key, string $entry): ?string
    {
        $value = (string) $this->claim
            ->demographicInformation
            ->facility
            ->addresses
            ->first()
            ?->{$key};

        return match ($key) {
            'address' => substr($value ?? '', 0, 55),
            'city' => substr($value ?? '', 0, 30),
            'state' => substr($value ?? '', 0, 2),
            'zip' => substr(str_replace('-', '', $value ?? ''), 0, 12),
            default => !empty($value) ? $value : null,
        };
    }

    public function getFacilityContactAttribute(string $key, string $entry): string
    {
        $value = $this->claim
            ->demographicInformation
            ->facility
            ->contacts
            ->get((int) $entry);

        return match ($key) {
            'phone' => str_replace('-', '', $value?->phone ?? '') ?? null,
            default => (string) $value?->{$key} ?? '',
        };
    }
}
