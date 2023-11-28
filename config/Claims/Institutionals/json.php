<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'control number',
        'value' => ['name' => 'claim control number', 'id' => 'claim:controlNumber'],
        'values' => [
            'common' => [
                ['name' => 'claim control number', 'id' => 'claim:controlNumber'],
            ],
        ],
    ],
    'tradingPartnerServiceId' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'trading partner service id',
        'value' => ['name' => 'claim trading partner service id', 'id' => 'claim:tradingPartnerServiceId'],
        'values' => [
            'common' => [
                ['name' => 'claim trading partner service id', 'id' => 'claim:tradingPartnerServiceId'],
            ],
        ],
    ],
    'tradingPartnerName' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'trading partner name',
        'value' => ['name' => 'claim trading partner name', 'id' => 'claim:tradingPartnerName'],
        'values' => [
            'common' => [
                ['name' => 'claim trading partner name', 'id' => 'claim:tradingPartnerName'],
            ],
        ],
    ],
    'usageIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'usage indicator',
        'value' => ['name' => 'claim usage indicator', 'id' => 'claim:usageIndicator'],
        'values' => [
            'common' => [
                ['name' => 'claim usage indicator', 'id' => 'claim:usageIndicator'],
            ],
        ],
    ],
    'submitter' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'submitter',
        'value' => ['name' => 'claim submitter', 'id' => 'claim:submitter'],
        'values' => [
            'common' => [
                ['name' => 'claim submitter', 'id' => 'claim:submitter'],
            ],
        ],
    ],
    'receiver' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'receiver',
        'value' => ['name' => 'claim receiver', 'id' => 'claim:receiver'],
        'values' => [
            'common' => [
                ['name' => 'claim receiver', 'id' => 'claim:receiver'],
            ],
        ],
    ],
    'subscriber' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'subscriber',
        'value' => ['name' => 'claim subscriber', 'id' => 'claim:subscriber'],
        'values' => [
            'common' => [
                ['name' => 'claim subscriber', 'id' => 'claim:subscriber'],
            ],
        ],
    ],
    'dependent' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'dependent',
        'value' => ['name' => 'claim dependent', 'id' => 'claim:dependent'],
        'values' => [
            'common' => [
                ['name' => 'claim dependent', 'id' => 'claim:dependent'],
            ],
        ],
    ],
    /*'providers' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:providers',
    ],
    'billingPayToPlanName' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:billingPayToPlanName',
    ],
    'billingPayToAddressName' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:billingPayToAddressName',
    ],
    'operatingPhysician' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:operatingPhysician',
    ],
    'otherOperatingPhysician' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:otherOperatingPhysician',
    ],*/
    'claimInformation' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'claim information',
        'value' => ['name' => 'claim information', 'id' => 'claim:claimInformation'],
        'values' => [
            'common' => [
                ['name' => 'claim information', 'id' => 'claim:claimInformation'],
            ],
        ],
    ],
    'payToAddress' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
            ],
        ],
    ],
    'billing' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'billing',
        'value' => ['name' => 'claim billing', 'id' => 'claim:billing'],
        'values' => [
            'common' => [
                ['name' => 'claim billing', 'id' => 'claim:billing'],
            ],
        ],
    ],
    'referring' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'referring',
        'value' => ['name' => 'claim referring', 'id' => 'claim:referring'],
        'values' => [
            'common' => [
                ['name' => 'claim referring', 'id' => 'claim:referring'],
            ],
        ],
    ],
    /*'rendering' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:rendering',
    ],*/
    'attending' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'attending',
        'value' => ['name' => 'claim attending', 'id' => 'claim:attending'],
        'values' => [
            'common' => [
                ['name' => 'claim attending', 'id' => 'claim:attending'],
            ],
        ],
    ],
];
