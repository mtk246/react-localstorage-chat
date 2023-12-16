<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    '0a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Higher insurance company name',
        'value' => [
            'higherInsuranceCompany:name',
        ],
        'values' => [
            'common' => [
                ['name' => 'Higher insurance company name', 'id' => 'higherInsuranceCompany:name'],
                ['name' => 'Higher insurance company address', 'id' => 'higherInsuranceCompany:address'],
                ['name' => 'Higher insurance company apt suite', 'id' => 'higherInsuranceCompany:apt_suite'],
                ['name' => 'Higher insurance company city', 'id' => 'higherInsuranceCompany:city'],
                ['name' => 'Higher insurance company state', 'id' => 'higherInsuranceCompany:state'],
                ['name' => 'Higher insurance company zip', 'id' => 'higherInsuranceCompany:zip'],
            ],
        ],
    ],
    '0b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Higher insurance company address',
        'value' => [
            'higherInsuranceCompany:address',
            'higherInsuranceCompany:apt_suite',
        ],
        'values' => [
            'common' => [
                ['name' => 'Higher insurance company name', 'id' => 'higherInsuranceCompany:name'],
                ['name' => 'Higher insurance company address', 'id' => 'higherInsuranceCompany:address'],
                ['name' => 'Higher insurance company apt suite', 'id' => 'higherInsuranceCompany:apt_suite'],
                ['name' => 'Higher insurance company city', 'id' => 'higherInsuranceCompany:city'],
                ['name' => 'Higher insurance company state', 'id' => 'higherInsuranceCompany:state'],
                ['name' => 'Higher insurance company zip', 'id' => 'higherInsuranceCompany:zip'],
            ],
        ],
    ],
    '0c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Higher insurance company address',
        'value' => [
            'higherInsuranceCompany:city',
            'higherInsuranceCompany:state',
            'higherInsuranceCompany:zip',
        ],
        'values' => [
            'common' => [
                ['name' => 'Higher insurance company name', 'id' => 'higherInsuranceCompany:name'],
                ['name' => 'Higher insurance company address', 'id' => 'higherInsuranceCompany:address'],
                ['name' => 'Higher insurance company apt suite', 'id' => 'higherInsuranceCompany:apt_suite'],
                ['name' => 'Higher insurance company city', 'id' => 'higherInsuranceCompany:city'],
                ['name' => 'Higher insurance company state', 'id' => 'higherInsuranceCompany:state'],
                ['name' => 'Higher insurance company zip', 'id' => 'higherInsuranceCompany:zip'],
            ],
        ],
    ],
    '1' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Type of insurance',
        'value' => 'insType:code',
        'values' => [
            'common' => [
                ['name' => 'Type code of insurance', 'id' => 'insType:code'],
            ],
        ],
    ],
    '1a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Higher insurance policy number',
        'value' => 'higherOrderPolicy:policy_number',
        'values' => [
            'common' => [
                ['name' => 'Higher insurance policy number', 'id' => 'higherOrderPolicy:policy_number'],
            ],
        ],
    ],
    '2' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Patient name',
        'value' => [
            'patientProfile:last_name',
            'patientProfile:name_suffix',
            'patientProfile:first_name',
            'patientProfile:middle_name',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient last name', 'id' => 'patientProfile:last_name'],
                ['name' => 'Patient name suffix', 'id' => 'patientProfile:name_suffix'],
                ['name' => 'Patient first name', 'id' => 'patientProfile:first_name'],
                ['name' => 'Patient middle name', 'id' => 'patientProfile:middle_name'],
            ],
        ],
    ],
    '3a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient year of birth',
        'value' => [
            'patientProfile:year_of_birth',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient year of birth', 'id' => 'patientProfile:year_of_birth'],
                ['name' => 'Patient month of birth', 'id' => 'patientProfile:month_of_birth'],
                ['name' => 'Patient day of birth', 'id' => 'patientProfile:day_of_birth'],
                ['name' => 'Patient sex', 'id' => 'patientProfile:sex'],
            ],
        ],
    ],
    '3b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient month of birth',
        'value' => [
            'patientProfile:month_of_birth',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient year of birth', 'id' => 'patientProfile:year_of_birth'],
                ['name' => 'Patient month of birth', 'id' => 'patientProfile:month_of_birth'],
                ['name' => 'Patient day of birth', 'id' => 'patientProfile:day_of_birth'],
                ['name' => 'Patient sex', 'id' => 'patientProfile:sex'],
            ],
        ],
    ],
    '3c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient day of birth',
        'value' => [
            'patientProfile:day_of_birth',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient year of birth', 'id' => 'patientProfile:year_of_birth'],
                ['name' => 'Patient month of birth', 'id' => 'patientProfile:month_of_birth'],
                ['name' => 'Patient day of birth', 'id' => 'patientProfile:day_of_birth'],
                ['name' => 'Patient sex', 'id' => 'patientProfile:sex'],
            ],
        ],
    ],
    '3d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 1,
        'description' => 'Patient sex',
        'value' => [
            'patientProfile:sex',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient year of birth', 'id' => 'patientProfile:year_of_birth'],
                ['name' => 'Patient month of birth', 'id' => 'patientProfile:month_of_birth'],
                ['name' => 'Patient day of birth', 'id' => 'patientProfile:day_of_birth'],
                ['name' => 'Patient sex', 'id' => 'patientProfile:sex'],
            ],
        ],
    ],
    '4' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Subscriber name',
        'value' => [
            'subscriber:last_name',
            'subscriber:name_suffix',
            'subscriber:first_name',
            'subscriber:middle_name',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber last name', 'id' => 'subscriber:last_name'],
                ['name' => 'Subscriber name suffix', 'id' => 'subscriber:name_suffix'],
                ['name' => 'Subscriber first name', 'id' => 'subscriber:first_name'],
                ['name' => 'Subscriber middle name', 'id' => 'subscriber:middle_name'],
            ],
        ],
    ],
    '5a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Patient address',
        'value' => [
            'patientAddress:address',
            'patientAddress:apt_suite',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient address', 'id' => 'patientAddress:address'],
                ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
                ['name' => 'Patient city', 'id' => 'patientAddress:city'],
                ['name' => 'Patient state', 'id' => 'patientAddress:state'],
                ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
                ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
                ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
            ],
        ],
    ],
    '5b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Patient city',
        'value' => [
            'patientAddress:city',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient address', 'id' => 'patientAddress:address'],
                ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
                ['name' => 'Patient city', 'id' => 'patientAddress:city'],
                ['name' => 'Patient state', 'id' => 'patientAddress:state'],
                ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
                ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
                ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
            ],
        ],
    ],
    '5c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient state',
        'value' => [
            'patientAddress:state',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient address', 'id' => 'patientAddress:address'],
                ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
                ['name' => 'Patient city', 'id' => 'patientAddress:city'],
                ['name' => 'Patient state', 'id' => 'patientAddress:state'],
                ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
                ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
                ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
            ],
        ],
    ],
    '5d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'Patient zip',
        'value' => [
            'patientAddress:zip',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient address', 'id' => 'patientAddress:address'],
                ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
                ['name' => 'Patient city', 'id' => 'patientAddress:city'],
                ['name' => 'Patient state', 'id' => 'patientAddress:state'],
                ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
                ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
                ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
            ],
        ],
    ],
    '5e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'description' => 'Patient phone code',
        'value' => [
            'patientContact:code',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient address', 'id' => 'patientAddress:address'],
                ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
                ['name' => 'Patient city', 'id' => 'patientAddress:city'],
                ['name' => 'Patient state', 'id' => 'patientAddress:state'],
                ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
                ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
                ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
            ],
        ],
    ],
    '5f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 11,
        'description' => 'Patient phone number',
        'value' => [
            'patientContact:number',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient address', 'id' => 'patientAddress:address'],
                ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
                ['name' => 'Patient city', 'id' => 'patientAddress:city'],
                ['name' => 'Patient state', 'id' => 'patientAddress:state'],
                ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
                ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
                ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
            ],
        ],
    ],
    '6' => [
        'type' => RuleType::SINGLE->value,
        'length' => 6,
        'description' => 'Subscriber relationship with the patient',
        'value' => 'subscriberRelationship:description',
        'values' => [
            'common' => [
                ['name' => 'Subscriber relationship with the patient', 'id' => 'subscriberRelationship:description'],
            ],
        ],
    ],
    '7a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Subscriber address',
        'value' => [
            'subscriberAddress:address',
            'subscriberAddress:apt_suite',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
                ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
                ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
                ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
                ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
                ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
                ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
            ],
        ],
    ],
    '7b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Subscriber city',
        'value' => [
            'subscriberAddress:city',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
                ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
                ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
                ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
                ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
                ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
                ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
            ],
        ],
    ],
    '7c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'subscriber state',
        'value' => [
            'subscriberAddress:state',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
                ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
                ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
                ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
                ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
                ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
                ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
            ],
        ],
    ],
    '7d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'Subscriber zip',
        'value' => [
            'subscriberAddress:zip',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
                ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
                ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
                ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
                ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
                ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
                ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
            ],
        ],
    ],
    '7e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'description' => 'Subscriber phone code',
        'value' => [
            'subscriberContact:code',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
                ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
                ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
                ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
                ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
                ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
                ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
            ],
        ],
    ],
    '7f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'subscriber phone number',
        'value' => [
            'subscriberContact:number',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
                ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
                ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
                ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
                ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
                ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
                ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
            ],
        ],
    ],
    '9' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Secondary policy subscriber',
        'value' => [
            'lowerSubscriber:last_name',
            'lowerSubscriber:name_suffix',
            'lowerSubscriber:first_name',
            'lowerSubscriber:middle_name',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber last name', 'id' => 'lowerSubscriber:last_name'],
                ['name' => 'Subscriber name suffix', 'id' => 'lowerSubscriber:name_suffix'],
                ['name' => 'Subscriber first name', 'id' => 'lowerSubscriber:first_name'],
                ['name' => 'Subscriber middle name', 'id' => 'lowerSubscriber:middle_name'],
            ],
        ],
    ],
    '9a' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Secondary policy number',
        'value' => 'lowerOrderPolicy:policy_number',
        'values' => [
            'common' => [
                ['name' => 'Secondary policy number', 'id' => 'lowerOrderPolicy:policy_number'],
            ],
        ],
    ],
    '9d' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Secondary insurance plan',
        'value' => 'lowerInsurancePlan:name',
        'values' => [
            'common' => [
                ['name' => 'Secondary insurance plan', 'id' => 'lowerInsurancePlan:name'],
            ],
        ],
    ],
    '10a' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Employment related condition',
        'value' => 'claimDemographicInformation:employment_related_condition',
        'values' => [
            'common' => [
                ['name' => 'Employment related condition', 'id' => 'claimDemographicInformation:employment_related_condition'],
            ],
        ],
    ],
    '10ba' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Auto accident related condition',
        'value' => 'claimDemographicInformation:auto_accident_related_condition',
        'values' => [
            'common' => [
                ['name' => 'Auto accident related condition', 'id' => 'claimDemographicInformation:auto_accident_related_condition'],
            ],
        ],
    ],
    '10bb' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Auto accident place state',
        'length' => 10,
        'value' => [
            'claimDemographicInformation:auto_accident_place_state',
        ],
        'values' => [
            'common' => [
                ['name' => 'Auto accident related condition', 'id' => 'claimDemographicInformation:auto_accident_related_condition'],
                ['name' => 'Auto accident place state', 'id' => 'claimDemographicInformation:auto_accident_place_state'],
            ],
        ],
    ],
    '10c' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Other accident related condition',
        'value' => 'claimDemographicInformation:other_accident_related_condition',
        'values' => [
            'common' => [
                ['name' => 'Other accident related condition', 'id' => 'claimDemographicInformation:other_accident_related_condition'],
            ],
        ],
    ],
    '10d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [],
        'values' => [],
    ],
    '11' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Insurance policy group number',
        'value' => 'higherOrderPolicy:group_number',
        'values' => [
            'common' => [
                ['name' => 'Insurance policy group number', 'id' => 'higherOrderPolicy:group_number'],
            ],
        ],
    ],
    '11aa' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Subscriber year of birth',
        'value' => [
            'subscriber:year_of_birth',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber year of birth', 'id' => 'subscriber:year_of_birth'],
                ['name' => 'Subscriber month of birth', 'id' => 'subscriber:month_of_birth'],
                ['name' => 'Subscriber day of birth', 'id' => 'subscriber:day_of_birth'],
                ['name' => 'Subscriber sex', 'id' => 'subscriber:sex'],
            ],
        ],
    ],
    '11ab' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Subscriber month of birth',
        'value' => [
            'subscriber:month_of_birth',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber year of birth', 'id' => 'subscriber:year_of_birth'],
                ['name' => 'Subscriber month of birth', 'id' => 'subscriber:month_of_birth'],
                ['name' => 'Subscriber day of birth', 'id' => 'subscriber:day_of_birth'],
                ['name' => 'Subscriber sex', 'id' => 'subscriber:sex'],
            ],
        ],
    ],
    '11ac' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Subscriber day of birth',
        'value' => [
            'subscriber:day_of_birth',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber year of birth', 'id' => 'subscriber:year_of_birth'],
                ['name' => 'Subscriber month of birth', 'id' => 'subscriber:month_of_birth'],
                ['name' => 'Subscriber day of birth', 'id' => 'subscriber:day_of_birth'],
                ['name' => 'Subscriber sex', 'id' => 'subscriber:sex'],
            ],
        ],
    ],
    '11ad' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 1,
        'description' => 'Subscriber sex',
        'value' => [
            'subscriber:sex',
        ],
        'values' => [
            'common' => [
                ['name' => 'Subscriber year of birth', 'id' => 'subscriber:year_of_birth'],
                ['name' => 'Subscriber month of birth', 'id' => 'subscriber:month_of_birth'],
                ['name' => 'Subscriber day of birth', 'id' => 'subscriber:day_of_birth'],
                ['name' => 'Subscriber sex', 'id' => 'subscriber:sex'],
            ],
        ],
    ],
    '11b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => '| ',
        'values' => [],
    ],
    '11c' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Primary insurance plan name',
        'value' => 'higherInsurancePlan:name',
        'values' => [
            'common' => [
                ['name' => 'Primary insurance plan name', 'id' => 'higherInsurancePlan:name'],
            ],
        ],
    ],
    '11d' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Exist secondary insurance plan',
        'value' => 'existLowerInsurancePlan',
        'values' => [
            'common' => [
                ['name' => 'Exist secondary insurance plan', 'id' => 'existLowerInsurancePlan'],
            ],
        ],
    ],
    '12a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'description' => 'Patient signature on file',
        'value' => [
            'patientSignature:patient_signature',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient signature on file', 'id' => 'patientSignature:patient_signature'],
                ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
            ],
        ],
    ],
    '12b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'Date of service',
        'value' => [
            'firstClaimService:from_service',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient signature on file', 'id' => 'patientSignature:patient_signature'],
                ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
            ],
        ],
    ],
    '13' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Insured signature on file',
        'value' => 'patientSignature:insured_signature',
        'values' => [
            'common' => [
                ['name' => 'Insured signature on file', 'id' => 'patientSignature:insured_signature'],
            ],
        ],
    ],
    '14a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date current',
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateCurrentInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateCurrentInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateCurrentInformation:year_of_from_date'],
                ['name' => 'Claim qualifier', 'id' => 'claimDateCurrentInformation:qualifier'],
            ],
        ],
    ],
    '14b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date current',
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateCurrentInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateCurrentInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateCurrentInformation:year_of_from_date'],
                ['name' => 'Claim qualifier', 'id' => 'claimDateCurrentInformation:qualifier'],
            ],
        ],
    ],
    '14c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date current',
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateCurrentInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateCurrentInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateCurrentInformation:year_of_from_date'],
                ['name' => 'Claim qualifier', 'id' => 'claimDateCurrentInformation:qualifier'],
            ],
        ],
    ],
    '14d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim qualifier',
        'length' => 2,
        'value' => [
            'value' => 'claimDateCurrentInformation:qualifier',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateCurrentInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateCurrentInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateCurrentInformation:year_of_from_date'],
                ['name' => 'Claim qualifier', 'id' => 'claimDateCurrentInformation:qualifier'],
            ],
        ],
    ],
    '15a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim qualifier',
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:qualifier',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim qualifier', 'id' => 'claimDateOtherInformation:qualifier'],
                ['name' => 'Claim month of from date', 'id' => 'claimDateOtherInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateOtherInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateOtherInformation:year_of_from_date'],
            ],
        ],
    ],
    '15b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date other',
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim qualifier', 'id' => 'claimDateOtherInformation:qualifier'],
                ['name' => 'Claim month of from date', 'id' => 'claimDateOtherInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateOtherInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateOtherInformation:year_of_from_date'],
            ],
        ],
    ],
    '15c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date other',
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim qualifier', 'id' => 'claimDateOtherInformation:qualifier'],
                ['name' => 'Claim month of from date', 'id' => 'claimDateOtherInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateOtherInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateOtherInformation:year_of_from_date'],
            ],
        ],
    ],
    '15d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date other',
        'length' => 2,
        'value' => [
            'value' => 'claimDateOtherInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim qualifier', 'id' => 'claimDateOtherInformation:qualifier'],
                ['name' => 'Claim month of from date', 'id' => 'claimDateOtherInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateOtherInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateOtherInformation:year_of_from_date'],
            ],
        ],
    ],
    '16a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date work information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
                ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
                ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
                ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
            ],
        ],
    ],
    '16b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date work information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
                ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
                ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
                ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
            ],
        ],
    ],
    '16c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date work information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
                ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
                ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
                ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
            ],
        ],
    ],
    '16d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of to date work information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:month_of_to_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
                ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
                ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
                ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
            ],
        ],
    ],
    '16e' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of to date work information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:day_of_to_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
                ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
                ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
                ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
            ],
        ],
    ],
    '16f' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of to date work information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateWorkInformation:year_of_to_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
                ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
                ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
                ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
                ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
                ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
            ],
        ],
    ],
    '170' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider role code',
        'length' => 2,
        'value' => [
            'referredProviderRole:code',
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider role', 'id' => 'referredProviderRole:code'],
                ['name' => 'Referred provider first name', 'id' => 'providerProfile:first_name'],
                ['name' => 'Referred provider middle name', 'id' => 'providerProfile:middle_name'],
                ['name' => 'Referred provider last name', 'id' => 'providerProfile:last_name'],
                ['name' => 'Referred provider name suffix', 'id' => 'providerProfile:name_suffix'],
            ],
        ],
    ],
    '171' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider name',
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
                ['name' => 'Referred provider role', 'id' => 'referredProviderRole:code'],
                ['name' => 'Referred provider first name', 'id' => 'providerProfile:first_name'],
                ['name' => 'Referred provider middle name', 'id' => 'providerProfile:middle_name'],
                ['name' => 'Referred provider last name', 'id' => 'providerProfile:last_name'],
                ['name' => 'Referred provider name suffix', 'id' => 'providerProfile:name_suffix'],
            ],
        ],
    ],
    '17a0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider qualifier',
        'length' => 2,
        'value' => [
            'providerProfile:qualifier',
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
                ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
                ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
            ],
        ],
    ],
    '17a1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider qualifier value',
        'length' => 17,
        'value' => [
            'providerProfile:qualifierValue',
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
                ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
                ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
            ],
        ],
    ],
    '17b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider npi',
        'length' => 10,
        'value' => [
            'providerProfile:npi',
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
                ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
                ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
            ],
        ],
    ],
    '18a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date hospital information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:month_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
                ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
                ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
                ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
                ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
                ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
            ],
        ],
    ],
    '18b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date hospital information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:day_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
                ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
                ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
                ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
                ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
                ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
            ],
        ],
    ],
    '18c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date hospital information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:year_of_from_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
                ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
                ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
                ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
                ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
                ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
            ],
        ],
    ],
    '18d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of to date hospital information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:month_of_to_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
                ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
                ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
                ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
                ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
                ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
            ],
        ],
    ],
    '18e' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of to date hospital information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:day_of_to_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
                ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
                ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
                ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
                ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
                ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
            ],
        ],
    ],
    '18f' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of to date hospital information',
        'length' => 2,
        'value' => [
            'value' => 'claimDateHospitalInformation:year_of_to_date',
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
                ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
                ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
                ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
                ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
                ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
            ],
        ],
    ],
    '19' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim date additional information',
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
                ['name' => 'Claim from date additional information', 'id' => 'claimDateAdditionalInformation:from_date'],
                ['name' => 'Claim to date additional information', 'id' => 'claimDateAdditionalInformation:to_date'],
                ['name' => 'Claim description additional information', 'id' => 'claimDateAdditionalInformation:description'],
            ],
        ],
    ],
    '20a' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Claim demographic outside lab',
        'value' => 'claimDemographicInformation:outside_lab',
        'values' => [
            'common' => [
                ['name' => 'Outside lab', 'id' => 'claimDemographicInformation:outside_lab'],
            ],
        ],
    ],
    '20b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim demographic information charges',
        'value' => 'claimDemographicInformation:charges',
        'values' => [
            'common' => [
                ['name' => 'Charges', 'id' => 'claimDemographicInformation:charges'],
            ],
        ],
    ],
    '21' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis ICD indicator',
        'value' => 'demograficInformation:|0',
        'values' => [
            'common' => [
                ['name' => 'ICD indicator', 'id' => 'demograficInformation:|0'],
            ],
        ],
    ],
    '21A' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code A',
        'value' => 'claimDiagnosesCode:A',
        'values' => [
            'common' => [
                ['name' => 'Code A', 'id' => 'claimDiagnosesCode:A'],
            ],
        ],
    ],
    '21B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code B',
        'value' => 'claimDiagnosesCode:B',
        'values' => [
            'common' => [
                ['name' => 'Code B', 'id' => 'claimDiagnosesCode:B'],
            ],
        ],
    ],
    '21C' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code C',
        'value' => 'claimDiagnosesCode:C',
        'values' => [
            'common' => [
                ['name' => 'Code C', 'id' => 'claimDiagnosesCode:C'],
            ],
        ],
    ],
    '21D' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code D',
        'value' => 'claimDiagnosesCode:D',
        'values' => [
            'common' => [
                ['name' => 'Code D', 'id' => 'claimDiagnosesCode:D'],
            ],
        ],
    ],
    '21E' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code E',
        'value' => 'claimDiagnosesCode:E',
        'values' => [
            'common' => [
                ['name' => 'Code E', 'id' => 'claimDiagnosesCode:E'],
            ],
        ],
    ],
    '21F' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code F',
        'value' => 'claimDiagnosesCode:F',
        'values' => [
            'common' => [
                ['name' => 'Code F', 'id' => 'claimDiagnosesCode:F'],
            ],
        ],
    ],
    '21G' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code G',
        'value' => 'claimDiagnosesCode:G',
        'values' => [
            'common' => [
                ['name' => 'Code G', 'id' => 'claimDiagnosesCode:G'],
            ],
        ],
    ],
    '21H' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code H',
        'value' => 'claimDiagnosesCode:H',
        'values' => [
            'common' => [
                ['name' => 'Code H', 'id' => 'claimDiagnosesCode:H'],
            ],
        ],
    ],
    '21I' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code I',
        'value' => 'claimDiagnosesCode:I',
        'values' => [
            'common' => [
                ['name' => 'Code I', 'id' => 'claimDiagnosesCode:I'],
            ],
        ],
    ],
    '21J' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code J',
        'value' => 'claimDiagnosesCode:J',
        'values' => [
            'common' => [
                ['name' => 'Code J', 'id' => 'claimDiagnosesCode:J'],
            ],
        ],
    ],
    '21K' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code K',
        'value' => 'claimDiagnosesCode:K',
        'values' => [
            'common' => [
                ['name' => 'Code K', 'id' => 'claimDiagnosesCode:K'],
            ],
        ],
    ],
    '21L' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code L',
        'value' => 'claimDiagnosesCode:L',
        'values' => [
            'common' => [
                ['name' => 'Code L', 'id' => 'claimDiagnosesCode:L'],
            ],
        ],
    ],
    '22A' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Resubmission claim code',
        'value' => 'demograficInformation:|',
        'values' => [
            'common' => [
                ['name' => 'Resubmission claim code', 'id' => 'demograficInformation:|'],
            ],
        ],
    ],
    '22B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Resubmission claim original reference number',
        'value' => 'demograficInformation:|',
        'values' => [
            'common' => [
                ['name' => 'Resubmission claim original reference number', 'id' => 'demograficInformation:|'],
            ],
        ],
    ],
    '23' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Prior authorization number',
        'value' => 'claimDemographicInformation:prior_authorization_number',
        'values' => [
            'common' => [
                ['name' => 'Prior authorization number', 'id' => 'claimDemographicInformation:prior_authorization_number'],
            ],
        ],
    ],
    '24' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Claim professional services',
        'value' => 'claimProfessionalServices:24',
        'values' => [
            'common' => [
                ['name' => 'Claim professional services', 'id' => 'claimProfessionalServices:24'],
            ],
        ],
    ],
    '25A' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Federal tax ID number',
        'value' => 'company:federal_tax',
        'values' => [
            'common' => [
                ['name' => 'Federal tax ID number', 'id' => 'company:federal_tax'],
            ],
        ],
    ],
    '25B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Federal tax type',
        'value' => 'company:federal_tax_value',
        'values' => [
            'common' => [
                ['name' => 'Federal tax type', 'id' => 'company:federal_tax_value'],
            ],
        ],
    ],
    '26' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Patient account number',
        'value' => 'patientCompany:med_num',
        'values' => [
            'common' => [
                ['name' => 'Patient account number', 'id' => 'patientCompany:med_num'],
            ],
        ],
    ],
    '27' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Accept assignment',
        'value' => 'claimDemographicInformation:accept_assignment',
        'values' => [
            'common' => [
                ['name' => 'Accept assignment', 'id' => 'claimDemographicInformation:accept_assignment'],
            ],
        ],
    ],
    '28' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Claim services total charge',
        'value' => 'claimServicesTotalKey:price',
        'values' => [
            'common' => [
                ['name' => 'Claim services total charge', 'id' => 'claimServicesTotalKey:price'],
            ],
        ],
    ],
    '29' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Claim services amount paid',
        'value' => 'claimServicesTotalKey:copay',
        'values' => [
            'common' => [
                ['name' => 'Claim services amount paid', 'id' => 'claimServicesTotalKey:copay'],
            ],
        ],
    ],
    '31A' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider name',
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
                ['name' => 'Billing provider first name', 'id' => 'billingProviderProfile:first_name'],
                ['name' => 'Billing provider middle name', 'id' => 'billingProviderProfile:middle_name'],
                ['name' => 'Billing provider last name', 'id' => 'billingProviderProfile:last_name'],
                ['name' => 'Billing provider name suffix', 'id' => 'billingProviderProfile:name_suffix'],
            ],
        ],
    ],
    '31B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Billing provider signature on file',
        'value' => '|Signature on File',
        'values' => [
            'common' => [
                ['name' => 'Billing provider signature on file', 'id' => '|Signature on File'],
            ],
        ],
    ],
    '31C' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Date of service',
        'value' => 'firstClaimService:from_service',
        'values' => [
            'common' => [
                ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
            ],
        ],
    ],
    '32A0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility name',
        'length' => 20,
        'value' => [
            'facility:name',
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '32A1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'facilityAddress:address|0',
            'facilityAddress:apt_suite|0',
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '32A2' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'facilityAddress:city|0',
            '|, ',
            'facilityAddress:state|0',
            'facilityAddress:zip|0',
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '32A' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility npi',
        'length' => 20,
        'value' => [
            'facility:npi',
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '33A0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider name',
        'length' => 20,
        'value' => [
            'billingProvider:name',
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33A1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'billingProvider:address|0',
            'billingProvider:apt_suite|0',
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33A2' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            'billingProvider:city|0',
            '|, ',
            'billingProvider:state|0',
            'billingProvider:zip|0',
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33A3' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider phone code',
        'length' => 20,
        'value' => [
            'billingProvider:code_area|0',
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33A4' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider phone number',
        'length' => 20,
        'value' => [
            'billingProvider:phone|0',
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33A' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider npi',
        'length' => 20,
        'value' => [
            'billingProvider:npi',
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
];
