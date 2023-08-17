<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    '0a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'higherInsuranceCompany:name',
        ],
        'values' => [
            'common' => [
                'insuranceCompany.name',
                'insuranceCompany.address',
            ],
        ],
    ],
    '0b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'higherInsuranceCompany:address',
        ],
        'values' => [
            'common' => [
                'higherInsuranceCompany:name',
                'higherInsuranceCompany:address',
            ],
        ],
    ],
    '0c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'value' => [
            'higherInsuranceCompany:city',
            'higherInsuranceCompany:state',
            'higherInsuranceCompany:zip',
        ],
    ],
    '1' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'insType:code',
    ],
    '1a' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'higherOrderPolicy:policy_number',
    ],
    '2' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'patientProfile:last_name',
            'patientProfile:name_suffix',
            'patientProfile:first_name',
            'patientProfile:middle_name',
        ],
    ],
    '3a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'patientProfile:year_of_birth',
        ],
        'values' => [
            'common' => [
                'patientProfile:year_of_birth',
                'patientProfile:month_of_birth',
                'patientProfile:day_of_birth',
                'patientProfile:sex',
            ],
        ],
    ],
    '3b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'patientProfile:month_of_birth',
        ],
        'values' => [
            'common' => [
                'patientProfile:year_of_birth',
                'patientProfile:month_of_birth',
                'patientProfile:day_of_birth',
                'patientProfile:sex',
            ],
        ],
    ],
    '3c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'patientProfile:day_of_birth',
        ],
        'values' => [
            'common' => [
                'patientProfile:year_of_birth',
                'patientProfile:month_of_birth',
                'patientProfile:day_of_birth',
                'patientProfile:sex',
            ],
        ],
    ],
    '3d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 1,
        'value' => [
            'patientProfile:sex',
        ],
        'values' => [
            'common' => [
                'patientProfile:year_of_birth',
                'patientProfile:month_of_birth',
                'patientProfile:day_of_birth',
                'patientProfile:sex',
            ],
        ],
    ],
    '4' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'subscriber:last_name',
            'subscriber:name_suffix',
            'subscriber:first_name',
            'subscriber:middle_name',
        ],
    ],
    '5a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'patientAddress:address',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
                'patientContact:code',
                'patientContact:number',
            ],
        ],
    ],
    '5b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'patientAddress:city',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
                'patientContact:code',
                'patientContact:number',
            ],
        ],
    ],
    '5c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'patientAddress:state',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
                'patientContact:code',
                'patientContact:number',
            ],
        ],
    ],
    '5d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'value' => [
            'patientAddress:zip',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
                'patientContact:code',
                'patientContact:number',
            ],
        ],
    ],
    '5e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'value' => [
            'patientContact:code',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
                'patientContact:code',
                'patientContact:number',
            ],
        ],
    ],
    '5f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 11,
        'value' => [
            'patientContact:number',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
                'patientContact:code',
                'patientContact:number',
            ],
        ],
    ],
    '6' => [
        'type' => RuleType::SINGLE->value,
        'length' => 6,
        'value' => 'subscriberRelationship:description',
    ],
    '7a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'subscriberAddress:address',
        ],
        'values' => [
            'common' => [
                'subscriberAddress:address',
                'subscriberAddress:city',
                'subscriberAddress:state',
                'subscriberAddress:zip',
                'subscriberContact:code',
                'subscriberContact:number',
            ],
        ],
    ],
    '7b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'subscriberAddress:city',
        ],
        'values' => [
            'common' => [
                'subscriberAddress:address',
                'subscriberAddress:city',
                'subscriberAddress:state',
                'subscriberAddress:zip',
                'subscriberContact:code',
                'subscriberContact:number',
            ],
        ],
    ],
    '7c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'subscriberAddress:state',
        ],
        'values' => [
            'common' => [
                'subscriberAddress:address',
                'subscriberAddress:city',
                'subscriberAddress:state',
                'subscriberAddress:zip',
                'subscriberContact:code',
                'subscriberContact:number',
            ],
        ],
    ],
    '7d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'value' => [
            'subscriberAddress:zip',
        ],
        'values' => [
            'common' => [
                'subscriberAddress:address',
                'subscriberAddress:city',
                'subscriberAddress:state',
                'subscriberAddress:zip',
                'subscriberContact:code',
                'subscriberContact:number',
            ],
        ],
    ],
    '7e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'value' => [
            'subscriberContact:code',
        ],
        'values' => [
            'common' => [
                'subscriberAddress:address',
                'subscriberAddress:city',
                'subscriberAddress:state',
                'subscriberAddress:zip',
                'subscriberContact:code',
                'subscriberContact:number',
            ],
        ],
    ],
    '7f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'value' => [
            'subscriberContact:number',
        ],
        'values' => [
            'common' => [
                'subscriberAddress:address',
                'subscriberAddress:city',
                'subscriberAddress:state',
                'subscriberAddress:zip',
                'subscriberContact:code',
                'subscriberContact:number',
            ],
        ],
    ],
    '9' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'lowerSubscriber:last_name',
            'lowerSubscriber:name_suffix',
            'lowerSubscriber:first_name',
            'lowerSubscriber:middle_name',
        ],
    ],
    '9a' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'lowerOrderPolicy:policy_number',
    ],
    '9d' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'lowerInsurancePlan:name',
    ],
    '10a' => [
        'type' => RuleType::BOOLEAN->value,
        'value' => 'claimDemographicInformation:employment_related_condition',
    ],
    '10ba' => [
        'type' => RuleType::BOOLEAN->value,
        'value' => 'claimDemographicInformation:auto_accident_related_condition',
    ],
    '10bb' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'value' => [
            'claimDemographicInformation:auto_accident_place_state',
        ],
        'values' => [
            'common' => [
                'claimDemographicInformation:auto_accident_related_condition',
                'claimDemographicInformation:auto_accident_place_state',
            ],
        ],
    ],
    '10c' => [
        'type' => RuleType::BOOLEAN->value,
        'value' => 'claimDemographicInformation:other_accident_related_condition',
    ],
    '10d' => [
        'type' => RuleType::SINGLE->value,
        'value' => '| ',
    ],
    '11' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'higherOrderPolicy:group_number',
    ],
    '11aa' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'subscriber:year_of_birth',
        ],
        'values' => [
            'common' => [
                'subscriber:year_of_birth',
                'subscriber:month_of_birth',
                'subscriber:day_of_birth',
                'subscriber:sex',
            ],
        ],
    ],
    '11ab' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'subscriber:month_of_birth',
        ],
        'values' => [
            'common' => [
                'subscriber:year_of_birth',
                'subscriber:month_of_birth',
                'subscriber:day_of_birth',
                'subscriber:sex',
            ],
        ],
    ],
    '11ac' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'subscriber:day_of_birth',
        ],
        'values' => [
            'common' => [
                'subscriber:year_of_birth',
                'subscriber:month_of_birth',
                'subscriber:day_of_birth',
                'subscriber:sex',
            ],
        ],
    ],
    '11ad' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 1,
        'value' => [
            'subscriber:sex',
        ],
        'values' => [
            'common' => [
                'subscriber:year_of_birth',
                'subscriber:month_of_birth',
                'subscriber:day_of_birth',
                'subscriber:sex',
            ],
        ],
    ],
    '11b' => [
        'type' => RuleType::SINGLE->value,
        'value' => '| ',
    ],
    '11c' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'higherInsurancePlan:name',
    ],
    '11d' => [
        'type' => RuleType::BOOLEAN->value,
        'value' => 'existLowerInsurancePlan',
    ],
    '12a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'patientSignature:patient_signature',
        ],
        'values' => [
            'common' => [
                'patientSignature:patient_signature',
            ],
        ],
    ],
    '12b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'value' => [
            'firstClaimService:from_service',
        ],
        'values' => [
            'common' => [
                'patientSignature:patient_signature',
                'firstClaimService:from_service',
            ],
        ],
    ],
    '13' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'patientSignature:insured_signature',
    ],
    '14a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateCurrentInformation:month_of_from_date',
                'claimDateCurrentInformation:day_of_from_date',
                'claimDateCurrentInformation:year_of_from_date',
                'claimDateCurrentInformation:qualifier',
            ],
        ],
    ],
    '14b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateCurrentInformation:month_of_from_date',
                'claimDateCurrentInformation:day_of_from_date',
                'claimDateCurrentInformation:year_of_from_date',
                'claimDateCurrentInformation:qualifier',
            ],
        ],
    ],
    '14c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateCurrentInformation:month_of_from_date',
                'claimDateCurrentInformation:day_of_from_date',
                'claimDateCurrentInformation:year_of_from_date',
                'claimDateCurrentInformation:qualifier',
            ],
        ],
    ],
    '14d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:qualifier',
        ],
        'values' => [
            'common' => [
                'claimDateCurrentInformation:month_of_from_date',
                'claimDateCurrentInformation:day_of_from_date',
                'claimDateCurrentInformation:year_of_from_date',
                'claimDateCurrentInformation:qualifier',
            ],
        ],
    ],
    '15a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:qualifier',
        ],
        'values' => [
            'common' => [
                'claimDateOtherInformation:qualifier',
                'claimDateOtherInformation:month_of_from_date',
                'claimDateOtherInformation:day_of_from_date',
                'claimDateOtherInformation:year_of_from_date',
            ],
        ],
    ],
    '15b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateOtherInformation:qualifier',
                'claimDateOtherInformation:month_of_from_date',
                'claimDateOtherInformation:day_of_from_date',
                'claimDateOtherInformation:year_of_from_date',
            ],
        ],
    ],
    '15c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateOtherInformation:qualifier',
                'claimDateOtherInformation:month_of_from_date',
                'claimDateOtherInformation:day_of_from_date',
                'claimDateOtherInformation:year_of_from_date',
            ],
        ],
    ],
    '15d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateOtherInformation:qualifier',
                'claimDateOtherInformation:month_of_from_date',
                'claimDateOtherInformation:day_of_from_date',
                'claimDateOtherInformation:year_of_from_date',
            ],
        ],
    ],
    '16a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateWorkInformation:month_of_from_date',
                'claimDateWorkInformation:day_of_from_date',
                'claimDateWorkInformation:year_of_from_date',
                'claimDateWorkInformation:month_of_to_date',
                'claimDateWorkInformation:day_of_to_date',
                'claimDateWorkInformation:year_of_to_date',
            ],
        ],
    ],
    '16b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateWorkInformation:month_of_from_date',
                'claimDateWorkInformation:day_of_from_date',
                'claimDateWorkInformation:year_of_from_date',
                'claimDateWorkInformation:month_of_to_date',
                'claimDateWorkInformation:day_of_to_date',
                'claimDateWorkInformation:year_of_to_date',
            ],
        ],
    ],
    '16c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateWorkInformation:month_of_from_date',
                'claimDateWorkInformation:day_of_from_date',
                'claimDateWorkInformation:year_of_from_date',
                'claimDateWorkInformation:month_of_to_date',
                'claimDateWorkInformation:day_of_to_date',
                'claimDateWorkInformation:year_of_to_date',
            ],
        ],
    ],
    '16d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:month_of_to_date',
        ],
        'values' => [
            'common' => [
                'claimDateWorkInformation:month_of_from_date',
                'claimDateWorkInformation:day_of_from_date',
                'claimDateWorkInformation:year_of_from_date',
                'claimDateWorkInformation:month_of_to_date',
                'claimDateWorkInformation:day_of_to_date',
                'claimDateWorkInformation:year_of_to_date',
            ],
        ],
    ],
    '16e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:day_of_to_date',
        ],
        'values' => [
            'common' => [
                'claimDateWorkInformation:month_of_from_date',
                'claimDateWorkInformation:day_of_from_date',
                'claimDateWorkInformation:year_of_from_date',
                'claimDateWorkInformation:month_of_to_date',
                'claimDateWorkInformation:day_of_to_date',
                'claimDateWorkInformation:year_of_to_date',
            ],
        ],
    ],
    '16f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:year_of_to_date',
        ],
        'values' => [
            'common' => [
                'claimDateWorkInformation:month_of_from_date',
                'claimDateWorkInformation:day_of_from_date',
                'claimDateWorkInformation:year_of_from_date',
                'claimDateWorkInformation:month_of_to_date',
                'claimDateWorkInformation:day_of_to_date',
                'claimDateWorkInformation:year_of_to_date',
            ],
        ],
    ],
    '170' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'referredProviderRole:code',
        ],
        'values' => [
            'common' => [
                'referredProviderRole:code',
                'providerProfile:first_name',
                'providerProfile:middle_name',
                'providerProfile:last_name',
                'providerProfile:name_suffix',
            ],
        ],
    ],
    '171' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'providerProfile:first_name',
            'providerProfile:middle_name',
            'providerProfile:last_name',
            'providerProfile:name_suffix',
        ],
        'values' => [
            'common' => [
                'referredProviderRole:code',
                'providerProfile:first_name',
                'providerProfile:middle_name',
                'providerProfile:last_name',
                'providerProfile:name_suffix',
            ],
        ],
    ],
    '17a0' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'providerProfile:qualifier',
        ],
        'values' => [
            'common' => [
                'providerProfile:qualifier',
                'providerProfile:qualifierValue',
                'providerProfile:npi',
            ],
        ],
    ],
    '17a1' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 17,
        'value' => [
            'providerProfile:qualifierValue',
        ],
        'values' => [
            'common' => [
                'providerProfile:qualifier',
                'providerProfile:qualifierValue',
                'providerProfile:npi',
            ],
        ],
    ],
    '17b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'value' => [
            'providerProfile:npi',
        ],
        'values' => [
            'common' => [
                'providerProfile:qualifier',
                'providerProfile:qualifierValue',
                'providerProfile:npi',
            ],
        ],
    ],
    '18a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateHospitalInformation:month_of_from_date',
                'claimDateHospitalInformation:day_of_from_date',
                'claimDateHospitalInformation:year_of_from_date',
                'claimDateHospitalInformation:month_of_to_date',
                'claimDateHospitalInformation:day_of_to_date',
                'claimDateHospitalInformation:year_of_to_date',
            ],
        ],
    ],
    '18b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateHospitalInformation:month_of_from_date',
                'claimDateHospitalInformation:day_of_from_date',
                'claimDateHospitalInformation:year_of_from_date',
                'claimDateHospitalInformation:month_of_to_date',
                'claimDateHospitalInformation:day_of_to_date',
                'claimDateHospitalInformation:year_of_to_date',
            ],
        ],
    ],
    '18c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                'claimDateHospitalInformation:month_of_from_date',
                'claimDateHospitalInformation:day_of_from_date',
                'claimDateHospitalInformation:year_of_from_date',
                'claimDateHospitalInformation:month_of_to_date',
                'claimDateHospitalInformation:day_of_to_date',
                'claimDateHospitalInformation:year_of_to_date',
            ],
        ],
    ],
    '18d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:month_of_to_date',
        ],
        'values' => [
            'common' => [
                'claimDateHospitalInformation:month_of_from_date',
                'claimDateHospitalInformation:day_of_from_date',
                'claimDateHospitalInformation:year_of_from_date',
                'claimDateHospitalInformation:month_of_to_date',
                'claimDateHospitalInformation:day_of_to_date',
                'claimDateHospitalInformation:year_of_to_date',
            ],
        ],
    ],
    '18e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:day_of_to_date',
        ],
        'values' => [
            'common' => [
                'claimDateHospitalInformation:month_of_from_date',
                'claimDateHospitalInformation:day_of_from_date',
                'claimDateHospitalInformation:year_of_from_date',
                'claimDateHospitalInformation:month_of_to_date',
                'claimDateHospitalInformation:day_of_to_date',
                'claimDateHospitalInformation:year_of_to_date',
            ],
        ],
    ],
    '18f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:year_of_to_date',
        ],
        'values' => [
            'common' => [
                'claimDateHospitalInformation:month_of_from_date',
                'claimDateHospitalInformation:day_of_from_date',
                'claimDateHospitalInformation:year_of_from_date',
                'claimDateHospitalInformation:month_of_to_date',
                'claimDateHospitalInformation:day_of_to_date',
                'claimDateHospitalInformation:year_of_to_date',
            ],
        ],
    ],
    '19' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'value' => [
            'claimDateAdditionalInformation:from_date',
            '| ',
            'claimDateAdditionalInformation:to_date',
            '| ',
            'claimDateAdditionalInformation:description',
        ],
        'values' => [
            'common' => [
                'claimDateAdditionalInformation:month_of_from_date',
                'claimDateAdditionalInformation:day_of_from_date',
                'claimDateAdditionalInformation:year_of_from_date',
                'claimDateAdditionalInformation:month_of_to_date',
                'claimDateAdditionalInformation:day_of_to_date',
                'claimDateAdditionalInformation:year_of_to_date',
                'claimDateAdditionalInformation:description',
            ],
        ],
    ],
    '20a' => [
        'type' => RuleType::BOOLEAN->value,
        'value' => 'claimDemographicInformation:outside_lab',
    ],
    '20b' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDemographicInformation:charges',
    ],
    '21' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'demograficInformation:|0',
    ],
    '21A' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:A',
    ],
    '21B' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:B',
    ],
    '21C' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:C',
    ],
    '21D' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:D',
    ],
    '21E' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:E',
    ],
    '21F' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:F',
    ],
    '21G' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:G',
    ],
    '21H' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:H',
    ],
    '21I' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:I',
    ],
    '21J' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:J',
    ],
    '21K' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:K',
    ],
    '21L' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosesCode:L',
    ],
    '22A' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'demograficInformation:|',
    ],
    '22B' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'demograficInformation:|',
    ],
    '23' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDemographicInformation:prior_authorization_number',
    ],
    '24' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimProfessionalServices:24',
    ],
    '25A' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'company:federal_tax',
    ],
    '25B' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'company:federal_tax_value',
    ],
    '26' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'patientCompany:med_num',
    ],
    '27' => [
        'type' => RuleType::BOOLEAN->value,
        'value' => 'claimDemographicInformation:accept_assignment',
    ],
    '28' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServicesTotalKey:price',
    ],
    '29' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServicesTotalKey:copay',
    ],
    '31A' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'billingProviderProfile:first_name',
            'billingProviderProfile:middle_name',
            'billingProviderProfile:last_name',
            'billingProviderProfile:name_suffix',
        ],
        'values' => [
            'common' => [
                'billingProviderProfile:first_name',
                'billingProviderProfile:middle_name',
                'billingProviderProfile:last_name',
                'billingProviderProfile:name_suffix',
            ],
        ],
    ],
    '31B' => [
        'type' => RuleType::SINGLE->value,
        'value' => '|Signature on File',
    ],
    '31C' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'firstClaimService:from_service',
    ],
    '32A0' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'facility:name',
        ],
        'values' => [
            'common' => [
                'facility:name',
                'facilityAddress:address',
                'facilityAddress:city',
                'facilityAddress:state',
                'facilityAddress:zip',
                'facility:npi',
            ],
        ],
    ],
    '32A1' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'facilityAddress:address|0',
        ],
        'values' => [
            'common' => [
                'facility:name',
                'facilityAddress:address',
                'facilityAddress:city',
                'facilityAddress:state',
                'facilityAddress:zip',
                'facility:npi',
            ],
        ],
    ],
    '32A2' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'facilityAddress:city|0',
            'facilityAddress:state|0',
            'facilityAddress:zip|0',
        ],
        'values' => [
            'common' => [
                'facility:name',
                'facilityAddress:address',
                'facilityAddress:city',
                'facilityAddress:state',
                'facilityAddress:zip',
                'facility:npi',
            ],
        ],
    ],
    '32A' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'facility:npi',
        ],
        'values' => [
            'common' => [
                'facility:name',
                'facilityAddress:address',
                'facilityAddress:city',
                'facilityAddress:state',
                'facilityAddress:zip',
                'facility:npi',
            ],
        ],
    ],
    '33A0' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'company:name',
        ],
        'values' => [
            'common' => [
                'company:name',
                'companyAddress:address',
                'companyAddress:city',
                'companyAddress:state',
                'companyAddress:zip',
                'companyContact:code_area',
                'companyContact:phone',
                'company:npi',
            ],
        ],
    ],
    '33A1' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'companyAddress:address|0',
        ],
        'values' => [
            'common' => [
                'company:name',
                'companyAddress:address',
                'companyAddress:city',
                'companyAddress:state',
                'companyAddress:zip',
                'companyContact:code_area',
                'companyContact:phone',
                'company:npi',
            ],
        ],
    ],
    '33A2' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'companyAddress:city|0',
            'companyAddress:state|0',
            'companyAddress:zip|0',
        ],
        'values' => [
            'common' => [
                'company:name',
                'companyAddress:address',
                'companyAddress:city',
                'companyAddress:state',
                'companyAddress:zip',
                'companyContact:code_area',
                'companyContact:phone',
                'company:npi',
            ],
        ],
    ],
    '33A3' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'companyContact:code_area|0',
        ],
        'values' => [
            'common' => [
                'company:name',
                'companyAddress:address',
                'companyAddress:city',
                'companyAddress:state',
                'companyAddress:zip',
                'companyContact:code_area',
                'companyContact:phone',
                'company:npi',
            ],
        ],
    ],
    '33A4' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'companyContact:phone|0',
        ],
        'values' => [
            'common' => [
                'company:name',
                'companyAddress:address',
                'companyAddress:city',
                'companyAddress:state',
                'companyAddress:zip',
                'companyContact:code_area',
                'companyContact:phone',
                'company:npi',
            ],
        ],
    ],
    '33A' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'value' => [
            'company:npi',
        ],
        'values' => [
            'common' => [
                'company:name',
                'companyAddress:address',
                'companyAddress:city',
                'companyAddress:state',
                'companyAddress:zip',
                'companyContact:code_area',
                'companyContact:phone',
                'company:npi',
            ],
        ],
    ],
];
