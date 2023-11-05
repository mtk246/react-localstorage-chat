<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    '1a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Company Name',
        'value' => [
            'demographicInformation.company.name',
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
    '1b' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            'companyAddress:address|1',
            'companyAddress:apt_suite|1',
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
    '1c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'description' => 'Company Address',
        'value' => [
            'companyAddress:city|1',
            '|, ',
            'companyAddress:state_code|1',
            '| ',
            'companyAddress:zip|1',
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
    '1d' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            'companyAddress:other_country|1',
            'companyContact:phone_fax|0',
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
    '2a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Company Name',
        'value' => [
            'demographicInformation.company.name',
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
    '2b' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            'companyAddress:address|3',
            'companyAddress:apt_suite|3',
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
    '2c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'description' => 'Company Address',
        'value' => [
            'companyAddress:city|3',
            '|, ',
            'companyAddress:state_code|3',
            '| ',
            'companyAddress:zip|3',
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
    '2d' => [
        'type' => RuleType::MULTIPLE->value,
        'glue' => ' ',
        'description' => 'Company Address',
        'value' => [
            'companyAddress:other_country|3',
            'companyContact:phone_fax|3',
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
    '3a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'Patient name',
        'value' => [
            'demographicInformation.patient.code',
        ],
        'values' => [
            'common' => [
                ['name' => 'Patient code', 'id' => 'demographicInformation.patient.code'],
            ],
        ],
    ],
    '3b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'description' => 'medical number',
        'value' => [
            'patientCompany:med_num',
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
            '|0',
            'demographicInformation.bill_classification',
            'patientInformation.billClassification.code',
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
            'company:ein',
        ],
        'values' => [
            'common' => [
                ['name' => 'company npi', 'id' => 'company:npi'],
                ['name' => 'company ein', 'id' => 'company:ein'],
            ],
        ],
    ],
    '6a' => [
        'type' => RuleType::DATE->value,
        'description' => 'service from',
        'value' => 'service.from|mdY',
        'values' => [
            'common' => [
                ['name' => 'm/d/y', 'id' => 'service.from|m/d/y'],
                ['name' => 'm-d-y', 'id' => 'service.from|m-d-y'],
                ['name' => 'mdY', 'id' => 'service.from|mdY'],
            ],
        ],
    ],
    '6b' => [
        'type' => RuleType::DATE->value,
        'description' => 'service to',
        'value' => 'service.to|mdY',
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
    '8a' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Patient code',
        'value' => [
            'demographicInformation.patient.code',
        ],
        'values' => [
            'common' => [
                ['name' => 'patient code', 'id' => 'demographicInformation.patient.code'],
            ],
        ],
    ],
    '8b' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Patient name',
        'value' => [
            'patientProfile:last_name',
            'patientProfile:first_name',
            'patientProfile:middle_name',
        ],
        'values' => [
            'common' => [
                ['name' => 'patient last name', 'id' => 'patientProfile:last_name'],
                ['name' => 'patient first name', 'id' => 'patientProfile:first_name'],
                ['name' => 'patient middle name', 'id' => 'patientProfile:middle_name'],
            ],
        ],
    ],
    '9a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 28,
        'description' => 'Patient Address',
        'value' => [
            'patientAddress:address',
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
    '9b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'description' => 'Patient City',
        'value' => [
            'patientAddress:city',
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
    '9c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'description' => 'Patient State',
        'value' => [
            'patientAddress:state',
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
    '9d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 12,
        'description' => 'Patient Zip',
        'value' => [
            'patientAddress:zip',
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
    '9e' => [
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
        'value' => 'demographicInformation.patient.profile.date_of_birth|mdY',
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
        'value' => 'patientProfile:sex',
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
        'value' => 'patientInformation.admission_date|mdY',
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
        'value' => 'patientInformation.admission_time|H|H:m:s',
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
        'value' => 'patientInformation.admissionType.code',
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
        'value' => 'patientInformation.admissionSource.code',
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
        'value' => 'patientInformation.discharge_time|H|H:m:s',
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
        'value' => 'patientInformation.patientStatus.code',
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
        'value' => 'patientConditionCodes:0',
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
        'value' => 'patientConditionCodes:1',
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
        'value' => 'patientConditionCodes:2',
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
        'value' => 'patientConditionCodes:3',
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
        'value' => 'patientConditionCodes:4',
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
        'value' => 'patientConditionCodes:5',
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
        'value' => 'patientConditionCodes:6',
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
        'value' => 'patientConditionCodes:7',
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
        'value' => 'patientConditionCodes:8',
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
        'value' => 'patientConditionCodes:9',
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
        'value' => 'patientConditionCodes:10',
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
    '31a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36f' => [
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
    '38a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'name',
        'value' => 'HigherInsuranceCompany:name',
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
    '38b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Address 1',
        'value' => 'HigherInsuranceCompany:address',
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
    '38c' => [
        'type' => RuleType::MULTIPLE->value,
        'description' => 'Address 2',
        'value' => [
            'HigherInsuranceCompany:city',
            '|, ',
            'HigherInsuranceCompany:state',
            '| ',
            'HigherInsuranceCompany:zip',
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
    '39a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39g' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39h' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40g' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40h' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41a' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41b' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41c' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41d' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41e' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41f' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41g' => [
        'type' => RuleType::NONE->value,
        'description' => null,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41h' => [
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
        'value' => 'claimServices:revenue_code',
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
        'value' => 'claimServices:revenue_code_description',
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
        'value' => 'claimServices:procedure_code',
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
        'value' => 'claimServices:start_date',
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
        'value' => 'claimServices:days_or_units',
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
        'value' => 'claimServices:total_charge',
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
        'value' => 'claimServices:non_covered_charges',
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
    'ta' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|001',
        'values' => [
            'common' => [],
        ],
    ],
    'tb1' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|1',
        'values' => [
            'common' => [],
        ],
    ],
    'tb2' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|1',
        'values' => [
            'common' => [],
        ],
    ],
    'tc' => [
        'type' => RuleType::DATE->value,
        'description' => null,
        'value' => 'created_at|mdY',
        'values' => [
            'common' => [],
        ],
    ],
    'td' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => '|02222222',
        'values' => [
            'common' => [],
        ],
    ],
    'te' => [
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
        'value' => 'insuranceCompanies:name',
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
        'value' => 'InsurancePolicies:payer_id',
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
        'value' => 'insurancePolicies:release_info',
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
        'value' => 'insurancePolicies:assign_benefits',
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
        'value' => 'company:npi',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'company:npi'],
                ['name' => 'ein', 'id' => 'company:ein'],
            ],
        ],
    ],
    '57a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'company - ein',
        'value' => 'company:ein',
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
            'insurancePoliciesSubscriber:last_name',
            'insurancePoliciesSubscriber:first_name',
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
        'value' => 'insurancePoliciesSubscriber:relationship_code',
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
        'value' => 'insurancePolicies:policy_number',
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
        'value' => 'insurancePolicies:plan_name',
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
        'value' => 'insurancePolicies:group_number',
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
            'demographicInformation.prior_authorization_number',
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
        'value' => 'claimDiagnosisDx:type',
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
        'value' => 'claimDiagnosisDx:code_poa',
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
        'value' => 'ClaimDiagnosis:code_poa',
        'values' => [
            'common' => [
                ['name' => 'diagnosis code poa', 'id' => 'ClaimDiagnosis:code_poa'],
            ],
        ],
    ],
    '69' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'dx - conditional code',
        'value' => 'claimDiagnosisDx:cond_code',
        'values' => [
            'common' => [
                ['name' => 'dx type', 'id' => 'claimDiagnosisDx:type'],
                ['name' => 'dx code', 'id' => 'claimDiagnosisDx:code'],
                ['name' => 'dx code poa', 'id' => 'claimDiagnosisDx:code_poa'],
                ['name' => 'dx conditional code', 'id' => 'claimDiagnosisDx:cond_code'],
            ],
        ],
    ],
    '76a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => 'healthProfessional:npi|76',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '76b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => 'healthProfessional:qualifier|76',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '76c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => 'healthProfessional:first_name|76',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '76d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => 'healthProfessional:last_name|76',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|76'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|76'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|76'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|76'],
            ],
        ],
    ],
    '77a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => 'healthProfessional:npi|77',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '77b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => 'healthProfessional:qualifier|77',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '77c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => 'healthProfessional:first_name|77',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '77d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => 'healthProfessional:last_name|77',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|77'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|77'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|77'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|77'],
            ],
        ],
    ],
    '78a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => 'healthProfessional:npi|78',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '78b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => 'healthProfessional:qualifier|78',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '78c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => 'healthProfessional:first_name|78',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '78d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => 'healthProfessional:last_name|78',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|78'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|78'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|78'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|78'],
            ],
        ],
    ],
    '79a' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - npi',
        'value' => 'healthProfessional:npi|79',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
    '79b' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - qualifier',
        'value' => 'healthProfessional:qualifier|79',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
    '79c' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - first name',
        'value' => 'healthProfessional:first_name|79',
        'values' => [
            'common' => [
                ['name' => 'npi', 'id' => 'healthProfessional:npi|79'],
                ['name' => 'qualifier', 'id' => 'healthProfessional:qualifier|79'],
                ['name' => 'first name', 'id' => 'healthProfessional:first_name|79'],
                ['name' => 'last name', 'id' => 'healthProfessional:last_name|79'],
            ],
        ],
    ],
    '79d' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'health professional - last name',
        'value' => 'healthProfessional:last_name|79',
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
