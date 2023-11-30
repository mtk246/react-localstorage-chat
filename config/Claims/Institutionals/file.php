<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    '1.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Company Name',
        'value' => [
            ['name' => 'main company name', 'id' => 'demographicInformation.company.name'],
        ],
        'values' => [
            'common' => [
                ['name' => 'main company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'main company apt suite', 'id' => 'companyAddress:apt_suite|1'],
                ['name' => 'main company address', 'id' => 'companyAddress:address|1'],
                ['name' => 'main company city', 'id' => 'companyAddress:city|1'],
                ['name' => 'main company state', 'id' => 'companyAddress:state|1'],
                ['name' => 'main company zip', 'id' => 'companyAddress:zip|1'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|1'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|0'],
            ],
        ],
    ],
    '1.b' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            ['name' => 'main company address', 'id' => 'companyAddress:address|1'],
            ['name' => 'main company apt suite', 'id' => 'companyAddress:apt_suite|1'],
        ],
        'values' => [
            'common' => [
                ['name' => 'main company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'main company city', 'id' => 'companyAddress:city|1'],
                ['name' => 'main company state', 'id' => 'companyAddress:state|1'],
                ['name' => 'main company zip', 'id' => 'companyAddress:zip|1'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|1'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|0'],
            ],
        ],
    ],
    '1.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'description' => 'Company Address',
        'value' => [
            ['name' => 'main company city', 'id' => 'companyAddress:city|1'],
            ['name' => ', ', 'id' => '|, '],
            ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|1'],
            ['name' => ' ', 'id' => '| '],
            ['name' => 'main company zip', 'id' => 'companyAddress:zip|1'],
        ],
        'values' => [
            'common' => [
                ['name' => 'main company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'main company apt suite', 'id' => 'companyAddress:apt_suite|1'],
                ['name' => 'main company address', 'id' => 'companyAddress:address|1'],
                ['name' => 'main company city', 'id' => 'companyAddress:city|1'],
                ['name' => 'main company state', 'id' => 'companyAddress:state|1'],
                ['name' => 'main company zip', 'id' => 'companyAddress:zip|1'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|1'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|0'],
            ],
        ],
    ],
    '1.d' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            ['name' => 'Other Country name', 'id' => 'companyAddress:other_country|1'],
            ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|0'],
        ],
        'values' => [
            'common' => [
                ['name' => 'main company other Country name', 'id' => 'companyAddress:other_country|1'],
                ['name' => 'main company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'main company apt suite', 'id' => 'companyAddress:apt_suite|1'],
                ['name' => 'main company address', 'id' => 'companyAddress:address|1'],
                ['name' => 'main company city', 'id' => 'companyAddress:city|1'],
                ['name' => 'main company state', 'id' => 'companyAddress:state|1'],
                ['name' => 'main company zip', 'id' => 'companyAddress:zip|1'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|1'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|0'],
            ],
        ],
    ],
    '2.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Company Name',
        'value' => [
            ['name' => 'secondary company name', 'id' => 'demographicInformation.company.name'],
        ],
        'values' => [
            'common' => [
                ['name' => 'secondary company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'secondary company apt suite', 'id' => 'companyAddress:apt_suite|3'],
                ['name' => 'secondary company address', 'id' => 'companyAddress:address|3'],
                ['name' => 'secondary company city', 'id' => 'companyAddress:city|3'],
                ['name' => 'secondary company state', 'id' => 'companyAddress:state|3'],
                ['name' => 'secondary company zip', 'id' => 'companyAddress:zip|3'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|3'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|3'],
            ],
        ],
    ],
    '2.b' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            ['name' => 'secondary company address', 'id' => 'companyAddress:address|3'],
            ['name' => 'secondary company apt suite', 'id' => 'companyAddress:apt_suite|3'],
        ],
        'values' => [
            'common' => [
                ['name' => 'secondary company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'secondary company apt suite', 'id' => 'companyAddress:apt_suite|3'],
                ['name' => 'secondary company address', 'id' => 'companyAddress:address|3'],
                ['name' => 'secondary company city', 'id' => 'companyAddress:city|3'],
                ['name' => 'secondary company state', 'id' => 'companyAddress:state|3'],
                ['name' => 'secondary company zip', 'id' => 'companyAddress:zip|3'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|3'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|3'],
            ],
        ],
    ],
    '2.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'description' => 'Company Address',
        'value' => [
            ['name' => 'secondary company city', 'id' => 'companyAddress:city|3'],
            ['name' => ', ', 'id' => '|, '],
            ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|3'],
            ['name' => ' ', 'id' => '| '],
            ['name' => 'secondary company zip', 'id' => 'companyAddress:zip|3'],
        ],
        'values' => [
            'common' => [
                ['name' => 'secondary company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'secondary company apt suite', 'id' => 'companyAddress:apt_suite|3'],
                ['name' => 'secondary company address', 'id' => 'companyAddress:address|3'],
                ['name' => 'secondary company city', 'id' => 'companyAddress:city|3'],
                ['name' => 'secondary company state', 'id' => 'companyAddress:state|3'],
                ['name' => 'secondary company zip', 'id' => 'companyAddress:zip|3'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|3'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|3'],
            ],
        ],
    ],
    '2.d' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            ['name' => 'secondary company other Country name', 'id' => 'companyAddress:other_country|3'],
            ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|3'],
        ],
        'values' => [
            'common' => [
                ['name' => 'secondary company other Country name', 'id' => 'companyAddress:other_country|3'],
                ['name' => 'secondary company name', 'id' => 'demographicInformation.company.name'],
                ['name' => 'secondary company apt suite', 'id' => 'companyAddress:apt_suite|3'],
                ['name' => 'secondary company address', 'id' => 'companyAddress:address|3'],
                ['name' => 'secondary company city', 'id' => 'companyAddress:city|3'],
                ['name' => 'secondary company state', 'id' => 'companyAddress:state|3'],
                ['name' => 'secondary company zip', 'id' => 'companyAddress:zip|3'],
                ['name' => 'secondary company state code', 'id' => 'companyAddress:state_code|3'],
                ['name' => 'secondary company phone', 'id' => 'companyContact:phone_fax|3'],
            ],
        ],
    ],
    '3.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Patient name',
        'value' => [
            ['name' => 'Patient code', 'id' => 'demographicInformation.patient.code'],
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient code', 'id' => 'demographicInformation.patient.code'],
            ],
        ],
    ],
    '3.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'medical number',
        'value' => [
            ['name' => 'patient medical number', 'id' => 'patientCompany:med_num'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient medical number', 'id' => 'patientCompany:med_num'],
            ],
        ],
    ],
    '4' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Bill Classification',
        'value' => [
            ['name' => '0', 'id' => '|0'],
            ['name' => 'bill classification', 'id' => 'demographicInformation.bill_classification'],
            ['name' => 'bill classification code', 'id' => 'patientInformation.billClassification.code'],
        ],
        'values' => [
            'common' => [
                ['name' => 'bill classification code', 'id' => 'patientInformation.billClassification.code'],
                ['name' => 'bill classification', 'id' => 'demographicInformation.bill_classification'],
            ],
        ],
    ],
    '5' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'company ein',
        'value' => [
            ['name' => 'company ein', 'id' => 'company:ein'],
        ],
        'values' => [
            'common' => [
                ['name' => 'company npi', 'id' => 'company:npi'],
                ['name' => 'company ein', 'id' => 'company:ein'],
            ],
        ],
    ],
    '6.a' => [
        'type' => RuleType::DATE->value,
        'description' => 'service from',
        'value' => ['name' => 'mdY', 'id' => 'service.from|mdY'],
        'values' => [
            'common' => [
                ['name' => 'm/d/y', 'id' => 'service.from|m/d/y'],
                ['name' => 'm-d-y', 'id' => 'service.from|m-d-y'],
                ['name' => 'mdY', 'id' => 'service.from|mdY'],
            ],
        ],
    ],
    '6.b' => [
        'type' => RuleType::DATE->value,
        'description' => 'service to',
        'value' => ['name' => 'mdY', 'id' => 'service.to|mdY'],
        'values' => [
            'common' => [
                ['name' => 'm/d/y', 'id' => 'service.to|m/d/y'],
                ['name' => 'm-d-y', 'id' => 'service.to|m-d-y'],
                ['name' => 'mdY', 'id' => 'service.to|mdY'],
            ],
        ],
    ],
    '7' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
        ],
    ],
    '8.a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Patient code',
        'value' => [
            ['name' => 'patient code', 'id' => 'demographicInformation.patient.code'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient code', 'id' => 'demographicInformation.patient.code'],
            ],
        ],
    ],
    '8.b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Patient name',
        'value' => [
            ['name' => 'patient last name', 'id' => 'patientProfile:last_name'],
            ['name' => 'patient first name', 'id' => 'patientProfile:first_name'],
            ['name' => 'patient middle name', 'id' => 'patientProfile:middle_name'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient last name', 'id' => 'patientProfile:last_name'],
                ['name' => 'patient first name', 'id' => 'patientProfile:first_name'],
                ['name' => 'patient middle name', 'id' => 'patientProfile:middle_name'],
            ],
        ],
    ],
    '9.a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 28,
        'description' => 'Patient Address',
        'value' => [
            ['name' => 'patient address', 'id' => 'patientAddress:address'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient address', 'id' => 'patientAddress:address'],
                ['name' => 'patient city', 'id' => 'patientAddress:city'],
                ['name' => 'patient state', 'id' => 'patientAddress:state'],
                ['name' => 'patient zip', 'id' => 'patientAddress:zip'],
            ],
        ],
    ],
    '9.b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'description' => 'Patient City',
        'value' => [
            ['name' => 'patient city', 'id' => 'patientAddress:city'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient address', 'id' => 'patientAddress:address'],
                ['name' => 'patient city', 'id' => 'patientAddress:city'],
                ['name' => 'patient state', 'id' => 'patientAddress:state'],
                ['name' => 'patient zip', 'id' => 'patientAddress:zip'],
            ],
        ],
    ],
    '9.c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'description' => 'Patient State',
        'value' => [
            ['name' => 'patient state', 'id' => 'patientAddress:state'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient address', 'id' => 'patientAddress:address'],
                ['name' => 'patient city', 'id' => 'patientAddress:city'],
                ['name' => 'patient state', 'id' => 'patientAddress:state'],
                ['name' => 'patient zip', 'id' => 'patientAddress:zip'],
            ],
        ],
    ],
    '9.d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 12,
        'description' => 'Patient Zip',
        'value' => [
            ['name' => 'patient zip', 'id' => 'patientAddress:zip'],
        ],
        'values' => [
            'common' => [
                ['name' => 'patient address', 'id' => 'patientAddress:address'],
                ['name' => 'patient city', 'id' => 'patientAddress:city'],
                ['name' => 'patient state', 'id' => 'patientAddress:state'],
                ['name' => 'patient zip', 'id' => 'patientAddress:zip'],
            ],
        ],
    ],
    '9.e' => [
        'type' => RuleType::NONE->value,
        'length' => 27,
        'description' => 'Patient Address',
        'value' => [],
        'values' => [
            'common' => [
                ['name' => 'patient address', 'id' => 'patientAddress:address'],
                ['name' => 'patient city', 'id' => 'patientAddress:city'],
                ['name' => 'patient state', 'id' => 'patientAddress:state'],
                ['name' => 'patient zip', 'id' => 'patientAddress:zip'],
            ],
        ],
    ],
    '10' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'description' => 'patient date of birth',
        'value' => ['name' => 'mdY', 'id' => 'demographicInformation.patient.profile.date_of_birth|mdY'],
        'values' => [
            'common' => [
                ['name' => 'm/d/y', 'id' => 'demographicInformation.patient.profile.date_of_birth|m/d/y'],
                ['name' => 'm-d-y', 'id' => 'demographicInformation.patient.profile.date_of_birth|m-d-y'],
                ['name' => 'mdY', 'id' => 'demographicInformation.patient.profile.date_of_birth|mdY'],
            ],
        ],
    ],
    '11' => [
        'type' => RuleType::SINGLE->value,
        'length' => 27,
        'description' => 'Patient sex',
        'value' => ['name' => 'sex', 'id' => 'patientProfile:sex'],
        'values' => [
            'common' => [
                ['name' => 'sex', 'id' => 'patientProfile:sex'],
            ],
        ],
    ],
    '12' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'description' => 'Patient Admission Date',
        'value' => ['name' => 'mdY', 'id' => 'patientInformation.admission_date|mdY'],
        'values' => [
            'common' => [
                ['name' => 'm/d/y', 'id' => 'patientInformation.admission_date|m/d/y'],
                ['name' => 'm-d-y', 'id' => 'patientInformation.admission_date|m-d-y'],
                ['name' => 'mdY', 'id' => 'patientInformation.admission_date|mdY'],
            ],
        ],
    ],
    '13' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'description' => 'Patient Admission Time',
        'value' => ['name' => 'H:m:s', 'id' => 'patientInformation.admission_time|H|H:m:s'],
        'values' => [
            'common' => [
                ['name' => 's:m:H', 'id' => 'patientInformation.admission_time|H|s:m:H'],
                ['name' => 'h:m:s', 'id' => 'patientInformation.admission_time|H|h:m:s'],
                ['name' => 'H:m:s', 'id' => 'patientInformation.admission_time|H|H:m:s'],
            ],
        ],
    ],
    '14' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Admission Type',
        'value' => ['name' => 'code', 'id' => 'patientInformation.admissionType.code'],
        'values' => [
            'common' => [
                ['name' => 'code', 'id' => 'patientInformation.admissionType.code'],
            ],
        ],
    ],
    '15' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Admission Source',
        'value' => ['name' => 'code', 'id' => 'patientInformation.admissionSource.code'],
        'values' => [
            'common' => [
                ['name' => 'code', 'id' => 'patientInformation.admissionSource.code'],
            ],
        ],
    ],
    '16' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'description' => 'Patient Discharge Time',
        'value' => ['name' => 'H:m:s', 'id' => 'patientInformation.discharge_time|H|H:m:s'],
        'values' => [
            'common' => [
                ['name' => 's:m:H', 'id' => 'patientInformation.discharge_time|H|s:m:H'],
                ['name' => 'h:m:s', 'id' => 'patientInformation.discharge_time|H|h:m:s'],
                ['name' => 'H:m:s', 'id' => 'patientInformation.discharge_time|H|H:m:s'],
            ],
        ],
    ],
    '17' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Status',
        'value' => ['name' => 'status code', 'id' => 'patientInformation.patientStatus.code'],
        'values' => [
            'common' => [
                ['name' => 'status code', 'id' => 'patientInformation.patientStatus.code'],
            ],
        ],
    ],
    '18' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code a', 'id' => 'patientConditionCodes:0'],
        'values' => [
            'common' => [
                ['name' => 'condition code a', 'id' => 'patientConditionCodes:0'],
            ],
        ],
    ],
    '19' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 1', 'id' => 'patientConditionCodes:1'],
        'values' => [
            'common' => [
                ['name' => 'condition code 1', 'id' => 'patientConditionCodes:1'],
            ],
        ],
    ],
    '20' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 2', 'id' => 'patientConditionCodes:2'],
        'values' => [
            'common' => [
                ['name' => 'condition code 2', 'id' => 'patientConditionCodes:2'],
            ],
        ],
    ],
    '21' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 3', 'id' => 'patientConditionCodes:3'],
        'values' => [
            'common' => [
                ['name' => 'condition code 3', 'id' => 'patientConditionCodes:3'],
            ],
        ],
    ],
    '22' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 4', 'id' => 'patientConditionCodes:4'],
        'values' => [
            'common' => [
                ['name' => 'condition code 4', 'id' => 'patientConditionCodes:4'],
            ],
        ],
    ],
    '23' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 5', 'id' => 'patientConditionCodes:5'],
        'values' => [
            'common' => [
                ['name' => 'condition code 5', 'id' => 'patientConditionCodes:5'],
            ],
        ],
    ],
    '24' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 6', 'id' => 'patientConditionCodes:6'],
        'values' => [
            'common' => [
                ['name' => 'condition code 6', 'id' => 'patientConditionCodes:6'],
            ],
        ],
    ],
    '25' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 7', 'id' => 'patientConditionCodes:7'],
        'values' => [
            'common' => [
                ['name' => 'condition code 7', 'id' => 'patientConditionCodes:7'],
            ],
        ],
    ],
    '26' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 8', 'id' => 'patientConditionCodes:8'],
        'values' => [
            'common' => [
                ['name' => 'condition code 8', 'id' => 'patientConditionCodes:8'],
            ],
        ],
    ],
    '27' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 9', 'id' => 'patientConditionCodes:9'],
        'values' => [
            'common' => [
                ['name' => 'condition code 9', 'id' => 'patientConditionCodes:9'],
            ],
        ],
    ],
    '28' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'description' => 'Patient Condition Codes',
        'value' => ['name' => 'condition code 10', 'id' => 'patientConditionCodes:10'],
        'values' => [
            'common' => [
                ['name' => 'condition code 10', 'id' => 'patientConditionCodes:10'],
            ],
        ],
    ],
    '29' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '30' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35.e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35.f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36.e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36.f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '37' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '38.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'name',
        'value' => ['name' => 'name', 'id' => 'HigherInsuranceCompany:name'],
        'values' => [
            'common' => [
                ['name' => 'name', 'id' => 'HigherInsuranceCompany:name'],
                ['name' => 'address', 'id' => 'HigherInsuranceCompany:address'],
                ['name' => 'city', 'id' => 'HigherInsuranceCompany:city'],
                ['name' => 'state', 'id' => 'HigherInsuranceCompany:state'],
                ['name' => 'zip', 'id' => 'HigherInsuranceCompany:zip'],
            ],
        ],
    ],
    '38.b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Address 1',
        'value' => ['name' => 'address', 'id' => 'HigherInsuranceCompany:address'],
        'values' => [
            'common' => [
                ['name' => 'name', 'id' => 'HigherInsuranceCompany:name'],
                ['name' => 'address', 'id' => 'HigherInsuranceCompany:address'],
                ['name' => 'city', 'id' => 'HigherInsuranceCompany:city'],
                ['name' => 'state', 'id' => 'HigherInsuranceCompany:state'],
                ['name' => 'zip', 'id' => 'HigherInsuranceCompany:zip'],
            ],
        ],
    ],
    '38.c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Address 2',
        'value' => [
            ['name' => 'city', 'id' => 'HigherInsuranceCompany:city'],
            ['name' => ', ', 'id' => '|, '],
            ['name' => 'state', 'id' => 'HigherInsuranceCompany:state'],
            ['name' => ' ', 'id' => '| '],
            ['name' => 'zip', 'id' => 'HigherInsuranceCompany:zip'],
        ],
        'values' => [
            'common' => [
                ['name' => 'name', 'id' => 'HigherInsuranceCompany:name'],
                ['name' => 'address', 'id' => 'HigherInsuranceCompany:address'],
                ['name' => 'city', 'id' => 'HigherInsuranceCompany:city'],
                ['name' => 'state', 'id' => 'HigherInsuranceCompany:state'],
                ['name' => 'zip', 'id' => 'HigherInsuranceCompany:zip'],
            ],
        ],
    ],
    '39.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.g' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39.h' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.g' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40.h' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.g' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41.h' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '42' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - revenue code',
        'value' => ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '43' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - revenue code description',
        'value' => ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '44' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - procedure code',
        'value' => ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '45' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - start date',
        'value' => ['name' => 'start date', 'id' => 'claimServices:start_date'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '46' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - days or units',
        'value' => ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '47' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - total charge',
        'value' => ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '48' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim services - non covered charges',
        'value' => ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
        'values' => [
            'common' => [
                ['name' => 'revenue code', 'id' => 'claimServices:revenue_code'],
                ['name' => 'revenue code description', 'id' => 'claimServices:revenue_code_description'],
                ['name' => 'revenue code short description', 'id' => 'claimServices:revenue_code_short_description'],
                ['name' => 'procedure code', 'id' => 'claimServices:procedure_code'],
                ['name' => 'procedure description', 'id' => 'claimServices:procedure_description'],
                ['name' => 'procedure short description', 'id' => 'claimServices:procedure_short_description'],
                ['name' => 'start date', 'id' => 'claimServices:start_date'],
                ['name' => 'price', 'id' => 'claimServices:price'],
                ['name' => 'days or units', 'id' => 'claimServices:days_or_units'],
                ['name' => 'total charge', 'id' => 'claimServices:total_charge'],
                ['name' => 'non covered charges', 'id' => 'claimServices:non_covered_charges'],
            ],
        ],
    ],
    '49' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    't.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|001',
        'values' => [
            'common' => [],
        ],
    ],
    't.b.1' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|1',
        'values' => [
            'common' => [],
        ],
    ],
    't.b.2' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|1',
        'values' => [
            'common' => [],
        ],
    ],
    't.c' => [
        'type' => RuleType::DATE->value,
        'description' => null,
        'value' => 'created_at|mdY',
        'values' => [
            'common' => [],
        ],
    ],
    't.d' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|02222222',
        'values' => [
            'common' => [],
        ],
    ],
    't.e' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => 'claimServicesTotal',
        'values' => [
            'common' => [
                'claimServicesTotal',
            ],
        ],
    ],
    '50' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Insurance Company - Name',
        'value' => ['name' => 'name', 'id' => 'insuranceCompanies:name'],
        'values' => [
            'common' => [
                ['name' => 'name', 'id' => 'insuranceCompanies:name'],
                ['name' => 'payer id', 'id' => 'insuranceCompanies:payer_id'],
            ],
        ],
    ],
    '51' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Insurance Policies - Payer ID',
        'value' => ['name' => 'insurance policies payer_id', 'id' => 'InsurancePolicies:payer_id'],
        'values' => [
            'common' => [
                ['name' => 'insurance company name', 'id' => 'insuranceCompanies:name'],
                ['name' => 'insurance company payer id', 'id' => 'insuranceCompanies:payer_id'],
                ['name' => 'insurance policies payer_id', 'id' => 'InsurancePolicies:payer_id'],
                ['name' => 'insurance policies release info', 'id' => 'insurancePolicies:release_info'],
                ['name' => 'insurance policies assing benefits', 'id' => 'insurancePolicies:assign_benefits'],
            ],
        ],
    ],
    '52' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Insurance Policies - Release Info',
        'value' => ['name' => 'insurance policies release info', 'id' => 'insurancePolicies:release_info'],
        'values' => [
            'common' => [
                ['name' => 'insurance company name', 'id' => 'insuranceCompanies:name'],
                ['name' => 'insurance company payer id', 'id' => 'insuranceCompanies:payer_id'],
                ['name' => 'insurance policies payer_id', 'id' => 'InsurancePolicies:payer_id'],
                ['name' => 'insurance policies release info', 'id' => 'insurancePolicies:release_info'],
                ['name' => 'insurance policies assing benefits', 'id' => 'insurancePolicies:assign_benefits'],
            ],
        ],
    ],
    '53' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'Insurance Policies - Assign Benefits',
        'value' => ['name' => 'insurance policies assing benefits', 'id' => 'insurancePolicies:assign_benefits'],
        'values' => [
            'common' => [
                ['name' => 'insurance company name', 'id' => 'insuranceCompanies:name'],
                ['name' => 'insurance company payer id', 'id' => 'insuranceCompanies:payer_id'],
                ['name' => 'insurance policies payer_id', 'id' => 'InsurancePolicies:payer_id'],
                ['name' => 'insurance policies release info', 'id' => 'insurancePolicies:release_info'],
                ['name' => 'insurance policies assing benefits', 'id' => 'insurancePolicies:assign_benefits'],
            ],
        ],
    ],
    '56' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'company - npi',
        'value' => ['name' => 'npi', 'id' => 'company:npi'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'company:npi'],
                ['name' => 'ein', 'id' => 'company:ein'],
            ],
        ],
    ],
    '57.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'company - ein',
        'value' => ['name' => 'ein', 'id' => 'company:ein'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'company:npi'],
                ['name' => 'ein', 'id' => 'company:ein'],
            ],
        ],
    ],
    '58' => [
        'type' => RuleType::MULTIPLE_ARRAY->value,
        'glue' => ', ',
        'description' => 'insurance policy subscriber - name',
        'value' => [
            ['name' => 'subscriber last name', 'id' => 'insurancePoliciesSubscriber:last_name'],
            ['name' => 'subscriber first name', 'id' => 'insurancePoliciesSubscriber:first_name'],
        ],
        'values' => [
            'common' => [
                ['name' => 'subscriber last name', 'id' => 'insurancePoliciesSubscriber:last_name'],
                ['name' => 'subscriber first name', 'id' => 'insurancePoliciesSubscriber:first_name'],
                ['name' => 'subscriber relationship code', 'id' => 'insurancePoliciesSubscriber:relationship_code'],
                ['name' => 'policy number', 'id' => 'insurancePolicies:policy_number'],
                ['name' => 'plan name', 'id' => 'insurancePolicies:plan_name'],
                ['name' => 'group number', 'id' => 'insurancePolicies:group_number'],
            ],
        ],
    ],
    '59' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'insurance policy subscriber - relationship code',
        'value' => ['name' => 'subscriber relationship code', 'id' => 'insurancePoliciesSubscriber:relationship_code'],
        'values' => [
            'common' => [
                ['name' => 'subscriber last name', 'id' => 'insurancePoliciesSubscriber:last_name'],
                ['name' => 'subscriber first name', 'id' => 'insurancePoliciesSubscriber:first_name'],
                ['name' => 'subscriber relationship code', 'id' => 'insurancePoliciesSubscriber:relationship_code'],
                ['name' => 'policy number', 'id' => 'insurancePolicies:policy_number'],
                ['name' => 'plan name', 'id' => 'insurancePolicies:plan_name'],
                ['name' => 'group number', 'id' => 'insurancePolicies:group_number'],
            ],
        ],
    ],
    '60' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'insurance policy - policy number',
        'value' => ['name' => 'policy number', 'id' => 'insurancePolicies:policy_number'],
        'values' => [
            'common' => [
                ['name' => 'subscriber last name', 'id' => 'insurancePoliciesSubscriber:last_name'],
                ['name' => 'subscriber first name', 'id' => 'insurancePoliciesSubscriber:first_name'],
                ['name' => 'subscriber relationship code', 'id' => 'insurancePoliciesSubscriber:relationship_code'],
                ['name' => 'policy number', 'id' => 'insurancePolicies:policy_number'],
                ['name' => 'plan name', 'id' => 'insurancePolicies:plan_name'],
                ['name' => 'group number', 'id' => 'insurancePolicies:group_number'],
            ],
        ],
    ],
    '61' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'insurance policy - plan name',
        'value' => ['name' => 'plan name', 'id' => 'insurancePolicies:plan_name'],
        'values' => [
            'common' => [
                ['name' => 'subscriber last name', 'id' => 'insurancePoliciesSubscriber:last_name'],
                ['name' => 'subscriber first name', 'id' => 'insurancePoliciesSubscriber:first_name'],
                ['name' => 'subscriber relationship code', 'id' => 'insurancePoliciesSubscriber:relationship_code'],
                ['name' => 'policy number', 'id' => 'insurancePolicies:policy_number'],
                ['name' => 'plan name', 'id' => 'insurancePolicies:plan_name'],
                ['name' => 'group number', 'id' => 'insurancePolicies:group_number'],
            ],
        ],
    ],
    '62' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'insurance policy - group number',
        'value' => ['name' => 'group number', 'id' => 'insurancePolicies:group_number'],
        'values' => [
            'common' => [
                ['name' => 'subscriber last name', 'id' => 'insurancePoliciesSubscriber:last_name'],
                ['name' => 'subscriber first name', 'id' => 'insurancePoliciesSubscriber:first_name'],
                ['name' => 'subscriber relationship code', 'id' => 'insurancePoliciesSubscriber:relationship_code'],
                ['name' => 'policy number', 'id' => 'insurancePolicies:policy_number'],
                ['name' => 'plan name', 'id' => 'insurancePolicies:plan_name'],
                ['name' => 'group number', 'id' => 'insurancePolicies:group_number'],
            ],
        ],
    ],
    '63' => [
        'type' => RuleType::MULTIPLE_ARRAY->value,
        'description' => 'prior authorization number',
        'value' => [
            ['name' => 'subscriber last name', 'id' => 'demographicInformation.prior_authorization_number'],
        ],
        'values' => [
            'common' => [
                ['name' => 'subscriber last name', 'id' => 'demographicInformation.prior_authorization_number'],
            ],
        ],
    ],
    '64' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '65' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '66' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'dx - type',
        'value' => ['name' => 'dx type', 'id' => 'claimDiagnosisDx:type'],
        'values' => [
            'common' => [
                ['name' => 'dx type', 'id' => 'claimDiagnosisDx:type'],
                ['name' => 'dx code', 'id' => 'claimDiagnosisDx:code'],
                ['name' => 'dx code poa', 'id' => 'claimDiagnosisDx:code_poa'],
                ['name' => 'dx conditional code', 'id' => 'claimDiagnosisDx:cond_code'],
            ],
        ],
    ],
    '67' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'dx - code poa',
        'value' => ['name' => 'dx code poa', 'id' => 'claimDiagnosisDx:code_poa'],
        'values' => [
            'common' => [
                ['name' => 'dx type', 'id' => 'claimDiagnosisDx:type'],
                ['name' => 'dx code', 'id' => 'claimDiagnosisDx:code'],
                ['name' => 'dx code poa', 'id' => 'claimDiagnosisDx:code_poa'],
                ['name' => 'dx conditional code', 'id' => 'claimDiagnosisDx:cond_code'],
            ],
        ],
    ],
    '67l' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'diagnosis - code poa',
        'value' => ['name' => 'diagnosis code poa', 'id' => 'ClaimDiagnosis:code_poa'],
        'values' => [
            'common' => [
                ['name' => 'diagnosis code poa', 'id' => 'ClaimDiagnosis:code_poa'],
            ],
        ],
    ],
    '69' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'dx - conditional code',
        'value' => ['name' => 'dx conditional code', 'id' => 'claimDiagnosisDx:cond_code'],
        'values' => [
            'common' => [
                ['name' => 'dx type', 'id' => 'claimDiagnosisDx:type'],
                ['name' => 'dx code', 'id' => 'claimDiagnosisDx:code'],
                ['name' => 'dx code poa', 'id' => 'claimDiagnosisDx:code_poa'],
                ['name' => 'dx conditional code', 'id' => 'claimDiagnosisDx:cond_code'],
            ],
        ],
    ],
    '76.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '76.b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '76.c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '76.d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '77.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '77.b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '77.c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '77.d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '78.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '78.b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '78.c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '78.d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '79.a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
    '79.b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
    '79.c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
    '79.d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
];
