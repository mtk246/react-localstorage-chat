<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => 'claim:controlNumber',
    ],
    'tradingPartnerServiceId' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => 'claim:tradingPartnerServiceId',
    ],
    'tradingPartnerName' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => 'claim:tradingPartnerName',
    ],
    'usageIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => null,
        'value' => 'claim:usageIndicator',
    ],
    'submitter.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Organization name',
        'value' => ['id' => 'claim:submitter.organizationName', 'name' => 'Submitter organization name'],
        'values' => [
            [
                'id' => 'claim:submitter.organizationName',
                'name' => 'Submitter organization name',
            ],
        ],
    ],
    'submitter.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter last name',
        'value' => [],
        'values' => [],
    ],
    'submitter.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter first name',
        'value' => [],
        'values' => [],
    ],
    'submitter.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter middle name',
        'value' => [],
        'values' => [],
    ],
    'submitter.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Submitter contact information name',
        'value' => ['id' => 'claim:submitter.contactInformation.name', 'name' => 'Submitter contact information name'],
        'values' => [
            [
                'id' => 'claim:submitter.contactInformation.name',
                'name' => 'Submitter contact information name',
            ],
        ],
    ],
    'submitter.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Submitter contact information phone number',
        'value' => ['id' => 'claim:submitter.contactInformation.phoneNumber', 'name' => 'Submitter contact information phone number'],
        'values' => [
            [
                'id' => 'claim:submitter.contactInformation.phoneNumber',
                'name' => 'Submitter contact information phone number',
            ],
        ],
    ],
    'submitter.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Submitter contact information fax number',
        'value' => ['id' => 'claim:submitter.contactInformation.faxNumber', 'name' => 'Submitter contact information fax number'],
        'values' => [
            [
                'id' => 'claim:submitter.contactInformation.faxNumber',
                'name' => 'Submitter contact information fax number',
            ],
        ],
    ],
    'submitter.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Submitter contact information email',
        'value' => ['id' => 'claim:submitter.contactInformation.email', 'name' => 'Submitter contact information email'],
        'values' => [
            [
                'id' => 'claim:submitter.contactInformation.email',
                'name' => 'Submitter contact information email',
            ],
        ],
    ],
    'submitter.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'submitter' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:submitter',
    ],
    /**'receiver' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:receiver',
    ],
    'subscriber' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:subscriber',
    ],
    'dependent' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:dependent',
    ],
    'claimInformation' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:claimInformation',
    ],
    'payToAddress' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:payToAddress',
    ],**/
    /*'payToPlan' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:payToPlan',
    ],
    'payerAddress' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:payerAddress',
    ],*/
    /*'billing' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:billing',
    ],
    'referring' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:referring',
    ],**/
    /*'rendering' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:rendering',
    ],
    'ordering' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:ordering',
    ],
    'supervising' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:supervising',
    ],*/
];
