<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    '1a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'demographicInformation.company.name',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyAddress:address|0',
                'companyAddress:city|0',
                'companyAddress:state|0',
                'companyAddress:zip|0',
            ],
        ],
    ],
    '1b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'companyAddress:address|0',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyAddress:address|0',
                'companyAddress:city|0',
                'companyAddress:state|0',
                'companyAddress:zip|0',
            ],
        ],
    ],
    '1c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'value' => [
            'companyAddress:city|0',
            '|, ',
            'companyAddress:state_code|0',
            '| ',
            'companyAddress:zip|0',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyAddress:address|0',
                'companyAddress:city|0',
                'companyAddress:state|0',
                'companyAddress:zip|0',
                'companyAddress:state_code|0',
            ],
        ],
    ],
    '1d' => [
        'type' => RuleType::MULTIPLE->value,
        'value' => [
            'companyAddress:other_country|0',
            'companyContact:phone_fax|0',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyContact:phone_fax|0',
                'companyAddress:address|0',
                'companyAddress:city|0',
                'companyAddress:state|0',
                'companyAddress:zip|0',
            ],
        ],
    ],
    '2a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'demographicInformation.company.name',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyAddress:address|3',
                'companyAddress:city|3',
                'companyAddress:state|3',
                'companyAddress:zip|3',
            ],
        ],
    ],
    '2b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'companyAddress:address|3',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyAddress:address|3',
                'companyAddress:city|3',
                'companyAddress:state|3',
                'companyAddress:zip|3',
            ],
        ],
    ],
    '2c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'value' => [
            'companyAddress:city|3',
            '|, ',
            'companyAddress:state_code|3',
            '| ',
            'companyAddress:zip|3',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyAddress:address|3',
                'companyAddress:city|3',
                'companyAddress:state|3',
                'companyAddress:zip|3',
            ],
        ],
    ],
    '2d' => [
        'type' => RuleType::MULTIPLE->value,
        'value' => [
            'companyAddress:other_country|3',
            'companyContact:phone_fax|3',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.name',
                'companyContact:phone_fax|3',
                'companyAddress:address|3',
                'companyAddress:city|3',
                'companyAddress:state|3',
                'companyAddress:zip|3',
            ],
        ],
    ],
    '3a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'demographicInformation.patient.code',
        ],
        'values' => [
            'common' => [
                'demographicInformation.patient.code',
            ],
        ],
    ],
    '3b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'patientCompany:med_num',
        ],
        'values' => [
            'common' => [
                'patientCompany:med_num',
            ],
        ],
    ],
    '4' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            '|0',
            'demographicInformation.bill_classification',
            'patientInformation.billClassification.code',
        ],
        'values' => [
            'common' => [
                '|0',
                'patientInformation.billClassification.code',
                'demographicInformation.bill_classification',
            ],
        ],
    ],
    '5' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 30,
        'value' => [
            'demographicInformation.company.npi',
        ],
        'values' => [
            'common' => [
                'demographicInformation.company.npi',
            ],
        ],
    ],
    '6a' => [
        'type' => RuleType::DATE->value,
        'value' => 'service.from|mdY',
        'values' => [
            'common' => [
                'service.from|m/d/y',
                'service.from|m-d-y',
                'service.from|mdY',
            ],
        ],
    ],
    '6b' => [
        'type' => RuleType::DATE->value,
        'value' => 'service.to|mdY',
        'values' => [
            'common' => [
                'service.to|m/d/y',
                'service.to|m-d-y',
                'service.to|mdY',
            ],
        ],
    ],
    '7' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '8a' => [
        'type' => RuleType::MULTIPLE->value,
        'value' => [
            'demographicInformation.patient.code',
        ],
        'values' => [
            'common' => [
                'demographicInformation.patient.code',
            ],
        ],
    ],
    '8b' => [
        'type' => RuleType::MULTIPLE->value,
        'value' => [
            'patientProfile:last_name',
            'patientProfile:first_name',
            'patientProfile:middle_name',
        ],
        'values' => [
            'common' => [
                'patientProfile:last_name',
                'patientProfile:first_name',
                'patientProfile:middle_name',
            ],
        ],
    ],
    '9a' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 28,
        'value' => [
            'patientAddress:address',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
            ],
        ],
    ],
    '9b' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 24,
        'value' => [
            'patientAddress:city',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
            ],
        ],
    ],
    '9c' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 3,
        'value' => [
            'patientAddress:state',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
            ],
        ],
    ],
    '9d' => [
        'type' => RuleType::MULTIPLE->value,
        'length' => 12,
        'value' => [
            'patientAddress:zip',
        ],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
            ],
        ],
    ],
    '9e' => [
        'type' => RuleType::NONE->value,
        'length' => 27,
        'value' => [],
        'values' => [
            'common' => [
                'patientAddress:address',
                'patientAddress:city',
                'patientAddress:state',
                'patientAddress:zip',
            ],
        ],
    ],
    '10' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'value' => 'demographicInformation.patient.profile.date_of_birth|mdY',
        'values' => [
            'common' => [
                'demographicInformation.patient.profile.date_of_birth|m/d/y',
                'demographicInformation.patient.profile.date_of_birth|m-d-y',
                'demographicInformation.patient.profile.date_of_birth|mdY',
            ],
        ],
    ],
    '11' => [
        'type' => RuleType::SINGLE->value,
        'length' => 27,
        'value' => 'patientProfile:sex',
        'values' => [
            'common' => [
                'patientProfile:sex',
            ],
        ],
    ],
    '12' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'value' => 'patientInformation.admission_date|mdY',
        'values' => [
            'common' => [
                'patientInformation.admission_date|mdY',
            ],
        ],
    ],
    '13' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'value' => 'patientInformation.admission_time|H|H:m:s',
        'values' => [
            'common' => [
                'patientInformation.admission_time|H|H:m:s',
            ],
        ],
    ],
    '14' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientInformation.admissionType.code',
        'values' => [
            'common' => [
                'patientInformation.admissionType.code',
            ],
        ],
    ],
    '15' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientInformation.admissionSource.code',
        'values' => [
            'common' => [
                'patientInformation.admissionSource.code',
            ],
        ],
    ],
    '16' => [
        'type' => RuleType::DATE->value,
        'length' => 30,
        'value' => 'patientInformation.discharge_time|H|H:m:s',
        'values' => [
            'common' => [
                'patientInformation.discharge_time|H|H:m:s',
            ],
        ],
    ],
    '17' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientInformation.patientStatus.code',
        'values' => [
            'common' => [
                'patientInformation.patientStatus.code',
            ],
        ],
    ],
    '18' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:0',
        'values' => [
            'common' => [
                'patientConditionCodes:0',
            ],
        ],
    ],
    '19' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:1',
        'values' => [
            'common' => [
                'patientConditionCodes:1',
            ],
        ],
    ],
    '20' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:2',
        'values' => [
            'common' => [
                'patientConditionCodes:2',
            ],
        ],
    ],
    '21' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:3',
        'values' => [
            'common' => [
                'patientConditionCodes:3',
            ],
        ],
    ],
    '22' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:4',
        'values' => [
            'common' => [
                'patientConditionCodes:4',
            ],
        ],
    ],
    '23' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:5',
        'values' => [
            'common' => [
                'patientConditionCodes:5',
            ],
        ],
    ],
    '24' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:6',
        'values' => [
            'common' => [
                'patientConditionCodes:6',
            ],
        ],
    ],
    '25' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:7',
        'values' => [
            'common' => [
                'patientConditionCodes:7',
            ],
        ],
    ],
    '26' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:8',
        'values' => [
            'common' => [
                'patientConditionCodes:8',
            ],
        ],
    ],
    '27' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:9',
        'values' => [
            'common' => [
                'patientConditionCodes:9',
            ],
        ],
    ],
    '28' => [
        'type' => RuleType::SINGLE->value,
        'length' => 30,
        'value' => 'patientConditionCodes:10',
        'values' => [
            'common' => [
                'patientConditionCodes:10',
            ],
        ],
    ],
    '29' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '30' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '31d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '32d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '33d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '34d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35e' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '35f' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36e' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '36f' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '37' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '38a' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'HigherInsuranceCompany:name',
        'values' => [
            'common' => [
                'HigherInsuranceCompany:name',
                'HigherInsuranceCompany:address',
                'HigherInsuranceCompany:city',
                'HigherInsuranceCompany:state',
                'HigherInsuranceCompany:zip',
            ],
        ],
    ],
    '38b' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'HigherInsuranceCompany:address',
        'values' => [
            'common' => [
                'HigherInsuranceCompany:name',
                'HigherInsuranceCompany:address',
                'HigherInsuranceCompany:city',
                'HigherInsuranceCompany:state',
                'HigherInsuranceCompany:zip',
            ],
        ],
    ],
    '38c' => [
        'type' => RuleType::MULTIPLE->value,
        'value' => [
            'HigherInsuranceCompany:city',
            '|, ',
            'HigherInsuranceCompany:state',
            '| ',
            'HigherInsuranceCompany:zip',
        ],
        'values' => [
            'common' => [
                'HigherInsuranceCompany:name',
                'HigherInsuranceCompany:address',
                'HigherInsuranceCompany:city',
                'HigherInsuranceCompany:state',
                'HigherInsuranceCompany:zip',
            ],
        ],
    ],
    '39a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39e' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39f' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39g' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '39h' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40e' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40f' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40g' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '40h' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41a' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41b' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41c' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41d' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41e' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41f' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41g' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '41h' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '42' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:revenue_code',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '43' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:procedure_description',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_description',
                'claimServices:procedure_short_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '44' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:procedure_code',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_code',
                'claimServices:procedure_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '45' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:procedure_start_date',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '46' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:days_or_units',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '47' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:total_charge',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '48' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claimServices:non_covered_charges',
        'values' => [
            'common' => [
                'claimServices:revenue_code',
                'claimServices:procedure_description',
                'claimServices:procedure_start_date',
                'claimServices:price',
                'claimServices:days_or_units',
            ],
        ],
    ],
    '49' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    'ta' => [
        'type' => RuleType::SINGLE->value,
        'value' => '|001',
        'values' => [
            'common' => [],
        ],
    ],
    'tb1' => [
        'type' => RuleType::SINGLE->value,
        'value' => '|1',
        'values' => [
            'common' => [],
        ],
    ],
    'tb2' => [
        'type' => RuleType::SINGLE->value,
        'value' => '|1',
        'values' => [
            'common' => [],
        ],
    ],
    'tc' => [
        'type' => RuleType::DATE->value,
        'value' => 'created_at|mdY',
        'values' => [
            'common' => [],
        ],
    ],
    'td' => [
        'type' => RuleType::SINGLE->value,
        'value' => '|02222222',
        'values' => [
            'common' => [],
        ],
    ],
    'te' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimServicesTotal',
        'values' => [
            'common' => [
                'claimServicesTotal',
            ],
        ],
    ],
    '50' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insuranceCompanies:name',
        'values' => [
            'common' => [
                'insuranceCompanies:name',
            ],
        ],
    ],
    '51' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'InsurancePolicies:payer_id',
        'values' => [
            'common' => [
                'insuranceCompanies:name',
                'insuranceCompanies:payer_id',
                'insurancePolicies:release_info',
                'insurancePolicies:assign_benefits',
            ],
        ],
    ],
    '52' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insurancePolicies:release_info',
        'values' => [
            'common' => [
                'insuranceCompanies:name',
                'insuranceCompanies:payer_id',
                'insurancePolicies:release_info',
                'insurancePolicies:assign_benefits',
            ],
        ],
    ],
    '53' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insurancePolicies:assign_benefits',
        'values' => [
            'common' => [
                'insuranceCompanies:name',
                'insuranceCompanies:payer_id',
                'insurancePolicies:release_info',
                'insurancePolicies:assign_benefits',
            ],
        ],
    ],
    '56' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'company:npi',
        'values' => [
            'common' => [
                'company:npi',
                'company:ein',
            ],
        ],
    ],
    '57a' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'company:ein',
        'values' => [
            'common' => [
                'company:npi',
                'company:ein',
            ],
        ],
    ],
    '58' => [
        'type' => RuleType::MULTIPLE_ARRAY->value,
        'glue' => ', ',
        'value' => [
            'insurancePoliciesSubscriber:last_name',
            'insurancePoliciesSubscriber:first_name',
        ],
        'values' => [
            'common' => [
                'insurancePoliciesSubscriber:last_name',
                'insurancePoliciesSubscriber:first_name',
                'insurancePoliciesSubscriber:relationship_code',
                'insurancePolicies:policy_number',
                'insurancePolicies:plan_name',
            ],
        ],
    ],
    '59' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insurancePoliciesSubscriber:relationship_code',
        'values' => [
            'common' => [
                'insurancePoliciesSubscriber:last_name',
                'insurancePoliciesSubscriber:first_name',
                'insurancePoliciesSubscriber:relationship_code',
                'insurancePolicies:policy_number',
                'insurancePolicies:plan_name',
            ],
        ],
    ],
    '60' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insurancePolicies:policy_number',
        'values' => [
            'common' => [
                'insurancePoliciesSubscriber:last_name',
                'insurancePoliciesSubscriber:first_name',
                'insurancePoliciesSubscriber:relationship_code',
                'insurancePolicies:policy_number',
                'insurancePolicies:plan_name',
            ],
        ],
    ],
    '61' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insurancePolicies:plan_name',
        'values' => [
            'common' => [
                'insurancePoliciesSubscriber:last_name',
                'insurancePoliciesSubscriber:first_name',
                'insurancePoliciesSubscriber:relationship_code',
                'insurancePolicies:policy_number',
                'insurancePolicies:plan_name',
            ],
        ],
    ],
    '62' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'insurancePolicies:group_number',
        'values' => [
            'common' => [
                'insurancePoliciesSubscriber:last_name',
                'insurancePoliciesSubscriber:first_name',
                'insurancePoliciesSubscriber:relationship_code',
                'insurancePolicies:policy_number',
                'insurancePolicies:plan_name',
                'insurancePolicies:group_number',
            ],
        ],
    ],
    '63' => [
        'type' => RuleType::MULTIPLE_ARRAY->value,
        'value' => [
            'demographicInformation.prior_authorization_number',
        ],
        'values' => [
            'common' => [
                'demographicInformation.prior_authorization_number',
            ],
        ],
    ],
    '64' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '65' => [
        'type' => RuleType::NONE->value,
        'value' => [
        ],
        'values' => [
            'common' => [],
        ],
    ],
    '66' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosisDx:type',
        'values' => [
            'common' => [
                'claimDiagnosisDx:type',
                'claimDiagnosisDx:code',
            ],
        ],
    ],
    '67' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosisDx:code_poa',
        'values' => [
            'common' => [
                'claimDiagnosisDx:type',
                'claimDiagnosisDx:code_poa',
            ],
        ],
    ],
    '67l' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'ClaimDiagnosis:code_poa',
        'values' => [
            'common' => [
                'ClaimDiagnosis:code_poa',
            ],
        ],
    ],
    '69' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claimDiagnosisDx:cond_code',
        'values' => [
            'common' => [
                'claimDiagnosisDx:type',
                'ClaimDiagnosis:code_poa',
                'claimDiagnosisDx:code',
                'claimDiagnosisDx:cond_code',
            ],
        ],
    ],
    '76a' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'healthProfessional:npi|76',
        'values' => [
            'common' => [
                'healthProfessional:npi|76',
                'healthProfessional:qualifier|76',
                'healthProfessional:first_name|76',
                'healthProfessional:last_name|76',
            ],
        ],
    ],
    '76b' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'healthProfessional:qualifier|76',
        'values' => [
            'common' => [
                'healthProfessional:npi|76',
                'healthProfessional:qualifier|76',
                'healthProfessional:first_name|76',
                'healthProfessional:last_name|76',
            ],
        ],
    ],
    '76c' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'healthProfessional:first_name|76',
        'values' => [
            'common' => [
                'healthProfessional:npi|76',
                'healthProfessional:qualifier|76',
                'healthProfessional:first_name|76',
                'healthProfessional:last_name|76',
            ],
        ],
    ],
    '76d' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'healthProfessional:last_name|76',
        'values' => [
            'common' => [
                'healthProfessional:npi|76',
                'healthProfessional:qualifier|76',
                'healthProfessional:first_name|76',
                'healthProfessional:last_name|76',
            ],
        ],
    ],
];
