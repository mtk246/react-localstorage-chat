<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    '0.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Higher insurance company name',
        'value' => [
            [
                'id' => 'higherInsuranceCompany:name',
                'name' => 'Higher insurance company name',
            ],
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
    '0.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Higher insurance company address',
        'value' => [
            ['name' => 'Higher insurance company address', 'id' => 'higherInsuranceCompany:address'],
            ['name' => 'Higher insurance company apt suite', 'id' => 'higherInsuranceCompany:apt_suite'],
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
    '0.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Higher insurance company address',
        'value' => [
            ['name' => 'Higher insurance company city', 'id' => 'higherInsuranceCompany:city'],
            ['name' => 'Higher insurance company state', 'id' => 'higherInsuranceCompany:state'],
            ['name' => 'Higher insurance company zip', 'id' => 'higherInsuranceCompany:zip'],
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
    '1.0' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Type of insurance',
        'value' => ['name' => 'Type code of insurance', 'id' => 'insType:code'],
        'values' => [
            'common' => [
                ['name' => 'Type code of insurance', 'id' => 'insType:code'],
            ],
        ],
    ],
    '1.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Higher insurance policy number',
        'value' => ['name' => 'Higher insurance policy number', 'id' => 'higherOrderPolicy:policy_number'],
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
            ['name' => 'Patient last name', 'id' => 'patientProfile:last_name'],
            ['name' => 'Patient name suffix', 'id' => 'patientProfile:name_suffix'],
            ['name' => 'Patient first name', 'id' => 'patientProfile:first_name'],
            ['name' => 'Patient middle name', 'id' => 'patientProfile:middle_name'],
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
    '3.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient year of birth',
        'value' => [
            ['name' => 'Patient year of birth', 'id' => 'patientProfile:year_of_birth'],
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
    '3.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient month of birth',
        'value' => [
            ['name' => 'Patient month of birth', 'id' => 'patientProfile:month_of_birth'],
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
    '3.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient day of birth',
        'value' => [
            ['name' => 'Patient day of birth', 'id' => 'patientProfile:day_of_birth'],
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
    '3.d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 1,
        'description' => 'Patient sex',
        'value' => [
            ['name' => 'Patient sex', 'id' => 'patientProfile:sex'],
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
            ['name' => 'Subscriber last name', 'id' => 'subscriber:last_name'],
            ['name' => 'Subscriber name suffix', 'id' => 'subscriber:name_suffix'],
            ['name' => 'Subscriber first name', 'id' => 'subscriber:first_name'],
            ['name' => 'Subscriber middle name', 'id' => 'subscriber:middle_name'],
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
    '5.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Patient address',
        'value' => [
            ['name' => 'Patient address', 'id' => 'patientAddress:address'],
            ['name' => 'Patient apt suite', 'id' => 'patientAddress:apt_suite'],
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
    '5.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Patient city',
        'value' => [
            ['name' => 'Patient city', 'id' => 'patientAddress:city'],
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
    '5.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Patient state',
        'value' => [
            ['name' => 'Patient state', 'id' => 'patientAddress:state'],
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
    '5.d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'Patient zip',
        'value' => [
            ['name' => 'Patient zip', 'id' => 'patientAddress:zip'],
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
    '5.e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'description' => 'Patient phone code',
        'value' => [
            ['name' => 'Patient phone code', 'id' => 'patientContact:code'],
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
    '5.f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 11,
        'description' => 'Patient phone number',
        'value' => [
            ['name' => 'Patient phone number', 'id' => 'patientContact:number'],
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
        'value' => ['name' => 'Subscriber relationship with the patient', 'id' => 'subscriberRelationship:description'],
        'values' => [
            'common' => [
                ['name' => 'Subscriber relationship with the patient', 'id' => 'subscriberRelationship:description'],
            ],
        ],
    ],
    '7.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'glue' => ' ',
        'description' => 'Subscriber address',
        'value' => [
            ['name' => 'Subscriber address', 'id' => 'subscriberAddress:address'],
            ['name' => 'Subscriber apt suite', 'id' => 'subscriberAddress:apt_suite'],
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
    '7.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Subscriber city',
        'value' => [
            ['name' => 'Subscriber city', 'id' => 'subscriberAddress:city'],
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
    '7.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'subscriber state',
        'value' => [
            ['name' => 'Subscriber state', 'id' => 'subscriberAddress:state'],
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
    '7.d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'Subscriber zip',
        'value' => [
            ['name' => 'Subscriber zip', 'id' => 'subscriberAddress:zip'],
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
    '7.e' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'description' => 'Subscriber phone code',
        'value' => [
            ['name' => 'Subscriber phone code', 'id' => 'subscriberContact:code'],
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
    '7.f' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'subscriber phone number',
        'value' => [
            ['name' => 'Subscriber phone number', 'id' => 'subscriberContact:number'],
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
    '9.0' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Secondary policy subscriber',
        'value' => [
            ['name' => 'Subscriber last name', 'id' => 'lowerSubscriber:last_name'],
            ['name' => 'Subscriber name suffix', 'id' => 'lowerSubscriber:name_suffix'],
            ['name' => 'Subscriber first name', 'id' => 'lowerSubscriber:first_name'],
            ['name' => 'Subscriber middle name', 'id' => 'lowerSubscriber:middle_name'],
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
    '9.a' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Secondary policy number',
        'value' => ['name' => 'Secondary policy number', 'id' => 'lowerOrderPolicy:policy_number'],
        'values' => [
            'common' => [
                ['name' => 'Secondary policy number', 'id' => 'lowerOrderPolicy:policy_number'],
            ],
        ],
    ],
    '9.d' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Secondary insurance plan',
        'value' => ['name' => 'Secondary insurance plan', 'id' => 'lowerInsurancePlan:name'],
        'values' => [
            'common' => [
                ['name' => 'Secondary insurance plan', 'id' => 'lowerInsurancePlan:name'],
            ],
        ],
    ],
    '10.a' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Employment related condition',
        'value' => ['name' => 'Employment related condition', 'id' => 'claimDemographicInformation:employment_related_condition'],
        'values' => [
            'common' => [
                ['name' => 'Employment related condition', 'id' => 'claimDemographicInformation:employment_related_condition'],
            ],
        ],
    ],
    '10.b1' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Auto accident related condition',
        'value' => ['name' => 'Auto accident related condition', 'id' => 'claimDemographicInformation:auto_accident_related_condition'],
        'values' => [
            'common' => [
                ['name' => 'Auto accident related condition', 'id' => 'claimDemographicInformation:auto_accident_related_condition'],
            ],
        ],
    ],
    '10.b2' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Auto accident place state',
        'length' => 10,
        'value' => [
            ['name' => 'Auto accident place state', 'id' => 'claimDemographicInformation:auto_accident_place_state'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Auto accident related condition', 'id' => 'claimDemographicInformation:auto_accident_related_condition'],
                ['name' => 'Auto accident place state', 'id' => 'claimDemographicInformation:auto_accident_place_state'],
            ],
        ],
    ],
    '10.c' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Other accident related condition',
        'value' => ['name' => 'Other accident related condition', 'id' => 'claimDemographicInformation:other_accident_related_condition'],
        'values' => [
            'common' => [
                ['name' => 'Other accident related condition', 'id' => 'claimDemographicInformation:other_accident_related_condition'],
            ],
        ],
    ],
    '10.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [],
        'values' => [],
    ],
    '11' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Insurance policy group number',
        'value' => ['name' => 'Insurance policy group number', 'id' => 'higherOrderPolicy:group_number'],
        'values' => [
            'common' => [
                ['name' => 'Insurance policy group number', 'id' => 'higherOrderPolicy:group_number'],
            ],
        ],
    ],
    '11.a1' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Subscriber year of birth',
        'value' => [
            ['name' => 'Subscriber year of birth', 'id' => 'subscriber:year_of_birth'],
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
    '11.a2' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Subscriber month of birth',
        'value' => [
            ['name' => 'Subscriber month of birth', 'id' => 'subscriber:month_of_birth'],
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
    '11.a3' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 2,
        'description' => 'Subscriber day of birth',
        'value' => [
            ['name' => 'Subscriber day of birth', 'id' => 'subscriber:day_of_birth'],
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
    '11.a4' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 1,
        'description' => 'Subscriber sex',
        'value' => [
            ['name' => 'Subscriber sex', 'id' => 'subscriber:sex'],
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
    '11.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => null,
        'values' => [],
    ],
    '11.c' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Primary insurance plan name',
        'value' => ['name' => 'Primary insurance plan name', 'id' => 'higherInsurancePlan:name'],
        'values' => [
            'common' => [
                ['name' => 'Primary insurance plan name', 'id' => 'higherInsurancePlan:name'],
            ],
        ],
    ],
    '11.d' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Exist secondary insurance plan',
        'value' => ['name' => 'Exist secondary insurance plan', 'id' => 'existLowerInsurancePlan'],
        'values' => [
            'common' => [
                ['name' => 'Exist secondary insurance plan', 'id' => 'existLowerInsurancePlan'],
            ],
        ],
    ],
    '12.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 20,
        'description' => 'Patient signature on file',
        'value' => [
            ['name' => 'Patient signature on file', 'id' => 'patientSignature:patient_signature'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient signature on file', 'id' => 'patientSignature:patient_signature'],
                ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
            ],
        ],
    ],
    '12.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 10,
        'description' => 'Date of service',
        'value' => [
            ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
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
        'value' => ['name' => 'Insured signature on file', 'id' => 'patientSignature:insured_signature'],
        'values' => [
            'common' => [
                ['name' => 'Insured signature on file', 'id' => 'patientSignature:insured_signature'],
            ],
        ],
    ],
    '14.a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date current',
        'length' => 2,
        'value' => [
            ['name' => 'Claim month of from date', 'id' => 'claimDateCurrentInformation:month_of_from_date'],
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
    '14.b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date current',
        'length' => 2,
        'value' => [
            ['name' => 'Claim day of from date', 'id' => 'claimDateCurrentInformation:day_of_from_date'],
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
    '14.c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date current',
        'length' => 2,
        'value' => [
            ['name' => 'Claim year of from date', 'id' => 'claimDateCurrentInformation:year_of_from_date'],
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
    '14.d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim qualifier',
        'length' => 2,
        'value' => [
            ['name' => 'Claim qualifier', 'id' => 'claimDateCurrentInformation:qualifier'],
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
    '15.a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim qualifier',
        'length' => 2,
        'value' => [
            ['name' => 'Claim qualifier', 'id' => 'claimDateOtherInformation:qualifier'],
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
    '15.b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date other',
        'length' => 2,
        'value' => [
            ['name' => 'Claim month of from date', 'id' => 'claimDateOtherInformation:month_of_from_date'],
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
    '15.c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date other',
        'length' => 2,
        'value' => [
            ['name' => 'Claim day of from date', 'id' => 'claimDateOtherInformation:day_of_from_date'],
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
    '15.d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date other',
        'length' => 2,
        'value' => [
            ['name' => 'Claim year of from date', 'id' => 'claimDateOtherInformation:year_of_from_date'],
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
    '16.a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date work information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim month of from date', 'id' => 'claimDateWorkInformation:month_of_from_date'],
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
    '16.b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date work information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim day of from date', 'id' => 'claimDateWorkInformation:day_of_from_date'],
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
    '16.c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date work information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim year of from date', 'id' => 'claimDateWorkInformation:year_of_from_date'],
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
    '16.d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of to date work information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim month of to date', 'id' => 'claimDateWorkInformation:month_of_to_date'],
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
    '16.e' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of to date work information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim day of to date', 'id' => 'claimDateWorkInformation:day_of_to_date'],
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
    '16.f' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of to date work information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim year of to date', 'id' => 'claimDateWorkInformation:year_of_to_date'],
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
    '17.0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider role code',
        'length' => 2,
        'value' => [
            ['name' => 'Referred provider role', 'id' => 'referredProviderRole:code'],
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
    '17.1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider name',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            ['name' => 'Referred provider first name', 'id' => 'providerProfile:first_name'],
            ['name' => 'Referred provider middle name', 'id' => 'providerProfile:middle_name'],
            ['name' => 'Referred provider last name', 'id' => 'providerProfile:last_name'],
            ['name' => 'Referred provider name suffix', 'id' => 'providerProfile:name_suffix'],
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
    '17.a0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider qualifier',
        'length' => 2,
        'value' => [
            ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
                ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
                ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
            ],
        ],
    ],
    '17.a1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider qualifier value',
        'length' => 17,
        'value' => [
            ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
                ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
                ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
            ],
        ],
    ],
    '17.b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Referred provider npi',
        'length' => 10,
        'value' => [
            ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Referred provider qualifier', 'id' => 'providerProfile:qualifier'],
                ['name' => 'Referred provider qualifier value', 'id' => 'providerProfile:qualifierValue'],
                ['name' => 'Referred provider npi', 'id' => 'providerProfile:npi'],
            ],
        ],
    ],
    '18.a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of from date hospital information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim month of from date hospital', 'id' => 'claimDateHospitalInformation:month_of_from_date'],
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
    '18.b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of from date hospital information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim day of from date hospital', 'id' => 'claimDateHospitalInformation:day_of_from_date'],
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
    '18.c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of from date hospital information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim year of from date hospital', 'id' => 'claimDateHospitalInformation:year_of_from_date'],
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
    '18.d' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim month of to date hospital information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim month of to date hospital', 'id' => 'claimDateHospitalInformation:month_of_to_date'],
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
    '18.e' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim day of to date hospital information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim day of to date hospital', 'id' => 'claimDateHospitalInformation:day_of_to_date'],
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
    '18.f' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Claim year of to date hospital information',
        'length' => 2,
        'value' => [
            ['name' => 'Claim year of to date hospital', 'id' => 'claimDateHospitalInformation:year_of_to_date'],
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
            ['name' => 'Claim from date additional information', 'id' => 'claimDateAdditionalInformation:from_date'],
            ['name' => ' ', 'id' => '| |1'],
            ['name' => 'Claim to date additional information', 'id' => 'claimDateAdditionalInformation:to_date'],
            ['name' => ' ', 'id' => '| |2'],
            ['name' => 'Claim description additional information', 'id' => 'claimDateAdditionalInformation:description'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Claim from date additional information', 'id' => 'claimDateAdditionalInformation:from_date'],
                ['name' => 'Claim to date additional information', 'id' => 'claimDateAdditionalInformation:to_date'],
                ['name' => 'Claim description additional information', 'id' => 'claimDateAdditionalInformation:description'],
            ],
        ],
    ],
    '20.a' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Claim demographic outside lab',
        'value' => ['name' => 'Outside lab', 'id' => 'claimDemographicInformation:outside_lab'],
        'values' => [
            'common' => [
                ['name' => 'Outside lab', 'id' => 'claimDemographicInformation:outside_lab'],
            ],
        ],
    ],
    '20.b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim demographic information charges',
        'value' => ['name' => 'Charges', 'id' => 'claimDemographicInformation:charges'],
        'values' => [
            'common' => [
                ['name' => 'Charges', 'id' => 'claimDemographicInformation:charges'],
            ],
        ],
    ],
    '21.0' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis ICD indicator',
        'value' => ['name' => 'ICD indicator', 'id' => 'demograficInformation:|0'],
        'values' => [
            'common' => [
                ['name' => 'ICD indicator', 'id' => 'demograficInformation:|0'],
            ],
        ],
    ],
    '21.A' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code A',
        'value' => ['name' => 'Code A', 'id' => 'claimDiagnosesCode:A'],
        'values' => [
            'common' => [
                ['name' => 'Code A', 'id' => 'claimDiagnosesCode:A'],
            ],
        ],
    ],
    '21.B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code B',
        'value' => ['name' => 'Code B', 'id' => 'claimDiagnosesCode:B'],
        'values' => [
            'common' => [
                ['name' => 'Code B', 'id' => 'claimDiagnosesCode:B'],
            ],
        ],
    ],
    '21.C' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code C',
        'value' => ['name' => 'Code C', 'id' => 'claimDiagnosesCode:C'],
        'values' => [
            'common' => [
                ['name' => 'Code C', 'id' => 'claimDiagnosesCode:C'],
            ],
        ],
    ],
    '21.D' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code D',
        'value' => ['name' => 'Code D', 'id' => 'claimDiagnosesCode:D'],
        'values' => [
            'common' => [
                ['name' => 'Code D', 'id' => 'claimDiagnosesCode:D'],
            ],
        ],
    ],
    '21.E' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code E',
        'value' => ['name' => 'Code E', 'id' => 'claimDiagnosesCode:E'],
        'values' => [
            'common' => [
                ['name' => 'Code E', 'id' => 'claimDiagnosesCode:E'],
            ],
        ],
    ],
    '21.F' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code F',
        'value' => ['name' => 'Code F', 'id' => 'claimDiagnosesCode:F'],
        'values' => [
            'common' => [
                ['name' => 'Code F', 'id' => 'claimDiagnosesCode:F'],
            ],
        ],
    ],
    '21.G' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code G',
        'value' => ['name' => 'Code G', 'id' => 'claimDiagnosesCode:G'],
        'values' => [
            'common' => [
                ['name' => 'Code G', 'id' => 'claimDiagnosesCode:G'],
            ],
        ],
    ],
    '21.H' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code H',
        'value' => ['name' => 'Code H', 'id' => 'claimDiagnosesCode:H'],
        'values' => [
            'common' => [
                ['name' => 'Code H', 'id' => 'claimDiagnosesCode:H'],
            ],
        ],
    ],
    '21.I' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code I',
        'value' => ['name' => 'Code I', 'id' => 'claimDiagnosesCode:I'],
        'values' => [
            'common' => [
                ['name' => 'Code I', 'id' => 'claimDiagnosesCode:I'],
            ],
        ],
    ],
    '21.J' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code J',
        'value' => ['name' => 'Code J', 'id' => 'claimDiagnosesCode:J'],
        'values' => [
            'common' => [
                ['name' => 'Code J', 'id' => 'claimDiagnosesCode:J'],
            ],
        ],
    ],
    '21.K' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code K',
        'value' => ['name' => 'Code K', 'id' => 'claimDiagnosesCode:K'],
        'values' => [
            'common' => [
                ['name' => 'Code K', 'id' => 'claimDiagnosesCode:K'],
            ],
        ],
    ],
    '21.L' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim diagnosis code L',
        'value' => ['name' => 'Code L', 'id' => 'claimDiagnosesCode:L'],
        'values' => [
            'common' => [
                ['name' => 'Code L', 'id' => 'claimDiagnosesCode:L'],
            ],
        ],
    ],
    '22.A' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Resubmission claim code',
        'value' => ['name' => 'Resubmission claim code', 'id' => 'demograficInformation:|'],
        'values' => [
            'common' => [
                ['name' => 'Resubmission claim code', 'id' => 'demograficInformation:|'],
            ],
        ],
    ],
    '22.B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Resubmission claim original reference number',
        'value' => ['name' => 'Resubmission claim original reference number', 'id' => 'demograficInformation:|'],
        'values' => [
            'common' => [
                ['name' => 'Resubmission claim original reference number', 'id' => 'demograficInformation:|'],
            ],
        ],
    ],
    '23' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Prior authorization number',
        'value' => ['name' => 'Prior authorization number', 'id' => 'claimDemographicInformation:prior_authorization_number'],
        'values' => [
            'common' => [
                ['name' => 'Prior authorization number', 'id' => 'claimDemographicInformation:prior_authorization_number'],
            ],
        ],
    ],
    '24' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Claim professional services',
        'value' => ['name' => 'Claim professional services', 'id' => 'claimProfessionalServices:24'],
        'values' => [
            'common' => [
                ['name' => 'Claim professional services', 'id' => 'claimProfessionalServices:24'],
            ],
        ],
    ],
    '25.A' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Federal tax ID number',
        'value' => ['name' => 'Federal tax ID number', 'id' => 'company:federal_tax'],
        'values' => [
            'common' => [
                ['name' => 'Federal tax ID number', 'id' => 'company:federal_tax'],
            ],
        ],
    ],
    '25.B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Federal tax type',
        'value' => ['name' => 'Federal tax type', 'id' => 'company:federal_tax_value'],
        'values' => [
            'common' => [
                ['name' => 'Federal tax type', 'id' => 'company:federal_tax_value'],
            ],
        ],
    ],
    '26' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Patient account number',
        'value' => ['name' => 'Patient account number', 'id' => 'patientCompany:med_num'],
        'values' => [
            'common' => [
                ['name' => 'Patient account number', 'id' => 'patientCompany:med_num'],
            ],
        ],
    ],
    '27' => [
        'type' => RuleType::BOOLEAN->value,
        'description' => 'Accept assignment',
        'value' => ['name' => 'Accept assignment', 'id' => 'claimDemographicInformation:accept_assignment'],
        'values' => [
            'common' => [
                ['name' => 'Accept assignment', 'id' => 'claimDemographicInformation:accept_assignment'],
            ],
        ],
    ],
    '28' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Claim services total charge',
        'value' => ['name' => 'Claim services total charge', 'id' => 'claimServicesTotalKey:price'],
        'values' => [
            'common' => [
                ['name' => 'Claim services total charge', 'id' => 'claimServicesTotalKey:price'],
            ],
        ],
    ],
    '29' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Claim services amount paid',
        'value' => ['name' => 'Claim services amount paid', 'id' => 'claimServicesTotalKey:copay'],
        'values' => [
            'common' => [
                ['name' => 'Claim services amount paid', 'id' => 'claimServicesTotalKey:copay'],
            ],
        ],
    ],
    '31.A' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider name',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            ['name' => 'Billing provider first name', 'id' => 'billingProviderProfile:first_name'],
            ['name' => 'Billing provider middle name', 'id' => 'billingProviderProfile:middle_name'],
            ['name' => 'Billing provider last name', 'id' => 'billingProviderProfile:last_name'],
            ['name' => 'Billing provider name suffix', 'id' => 'billingProviderProfile:name_suffix'],
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
    '31.B' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Billing provider signature on file',
        'value' => ['name' => 'Billing provider signature on file', 'id' => '|Signature on File'],
        'values' => [
            'common' => [
                ['name' => 'Billing provider signature on file', 'id' => '|Signature on File'],
            ],
        ],
    ],
    '31.C' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Date of service',
        'value' => ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
        'values' => [
            'common' => [
                ['name' => 'Date of service', 'id' => 'firstClaimService:from_service'],
            ],
        ],
    ],
    '32.A0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility name',
        'length' => 20,
        'value' => [
            ['name' => 'Facility name', 'id' => 'facility:name'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address'],
                ['name' => 'Facility apt suite', 'id' => 'facilityAddress:apt_suite'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '32.A1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            ['name' => 'Facility address', 'id' => 'facilityAddress:address|0'],
            ['name' => 'Facility apt suite', 'id' => 'facilityAddress:apt_suite|0'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address|0'],
                ['name' => 'Facility apt suite', 'id' => 'facilityAddress:apt_suite|0'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city|0'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state|0'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip|0'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '32.A2' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            ['name' => 'Facility city', 'id' => 'facilityAddress:city|0'],
            ['name' => ' ', 'id' => '| |1'],
            ['name' => 'Facility state', 'id' => 'facilityAddress:state|0'],
            ['name' => 'Facility zip', 'id' => 'facilityAddress:zip|0'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address|0'],
                ['name' => 'Facility apt suite', 'id' => 'facilityAddress:apt_suite|0'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city|0'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state|0'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip|0'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '32.A' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Facility npi',
        'length' => 20,
        'value' => [
            ['name' => 'Facility npi', 'id' => 'facility:npi'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Facility name', 'id' => 'facility:name'],
                ['name' => 'Facility address', 'id' => 'facilityAddress:address|0'],
                ['name' => 'Facility apt suite', 'id' => 'facilityAddress:apt_suite|0'],
                ['name' => 'Facility city', 'id' => 'facilityAddress:city|0'],
                ['name' => 'Facility state', 'id' => 'facilityAddress:state|0'],
                ['name' => 'Facility zip', 'id' => 'facilityAddress:zip|0'],
                ['name' => 'Facility npi', 'id' => 'facility:npi'],
            ],
        ],
    ],
    '33.A0' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider name',
        'length' => 20,
        'value' => [
            ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
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
    '33.A1' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
            ['name' => 'Billing provider apt suite', 'id' => 'billingProvider:apt_suite'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider apt suite', 'id' => 'billingProvider:apt_suite'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33.A2' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider address',
        'length' => 20,
        'glue' => ' ',
        'value' => [
            ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
            ['name' => ', ', 'id' => '|, |1'],
            ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
            ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider apt suite', 'id' => 'billingProvider:apt_suite'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33.A3' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider phone code',
        'length' => 20,
        'value' => [
            ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider apt suite', 'id' => 'billingProvider:apt_suite'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33.A4' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider phone number',
        'length' => 20,
        'value' => [
            ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Billing provider name', 'id' => 'billingProvider:name'],
                ['name' => 'Billing provider address', 'id' => 'billingProvider:address'],
                ['name' => 'Billing provider apt suite', 'id' => 'billingProvider:apt_suite'],
                ['name' => 'Billing provider city', 'id' => 'billingProvider:city'],
                ['name' => 'Billing provider state', 'id' => 'billingProvider:state'],
                ['name' => 'Billing provider zip', 'id' => 'billingProvider:zip'],
                ['name' => 'Billing provider phone code', 'id' => 'billingProvider:code_area'],
                ['name' => 'Billing provider phone number', 'id' => 'billingProvider:phone'],
                ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
            ],
        ],
    ],
    '33.A' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Billing provider npi',
        'length' => 20,
        'value' => [
            ['name' => 'Billing provider npi', 'id' => 'billingProvider:npi'],
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
