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
                // 'organizationName' => '',
                // 'insuranceTypeCode' => '12',
                // 'subscriberGroupName' => 'Subscriber Group Name',
                'firstName' => $subscriber->first_name,
                'lastName' => $subscriber->last_name,
                'middleName' => $subscriber->middle_name ?? null,
                'suffix' => $subscriber->nameSuffix?->code ?? null,
                'gender' => strtoupper($subscriber->sex ?? 'U'),
                'dateOfBirth' => str_replace('-', '', $subscriber->date_of_birth),
                'policyNumber' => $this->claim->higherOrderPolicy()->policy_number ?? null,
                // 'groupNumber' => '',

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
                // 'groupNumber' => '',
                'paymentResponsibilityLevelCode' => $this->claim->higherOrderPolicy()?->typeResponsibility?->code ?? 'U',
                'address' => [
                    'address1' => $subscriberAddress?->address,
                    'address2' => null,
                    'city' => $subscriberAddress?->city,
                    'state' => substr($subscriberAddress?->state ?? '', 0, 2) ?? null,
                    'postalCode' => str_replace('-', '', $subscriberAddress?->zip ?? '') ?? null,
                    'countryCode' => ('US' !== $subscriberAddress?->country) ? $subscriberAddress?->country : '',
                    'countrySubDivisionCode' => ('US' !== $subscriberAddress?->country) ? $subscriberAddress?->country_subdivision_code : '',
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
            $serviceLine = match ($this->claim->type) {
                ClaimType::PROFESSIONAL => [
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
                ],
                ClaimType::INSTITUTIONAL => [
                    /*'renderingProvider' => [
                        'providerType' => 'BillingProvider',
                        'address' => [
                            'address1' => '000 address1',
                            'address2' => '',
                            'city' => 'city1',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => '',
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
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                        'npi' => '1760854442',
                        'secondaryIdentificationQualifierCode' => '0B',
                        'secondaryIdentifier' => '',
                        'employerId' => '',
                        'taxonomyCode' => '',
                        'firstName' => 'johntwo',
                        'lastName' => 'doetwo',
                        'middleName' => 'middletwo',
                        'suffix' => '',
                        'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                    ],
                    'referringProvider' => [
                        'providerType' => 'BillingProvider',
                        'address' => [
                            'address1' => '000 address1',
                            'address2' => '',
                            'city' => 'city1',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => '',
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
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                        'npi' => '1760854442',
                        'secondaryIdentificationQualifierCode' => '0B',
                        'secondaryIdentifier' => '',
                        'employerId' => '',
                        'taxonomyCode' => '',
                        'firstName' => 'johntwo',
                        'lastName' => 'doetwo',
                        'middleName' => 'middletwo',
                        'suffix' => '',
                        'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                    ],*/
                    'lineSupplementInformation' => [
                        'priorAuthorizationNumber' => '',
                        'referralNumber' => '',
                        'claimControlNumber' => '',
                        'repricedClaimNumber' => '',
                        'investigationalDeviceExemptionNumber' => '',
                        'claimNumber' => '',
                        'medicalRecordNumber' => '',
                        'demoProjectIdentifier' => '',
                        'serviceAuthorizationExceptionCode' => '1',
                        'autoAccidentState' => '',
                        'peerReviewAuthorizationNumber' => '',
                        'adjustedRepricedClaimRefNumber' => '',
                    ],
                    'institutionalService' => [
                        'procedureModifiers' => array_map(fn ($mod) => $mod->modifier, $service->modifiers ?? []),
                        'measurementUnit' => 'UN',
                        'serviceLineRevenueCode' => $service->revenueCode->code,
                        'procedureIdentifier' => 'HC',
                        'procedureCode' => $service->procedure->code,
                        'description' => $service->procedure?->description,
                        'lineItemChargeAmount' => str_replace(',', '', $service->price),
                        'serviceUnitCount' => $service->days_or_units ?? '1',
                        'nonCoveredChargeAmount' => '',
                    ],
                    /*'drugIdentification' => [
                        'measurementUnitCode' => 'F2',
                        'nationalDrugCode' => '',
                        'nationalDrugUnitCount' => '',
                        'linkSequenceNumber' => '',
                        'pharmacyPrescriptionNumber' => '',
                    ],
                    'operatingPhysician' => [
                        'organizationName' => '',
                        'identificationQualifierCode' => '0B',
                        'secondaryIdentifier' => '',
                        'firstName' => '',
                        'lastName' => '',
                        'middleName' => '',
                        'suffix' => '',
                        'npi' => '',
                    ],*/
                    /*'otherOperatingPhysician' => [
                        'organizationName' => '',
                        'identificationQualifierCode' => '0B',
                        'secondaryIdentifier' => '',
                        'firstName' => '',
                        'lastName' => '',
                        'middleName' => '',
                        'suffix' => '',
                        'npi' => '',
                    ],*/
                    'assignedNumber' => $service->id,
                    'serviceDate' => '',
                    'serviceDateEnd' => '',
                    'serviceTaxAmount' => '',
                    'facilityTaxAmount' => '',
                    'lineItemControlNumber' => '',
                    'repricedLineItemReferenceNumber' => '',
                    'description' => '',
                    'adjustedRepricedLineItemReferenceNumber' => '',
                    'lineNoteText' => '',
                ]
            };
            array_push($serviceLines, $serviceLine);
        }

        return match ($this->claim->type) {
            ClaimType::PROFESSIONAL => [
                'claimFilingCode' => 'CI',
                // 'propertyCasualtyClaimNumber' => '',
                // 'deathDate' => '',
                // 'patientWeight' => '',
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
                // 'patientAmountPaid' => '', /** Monto pagado por el paciente AMT02 */
                // 'fileInformation' => '', /** El segmento K3 sólo se utiliza para cumplir un requisito de datos inesperado de una autoridad legislativa. */
                /* 'fileInformationList' => [
                    ''
                ],*/

                'claimDateInformation' => !empty($claimDateInfo) ? $claimDateInfo : null,
                /**'claimContractInformation' => [
                    'contractTypeCode' => '01', // Código que identifica un tipo de contrato. 02 -> Por dia
                    'contractAmount' => '',
                    'contractPercentage' => '',
                    'contractCode' => '',
                    'termsDiscountPercentage' => '',
                    'contractVersionIdentifier' => ''
                ],*/
                'claimSupplementalInformation' => [
                    /*'reportInformation' => [
                        'attachmentReportTypeCode' => '93',
                        'attachmentTransmissionCode' => 'AA',
                        'attachmentControlNumber' => ''
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
                    'additionalInformation' => '',
                    'certificationNarrative' => '',
                    'goalRehabOrDischargePlans' => '',
                    'diagnosisDescription' => '',
                    'thirdPartOrgNotes' => ''
                ],*/
                /**'ambulanceTransportInformation' => [
                    'patientWeightInPounds' => '',
                    'ambulanceTransportReasonCode' => 'A',
                    'transportDistanceInMiles' => '',
                    'roundTripPurposeDescription' => '',
                    'stretcherPurposeDescription' => ''
                ],*/
                /**'spinalManipulationServiceInformation' => [
                    'patientConditionCode' => '',
                    'patientConditionDescription1' => 'A',
                    'patientConditionDescription2' => ''
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
                            ''
                        ],*/
                /**'conditionInformation' => [
                            [
                                'conditionCodes' => [
                                    ''
                                ]
                            ]
                        ],*/
                /**'claimPricingRepricingInformation' => [
                            'pricingMethodologyCode' => '01',
                            'repricedAllowedAmount' => '1',
                            'repricedSavingAmount' => '',
                            'repricingOrganizationIdentifier' => '',
                            'repricingPerDiemOrFlatRateAmoung' => '',
                            'repricedApprovedAmbulatoryPatientGroupCode' => '',
                            'repricedApprovedAmbulatoryPatientGroupAmount' => '',
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
                        'countryCode' => ('US' !== $this->getFacilityAddressAttribute('country', '1'))
                            ? $this->getFacilityAddressAttribute('country', '1')
                            : '',
                        'countrySubDivisionCode' => ('US' !== $this->getFacilityAddressAttribute('country', '1'))
                            ? $this->getFacilityAddressAttribute('country_subdivision_code', '1')
                            : '',
                    ],
                    'npi' => $this->getFacilityAttribute('npi'),
                    /**'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
                                ]
                            ],*/
                    'phoneName' => $this->getFacilityContactAttribute('contact_name', '1'),
                    'phoneNumber' => $this->getFacilityContactAttribute('phone', '1'),
                    // 'phoneExtension' => ''
                ],
                /**'ambulancePickUpLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => ''
                        ],*/
                /**'ambulanceDropOffLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => ''
                        ],*/
                /*'otherSubscriberInformation' => [
                            [
                                'paymentResponsibilityLevelCode' => 'A',
                                'individualRelationshipCode' => '01',
                                'insuranceGroupOrPolicyNumber' => '',
                                'otherInsuredGroupName' => '',
                                'insuranceTypeCode' => '12',
                                'claimFilingIndicatorCode' => '11',
                                'claimLevelAdjustments' => [
                                    [
                                        'adjustmentGroupCode' => 'CO',
                                        'adjustmentDetails' => [
                                            [
                                                'adjustmentReasonCode' => '',
                                                'adjustmentAmount' => '',
                                                'adjustmentQuantity' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'payerPaidAmount' => '',
                                'nonCoveredChargeAmount' => '',
                                'remainingPatientLiability' => '',
                                'benefitsAssignmentCertificationIndicator' => 'N',
                                'patientSignatureGeneratedForPatient' => true,
                                'releaseOfInformationCode' => 'I',
                                'medicareOutpatientAdjudication' => [
                                    'reimbursementRate' => '',
                                    'hcpcsPayableAmount' => '',
                                    'claimPaymentRemarkCode' => [
                                        ''
                                    ],
                                    'endStageRenalDiseasePaymentAmount' => '',
                                    'nonPayableProfessionalComponentBilledAmount' => ''
                                ],
                                'otherSubscriberName' => [
                                    'otherInsuredQualifier' => '1',
                                    'otherInsuredLastName' => '',
                                    'otherInsuredFirstName' => '',
                                    'otherInsuredMiddleName' => '',
                                    'otherInsuredNameSuffix' => '',
                                    'otherInsuredIdentifierTypeCode' => 'II',
                                    'otherInsuredIdentifier' => '',
                                    'otherInsuredAddress' => [
                                        'address1' => '123 address1',
                                        'address2' => 'apt 000',
                                        'city' => 'city1',
                                        'state' => 'wa',
                                        'postalCode' => '981010000',
                                        'countryCode' => '',
                                        'countrySubDivisionCode' => ''
                                    ],
                                    'otherInsuredAdditionalIdentifier' => ''
                                ],
                                'otherPayerName' => [
                                    'otherInsuredAdditionalIdentifier' => '',
                                    'otherPayerOrganizationName' => '',
                                    'otherPayerIdentifierTypeCode' => 'PI',
                                    'otherPayerIdentifier' => '',
                                    'otherPayerAddress' => [
                                        'address1' => '123 address1',
                                        'address2' => 'apt 000',
                                        'city' => 'city1',
                                        'state' => 'wa',
                                        'postalCode' => '981010000',
                                        'countryCode' => '',
                                        'countrySubDivisionCode' => ''
                                    ],
                                    'otherPayerAdjudicationOrPaymentDate' => '',
                                    'otherPayerSecondaryIdentifier' => [
                                        [
                                            'qualifier' => '',
                                            'identifier' => '',
                                            'otherIdentifier' => ''
                                        ]
                                    ],
                                    'otherPayerPriorAuthorizationNumber' => '',
                                    'otherPayerPriorAuthorizationOrReferralNumber' => '',
                                    'otherPayerClaimAdjustmentIndicator' => true,
                                    'otherPayerClaimControlNumber' => ''
                                ],
                                'otherPayerReferringProvider' => [
                                    [
                                        'otherPayerReferringProviderIdentifier' => [
                                            [
                                                'qualifier' => '',
                                                'identifier' => '',
                                                'otherIdentifier' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerRenderingProvider' => [
                                    [
                                        'entityTypeQualifier' => '1',
                                        'otherPayerRenderingProviderSecondaryIdentifier' => [
                                            [
                                                'qualifier' => '',
                                                'identifier' => '',
                                                'otherIdentifier' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerServiceFacilityLocation' => [
                                    [
                                        'otherPayerServiceFacilityLocationSecondaryIdentifier' => [
                                            [
                                                'qualifier' => '',
                                                'identifier' => '',
                                                'otherIdentifier' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerSupervisingProvider' => [
                                    [
                                        'otherPayerSupervisingProviderIdentifier' => [
                                            [
                                                'qualifier' => '',
                                                'identifier' => '',
                                                'otherIdentifier' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'otherPayerBillingProvider' => [
                                    [
                                        'entityTypeQualifier' => '1',
                                        'otherPayerBillingProviderIdentifier' => [
                                            [
                                                'qualifier' => '',
                                                'identifier' => '',
                                                'otherIdentifier' => ''
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],*/
                'serviceLines' => $serviceLines, /* [
                    [
                        'assignedNumber' => '',
                        'serviceDate' => '20050514',
                        'serviceDateEnd' => '',
                        'providerControlNumber' => '',
                        'professionalService' => [
                            'procedureIdentifier' => 'HC',
                            'procedureCode' => 'E0570',
                            'procedureModifiers' => [
                                ''
                            ],
                            'description' => '',
                            'lineItemChargeAmount' => '25',
                            'measurementUnit' => 'UN',
                            'serviceUnitCount' => '1',
                            'placeOfServiceCode' => '',
                            'compositeDiagnosisCodePointers' => [
                                'diagnosisCodePointers' => 1
                            ],
                            'emergencyIndicator' => 'Y',
                            'epsdtIndicator' => 'Y',
                            'familyPlanningIndicator' => 'Y',
                            'copayStatusCode' => '0'
                        ],
                        'durableMedicalEquipmentService' => [
                            'days' => '',
                            'rentalPrice' => '',
                            'purchasePrice' => '',
                            'frequencyCode' => '1'
                        ],
                        'serviceLineSupplementalInformation' => [
                            [
                                'attachmentReportTypeCode' => '93',
                                'attachmentTransmissionCode' => 'AA',
                                'attachmentControlNumber' => ''
                            ]
                        ],
                        'durableMedicalEquipmentCertificateOfMedicalNecessity' => [
                            'attachmentTransmissionCode' => 'AB'
                        ],
                        'ambulanceTransportInformation' => [
                            'patientWeightInPounds' => '',
                            'ambulanceTransportReasonCode' => 'A',
                            'transportDistanceInMiles' => '',
                            'roundTripPurposeDescription' => '',
                            'stretcherPurposeDescription' => ''
                        ],
                        'durableMedicalEquipmentCertification' => [
                            'certificationTypeCode' => 'I',
                            'durableMedicalEquipmentDurationInMonths' => ''
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
                            'prescriptionDate' => '',
                            'certificationRevisionOrRecertificationDate' => '',
                            'beginTherapyDate' => '',
                            'lastCertificationDate' => '',
                            'treatmentOrTherapyDate' => '',
                            'hemoglobinTestDate' => '',
                            'serumCreatineTestDate' => '',
                            'shippedDate' => '',
                            'lastXRayDate' => '',
                            'initialTreatmentDate' => ''
                        ],
                        'ambulancePatientCount' => 0,
                        'obstetricAnesthesiaAdditionalUnits' => 0,
                        'testResults' => [
                            [
                                'measurementReferenceIdentificationCode' => 'OG',
                                'measurementQualifier' => 'HT',
                                'testResults' => ''
                            ]
                        ],
                        'contractInformation' => [
                            'contractTypeCode' => '01',
                            'contractAmount' => '',
                            'contractPercentage' => '',
                            'contractCode' => '',
                            'termsDiscountPercentage' => '',
                            'contractVersionIdentifier' => ''
                        ],
                        'serviceLineReferenceInformation' => [
                            'repricedLineItemReferenceNumber' => '',
                            'adjustedRepricedLineItemReferenceNumber' => '',
                            'priorAuthorization' => [
                                [
                                    'priorAuthorizationOrReferralNumber' => '',
                                    'otherPayerPrimaryIdentifier' => ''
                                ]
                            ],
                            'mammographyCertificationNumber' => '',
                            'clinicalLaboratoryImprovementAmendmentNumber' => '',
                            'referringCliaNumber' => '',
                            'immunizationBatchNumber' => '',
                            'referralNumber' => [
                                ''
                            ]
                        ],
                        'salesTaxAmount' => '',
                        'postageTaxAmount' => '',
                        'fileInformation' => [
                            ''
                        ],
                        'additionalNotes' => '',
                        'goalRehabOrDischargePlans' => '',
                        'thirdPartyOrganizationNotes' => '',
                        'purchasedServiceInformation' => [
                            'purchasedServiceProviderIdentifier' => '01',
                            'purchasedServiceChargeAmount' => '10'
                        ],
                        'linePricingRepricingInformation' => [
                            'pricingMethodologyCode' => '01',
                            'repricedAllowedAmount' => '1',
                            'repricedSavingAmount' => '',
                            'repricingOrganizationIdentifier' => '',
                            'repricingPerDiemOrFlatRateAmoung' => '',
                            'repricedApprovedAmbulatoryPatientGroupCode' => '',
                            'repricedApprovedAmbulatoryPatientGroupAmount' => '',
                            'rejectReasonCode' => 'T1',
                            'policyComplianceCode' => '1',
                            'exceptionCode' => '1'
                        ],
                        'drugIdentification' => [
                            'serviceIdQualifier' => 'EN',
                            'nationalDrugCode' => '',
                            'nationalDrugUnitCount' => '',
                            'measurementUnitCode' => 'F2',
                            'linkSequenceNumber' => '',
                            'pharmacyPrescriptionNumber' => ''
                        ],
                        'renderingProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => '',
                            'locationNumber' => '',
                            'payerIdentificationNumber' => '',
                            'employerIdentificationNumber' => '',
                            'claimOfficeNumber' => '',
                            'naic' => '',
                            'stateLicenseNumber' => '',
                            'providerUpinNumber' => '',
                            'taxonomyCode' => '',
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
                                'countryCode' => '',
                                'countrySubDivisionCode' => ''
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => '',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
                                ]
                            ]
                        ],
                        'purchasedServiceProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => '',
                            'locationNumber' => '',
                            'payerIdentificationNumber' => '',
                            'employerIdentificationNumber' => '',
                            'claimOfficeNumber' => '',
                            'naic' => '',
                            'stateLicenseNumber' => '',
                            'providerUpinNumber' => '',
                            'taxonomyCode' => '',
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
                                'countryCode' => '',
                                'countrySubDivisionCode' => ''
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => '',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
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
                                'countryCode' => '',
                                'countrySubDivisionCode' => ''
                            ],
                            'npi' => '',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
                                ]
                            ],
                            'phoneName' => '',
                            'phoneNumber' => '',
                            'phoneExtension' => ''
                        ],
                        'supervisingProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => '',
                            'locationNumber' => '',
                            'payerIdentificationNumber' => '',
                            'employerIdentificationNumber' => '',
                            'claimOfficeNumber' => '',
                            'naic' => '',
                            'stateLicenseNumber' => '',
                            'providerUpinNumber' => '',
                            'taxonomyCode' => '',
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
                                'countryCode' => '',
                                'countrySubDivisionCode' => ''
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => '',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
                                ]
                            ]
                        ],
                        'orderingProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => '',
                            'locationNumber' => '',
                            'payerIdentificationNumber' => '',
                            'employerIdentificationNumber' => '',
                            'claimOfficeNumber' => '',
                            'naic' => '',
                            'stateLicenseNumber' => '',
                            'providerUpinNumber' => '',
                            'taxonomyCode' => '',
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
                                'countryCode' => '',
                                'countrySubDivisionCode' => ''
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => '',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
                                ]
                            ]
                        ],
                        'referringProvider' => [
                            'providerType' => 'BillingProvider',
                            'npi' => '1760854442',
                            'ssn' => '000000000',
                            'employerId' => '123456789',
                            'commercialNumber' => '',
                            'locationNumber' => '',
                            'payerIdentificationNumber' => '',
                            'employerIdentificationNumber' => '',
                            'claimOfficeNumber' => '',
                            'naic' => '',
                            'stateLicenseNumber' => '',
                            'providerUpinNumber' => '',
                            'taxonomyCode' => '',
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
                                'countryCode' => '',
                                'countrySubDivisionCode' => ''
                            ],
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '5554567890',
                                'faxNumber' => '5551234567',
                                'email' => 'email@email.com',
                                'phoneExtension' => '1234'
                            ],
                            'otherIdentifier' => '',
                            'secondaryIdentifier' => [
                                [
                                    'qualifier' => '',
                                    'identifier' => '',
                                    'otherIdentifier' => ''
                                ]
                            ]
                        ],
                        'ambulancePickUpLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => ''
                        ],
                        'ambulanceDropOffLocation' => [
                            'address1' => '123 address1',
                            'address2' => 'apt 000',
                            'city' => 'city1',
                            'state' => 'wa',
                            'postalCode' => '981010000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => ''
                        ],
                        'lineAdjudicationInformation' => [
                            [
                                'otherPayerPrimaryIdentifier' => '',
                                'serviceLinePaidAmount' => '',
                                'serviceIdQualifier' => 'ER',
                                'procedureCode' => '',
                                'procedureModifier' => [
                                    ''
                                ],
                                'procedureCodeDescription' => '',
                                'paidServiceUnitCount' => '',
                                'bundledOrUnbundledLineNumber' => '',
                                'claimAdjustmentInformation' => [
                                    [
                                        'adjustmentGroupCode' => 'CO',
                                        'adjustmentDetails' => [
                                            [
                                                'adjustmentReasonCode' => '',
                                                'adjustmentAmount' => '',
                                                'adjustmentQuantity' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'adjudicationOrPaymentDate' => '',
                                'remainingPatientLiability' => ''
                            ]
                        ],
                        'formIdentification' => [
                            [
                                'formTypeCode' => 'AS',
                                'formIdentifier' => '',
                                'supportingDocumentation' => [
                                    [
                                        'questionNumber' => '',
                                        'questionResponseCode' => 'N',
                                        'questionResponse' => '',
                                        'questionResponseAsDate' => '',
                                        'questionResponseAsPercent' => ''
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]*/
            ],
            ClaimType::INSTITUTIONAL => [
                'claimFilingCode' => 'CI',
                'patientControlNumber' => $this->claim->demographicInformation?->patient?->code,
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
                    '',
                ],
                'claimNotes' => [
                    'goalRehabOrDischargePlans' => [
                        '',
                    ],
                    'diagnosisDescription' => [
                        '',
                    ],
                    'allergies' => [
                        '',
                    ],
                    'dme' => [
                        '',
                    ],
                    'medications' => [
                        '',
                    ],
                    'nutritionalRequirments' => [
                        '',
                    ],
                    'ordersForDiscipLinesAndTreatments' => [
                        '',
                    ],
                    'functionalLimitsOrReasonHomebound' => [
                        '',
                    ],
                    'reasonsPatientLeavesHome' => [
                        '',
                    ],
                    'timesAndReasonsPatientNotAtHome' => [
                        '',
                    ],
                    'unusualHomeOrSocialEnv' => [
                        '',
                    ],
                    'safetyMeasures' => [
                        '',
                    ],
                    'supplementalPlanOfTreatment' => [
                        '',
                    ],
                    'updatedInformation' => [
                        '',
                    ],
                    'additionalInformation' => [
                        '',
                    ],
                ],*/
                'claimDateInformation' => [
                    'admissionDateAndHour' => str_replace('-', '', $this->claim->patientInformation->admission_date ?? '').substr(str_replace(':', '', $this->claim->patientInformation->admission_time ?? ''), 0, 3),
                    'statementBeginDate' => str_replace('-', '', $this->claim->service?->from ?? ''),
                    'statementEndDate' => str_replace('-', '', $this->claim->service?->to ?? ''),
                    'dischargeHour' => str_replace('-', '', $this->claim->patientInformation->discharge_date ?? '').substr(str_replace(':', '', $this->claim->patientInformation->discharge_time ?? ''), 0, 3),
                    'repricerReceivedDate' => Carbon::now()->format('Ymd'),
                ],
                /**'claimContractInformation' => [
                    'contractTypeCode' => '01',
                    'contractAmount' => '',
                    'contractPercentage' => '',
                    'contractCode' => '',
                    'termsDiscountPercentage' => '',
                    'contractVersionIdentifier' => ''
                ],*/
                'claimSupplementalInformation' => [
                    /*'reportInformation' => [
                        'attachmentReportTypeCode' => '03',
                        'attachmentTransmissionCode' => 'AA',
                        'attachmentControlNumber' => ''
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
                        'patientReasonForVisitCode' => '',
                    ],
                ],
                'externalCauseOfInjuries' => [
                    [
                        'qualifierCode' => 'ABN',
                        'externalCauseOfInjury' => '',
                        'presentOnAdmissionIndicator' => 'N',
                    ],
                ],*/
                'diagnosisRelatedGroupInformation' => [
                    'drugRelatedGroupCode' => $this->claim->service?->diagnosisRelatedGroup?->code ?? null,
                ],
                'otherDiagnosisInformationList' => [
                    $this->claim->service->diagnoses
                        // ->skip(1)
                        ->map(fn ($diagnosis, $index) => [
                            'qualifierCode' => 'ABF',
                            'otherDiagnosisCode' => $diagnosis->code,
                            'presentOnAdmissionIndicator' => (true === $diagnosis->pivot?->admission ?? false) ? 'Y' : 'N',
                        ])->values()->toArray(),
                ],
                'principalProcedureInformation' => isset($claimServiceLinePrincipal)
                    ? [
                        'qualifierCode' => 'BBR',
                        'principalProcedureCode' => $claimServiceLinePrincipal->procedure?->code,
                        'principalProcedureDate' => str_replace('-', '', $claimServiceLinePrincipal->from_service),
                    ]
                    : null,
                /*'otherProcedureInformationList' => [
                    $this->claim->service->services
                        ->skip(1)
                        ->map(fn ($service, $index) => [
                            'qualifierCode' => 'BBQ',
                            'otherProcedureCode' => $service->procedure?->code,
                            'otherProcedureDate' => str_replace('-', '', $service->from_service),
                        ])->toArray(),
                ],*/
                'occurrenceSpanInformations' => [
                    [
                        [
                            'occurrenceSpanCode' => '',
                            'occurrenceSpanCodeStartDate' => '',
                            'occurrenceSpanCodeEndDate' => '',
                        ],
                    ],
                ],
                'valueInformationList' => [
                    [
                        [
                            'valueCode' => '',
                            'valueCodeAmount' => '',
                        ],
                    ],
                ],
                'occurrenceInformationList' => [
                    [
                        [
                            'occurrenceSpanCode' => '',
                            'occurrenceSpanCodeDate' => '',
                        ],
                    ],
                ],
                'treatmentCodeInformationList' => [
                    [
                        '',
                    ],
                ],
                'conditionCodesList' => [
                    [
                        [
                            'conditionCode' => '',
                        ],
                    ],
                ],
                /*'claimPricingInformation' => [
                    'pricingMethodologyCode' => '00',
                    'repricedAllowedAmount' => '',
                    'repricedSavingAmount' => '',
                    'repricedOrgIdentifier' => '',
                    'repricedPerDiem' => '',
                    'repricedApprovedDRGCode' => '',
                    'repricedApprovedAmount' => '',
                    'repricedApprovedRevenueCode' => '',
                    'repricedApprovedServiceUnitCode' => 'DA',
                    'repricedApprovedServiceUnitCount' => '',
                    'rejectReasonCode' => 'T1',
                    'policyComplianceCode' => '1',
                    'exceptionCode' => '1',
                    'productOrServiceIDQualifier' => 'ER',
                    'repricedApprovedHCPCSCode' => '',
                ],*/
                'serviceFacilityLocation' => [
                    'address' => [
                        'address1' => $this->getFacilityAddressAttribute('address', '1'),
                        'address2' => null,
                        'city' => $this->getFacilityAddressAttribute('city', '1'),
                        'state' => $this->getFacilityAddressAttribute('state', '1'),
                        'postalCode' => $this->getFacilityAddressAttribute('zip', '1'),
                        'countryCode' => ('US' !== $this->getFacilityAddressAttribute('country', '1'))
                            ? $this->getFacilityAddressAttribute('country', '1')
                            : '',
                        'countrySubDivisionCode' => ('US' !== $this->getFacilityAddressAttribute('country', '1'))
                            ? $this->getFacilityAddressAttribute('country_subdivision_code', '1')
                            : '',
                    ],
                    'organizationName' => $this->getFacilityAttribute('name'),
                    // 'secondaryIdentificationQualifierCode' => '0B',
                    // 'secondaryIdentifier' => '',
                    // 'identificationCode' => '',
                ],
                /*'otherSubscriberInformation' => [
                    'paymentResponsibilityLevelCode' => 'A',
                    'individualRelationshipCode' => '01',
                    'claimFilingIndicatorCode' => '11',
                    'benefitsAssignmentCertificationIndicator' => 'N',
                    'releaseOfInformationCode' => 'I',
                    'medicareInpatientAdjudication' => [
                        'claimPaymentRemarkCode' => [
                            '',
                        ],
                        'coveredDaysOrVisitsCount' => '',
                        'lifetimePsychiatricDaysCount' => '',
                        'claimDRGAmount' => '',
                        'claimDisproportionateShareAmount' => '',
                        'claimMspPassThroughAmount' => '',
                        'claimPpsCapitalAmount' => '',
                        'ppsCapitalHspDrgAmount' => '',
                        'capitalHSPDRGAmount' => '',
                        'ppsCapitalDshDrgAmount' => '',
                        'oldCapitalAmount' => '',
                        'ppsCapitalImeAmount' => '',
                        'ppsOperatingHospitalSpecificDrgAmount' => '',
                        'costReportDayCount' => '',
                        'ppsOperatingFederalSpecificDrgAmount' => '',
                        'claimPpsCapitalOutlierAmmount' => '',
                        'claimIndirectTeachingAmount' => '',
                        'nonPayableProfessionalComponentBilledAmount' => '',
                        'capitalExceptionAmount' => '',
                    ],
                    'medicareOutpatientAdjudication' => [
                        'claimPaymentRemarkCode' => [
                            '',
                        ],
                        'reimbursementRate' => '',
                        'hcpcsPayableAmount' => '',
                        'endStageRenalDiseasePaymentAmount' => '',
                        'nonPayableProfessionalComponentBilledAmount' => '',
                    ],
                    'otherSubscriberName' => [
                        'otherInsuredQualifier' => '1',
                        'otherInsuredIdentifierTypeCode' => 'II',
                        'otherInsuredAdditionalIdentifier' => [
                            '',
                        ],
                        'address' => [
                            'address1' => '000 address1',
                            'address2' => '',
                            'city' => 'city1',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => '',
                        ],
                        'otherInsuredLastName' => '',
                        'otherInsuredFirstName' => '',
                        'otherInsuredMiddleName' => '',
                        'otherInsuredSuffix' => '',
                        'otherInsuredIdentifier' => '',
                        'firstName' => '',
                    ],
                    'claimLevelAdjustments' => [
                        [
                            'adjustmentGroupCode' => 'CO',
                            'claimAdjustmentDetails' => [
                                [
                                    'adjustmentReasonCode' => '',
                                    'adjustmentAmount' => '',
                                    'adjustmentQuantity' => '',
                                ],
                            ],
                        ],
                    ],
                    'otherPayerName' => [
                        'otherPayerIdentifierTypeCode' => 'PI',
                        'otherPayerAddress' => [
                            'address1' => '000 address1',
                            'address2' => '',
                            'city' => 'city1',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                            'countryCode' => '',
                            'countrySubDivisionCode' => '',
                        ],
                        'otherPayerSecondaryIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                        'otherPayerClaimAdjustmentIndicator' => false,
                        'otherInsuredAdditionalIdentifier' => '',
                        'otherPayerOrganizationName' => '',
                        'otherPayerIdentifier' => '',
                        'otherPayerAdjudicationOrPaymentDate' => '',
                        'otherPayerPriorAuthorizationNumber' => '',
                        'otherPayerPriorAuthorizationOrReferralNumber' => '',
                        'otherPayerClaimControlNumber' => '',
                    ],
                    'otherPayerAttendingProvider' => [
                        'otherPayerAttendingProviderIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'otherPayerOperatingPhysician' => [
                        'otherPayerOperatingPhysicianIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'otherPayerOtherOperatingPhysician' => [
                        'otherPayerOtherOperatingPhysicianIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'otherPayerServiceFacilityLocation' => [
                        'otherPayerServiceFacilityLocationIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'otherPayerRenderingProvider' => [
                        'otherPayerRenderingProviderIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'otherPayerReferringProvider' => [
                        'otherPayerReferringProviderIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'otherPayerBillingProvider' => [
                        'otherPayerBillingProviderIdentifier' => [
                            [
                                'qualifier' => '',
                                'identifier' => '',
                            ],
                        ],
                    ],
                    'policyNumber' => '',
                    'groupNumber' => '',
                    'otherInsuredGroupName' => '',
                    'payerPaidAmount' => '',
                    'remainingPatientLiability' => '',
                    'nonCoveredChargeAmount' => '',
                ],*/
                'serviceLines' => $serviceLines, /*[
                    [
                        'lineAdjudicationInformation' => [
                            [
                                'procedureModifier' => [
                                    '',
                                ],
                                'lineAdjustment' => [
                                    [
                                        'adjustmentGroupCode' => 'CO',
                                        'claimAdjustmentDetails' => [
                                            [
                                                'adjustmentReasonCode' => '',
                                                'adjustmentAmount' => '',
                                                'adjustmentQuantity' => '',
                                            ],
                                        ],
                                    ],
                                ],
                                'otherPayerPrimaryIdentifier' => '',
                                'serviceLinePaidAmount' => '',
                                'productOrServiceIDQualifier' => 'ER',
                                'procedureCode' => '',
                                'serviceLineRevenueCode' => '',
                                'procedureCodeDescription' => '',
                                'paidServiceUnitCount' => '',
                                'bundledLineNumber' => '',
                                'adjudicationOrPaymentDate' => '',
                                'remainingPatientLiability' => '',
                            ],
                        ],
                        'renderingProvider' => [
                            'providerType' => 'BillingProvider',
                            'address' => [
                                'address1' => '000 address1',
                                'address2' => '',
                                'city' => 'city1',
                                'state' => 'tn',
                                'postalCode' => '372030000',
                                'countryCode' => '',
                                'countrySubDivisionCode' => '',
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
                                    'qualifier' => '',
                                    'identifier' => '',
                                ],
                            ],
                            'npi' => '1760854442',
                            'secondaryIdentificationQualifierCode' => '0B',
                            'secondaryIdentifier' => '',
                            'employerId' => '',
                            'taxonomyCode' => '',
                            'firstName' => 'johntwo',
                            'lastName' => 'doetwo',
                            'middleName' => 'middletwo',
                            'suffix' => '',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                        ],
                        'referringProvider' => [
                            'providerType' => 'BillingProvider',
                            'address' => [
                                'address1' => '000 address1',
                                'address2' => '',
                                'city' => 'city1',
                                'state' => 'tn',
                                'postalCode' => '372030000',
                                'countryCode' => '',
                                'countrySubDivisionCode' => '',
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
                                    'qualifier' => '',
                                    'identifier' => '',
                                ],
                            ],
                            'npi' => '1760854442',
                            'secondaryIdentificationQualifierCode' => '0B',
                            'secondaryIdentifier' => '',
                            'employerId' => '',
                            'taxonomyCode' => '',
                            'firstName' => 'johntwo',
                            'lastName' => 'doetwo',
                            'middleName' => 'middletwo',
                            'suffix' => '',
                            'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                        ],
                        'lineSupplementInformation' => [
                            'reportInformation' => [
                                'attachmentReportTypeCode' => '03',
                                'attachmentTransmissionCode' => 'AA',
                                'attachmentControlNumber' => '',
                            ],
                            'priorAuthorizationNumber' => '',
                            'referralNumber' => '',
                            'claimControlNumber' => '',
                            'repricedClaimNumber' => '',
                            'investigationalDeviceExemptionNumber' => '',
                            'claimNumber' => '',
                            'medicalRecordNumber' => '',
                            'demoProjectIdentifier' => '',
                            'serviceAuthorizationExceptionCode' => '1',
                            'autoAccidentState' => '',
                            'peerReviewAuthorizationNumber' => '',
                            'adjustedRepricedClaimRefNumber' => '',
                        ],
                        'institutionalService' => [
                            'procedureModifiers' => [
                                '1234',
                            ],
                            'measurementUnit' => 'DA, UN',
                            'serviceLineRevenueCode' => '',
                            'procedureIdentifier' => 'ER',
                            'procedureCode' => '80199',
                            'description' => 'Some description text about the procedure',
                            'lineItemChargeAmount' => '',
                            'serviceUnitCount' => '',
                            'nonCoveredChargeAmount' => '',
                        ],
                        'serviceLineSupplementalInformation' => [
                            'attachmentReportTypeCode' => '03',
                            'attachmentTransmissionCode' => 'AA',
                            'attachmentControlNumber' => '',
                        ],
                        'serviceLineReferenceInformation' => [
                            'providerControlNumber' => '',
                            'repricedLineItemRefNumber' => '',
                            'adjustedRepricedLineItemRefNumber' => '',
                        ],
                        'drugIdentification' => [
                            'measurementUnitCode' => 'F2',
                            'nationalDrugCode' => '',
                            'nationalDrugUnitCount' => '',
                            'linkSequenceNumber' => '',
                            'pharmacyPrescriptionNumber' => '',
                        ],
                        'lineAdjustmentInformation' => [
                            'claimAdjustment' => [
                                'adjustmentGroupCode' => 'CO',
                            ],
                        ],
                        'operatingPhysician' => [
                            'organizationName' => '',
                            'identificationQualifierCode' => '0B',
                            'secondaryIdentifier' => '',
                            'firstName' => '',
                            'lastName' => '',
                            'middleName' => '',
                            'suffix' => '',
                            'npi' => '',
                        ],
                        'otherOperatingPhysician' => [
                            'organizationName' => '',
                            'identificationQualifierCode' => '0B',
                            'secondaryIdentifier' => '',
                            'firstName' => '',
                            'lastName' => '',
                            'middleName' => '',
                            'suffix' => '',
                            'npi' => '',
                        ],
                        'lineRepricingInformation' => [
                            'pricingMethodologyCode' => '00',
                            'repricedAllowedAmount' => '',
                            'repricedSavingAmount' => '',
                            'repricedOrgIdentifier' => '',
                            'repricedPerDiem' => '',
                            'repricedApprovedDRGCode' => '',
                            'repricedApprovedAmount' => '',
                            'repricedApprovedRevenueCode' => '',
                            'repricedApprovedServiceUnitCode' => 'DA',
                            'repricedApprovedServiceUnitCount' => '',
                            'rejectReasonCode' => 'T1',
                            'policyComplianceCode' => '1',
                            'exceptionCode' => '1',
                            'productOrServiceIDQualifier' => 'ER',
                            'repricedApprovedHCPCSCode' => '',
                        ],
                        'assignedNumber' => '1',
                        'serviceDate' => '',
                        'serviceDateEnd' => '',
                        'serviceTaxAmount' => '',
                        'facilityTaxAmount' => '',
                        'lineItemControlNumber' => '',
                        'repricedLineItemReferenceNumber' => '',
                        'description' => '',
                        'adjustedRepricedLineItemReferenceNumber' => '',
                        'lineNoteText' => '',
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
            'primaryIdentifier' => '',
            'address' => [
                'address1' => '123 address1',
                'address2' => 'apt 000',
                'city' => 'city1',
                'state' => 'wa',
                'postalCode' => '981010000',
                'countryCode' => '',
                'countrySubDivisionCode' => '',
            ],
            'secondaryIdentifierTypeCode' => '2U',
            'secondaryIdentifier' => '11',
            'taxIdentificationNumber' => '',
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
            'countryCode' => '',
            'countrySubDivisionCode' => '',
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
            // 'commercialNumber' => '',
            // 'locationNumber' => '',
            // 'payerIdentificationNumber' => '',
            // 'employerIdentificationNumber' => '',
            // 'claimOfficeNumber' => '',
            // 'naic' => '',
            // 'stateLicenseNumber' => '',
            // 'providerUpinNumber' => '',
            // 'taxonomyCode' => '',
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
                'countryCode' => ('US' !== $billingProviderAddress?->country)
                    ? $billingProviderAddress?->country
                    : '',
                'countrySubDivisionCode' => ('US' !== $billingProviderAddress?->country)
                    ? $billingProviderAddress?->country_subdivision_code
                    : '',
            ],
            'contactInformation' => [
                'name' => $billingProviderContact->contact_name ?? $billingProvider->name,
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
            // 'commercialNumber' => '',
            // 'locationNumber' => '',
            // 'payerIdentificationNumber' => '',
            // 'employerIdentificationNumber' => '',
            // 'claimOfficeNumber' => '',
            // 'naic' => '',
            // 'stateLicenseNumber' => '',
            'providerUpinNumber' => str_replace('-', '', $referringProvider->upin ?? ''),
            // 'taxonomyCode' => '',
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
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
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
                'countryCode' => '',
                'countrySubDivisionCode' => '',
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
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
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
                'countryCode' => '',
                'countrySubDivisionCode' => '',
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
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
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
                'countryCode' => '',
                'countrySubDivisionCode' => '',
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
