<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'control number',
        'value' => 'claim:controlNumber',
    ],
    'tradingPartnerServiceId' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'trading partner service id',
        'value' => 'claim:tradingPartnerServiceId',
    ],
    'tradingPartnerName' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'trading partner name',
        'value' => 'claim:tradingPartnerName',
    ],
    'usageIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'usage indicator',
        'value' => 'claim:usageIndicator',
    ],
    'submitter' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'submitter',
        'value' => 'claim:submitter',
    ],
    'receiver' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'receiver',
        'value' => 'claim:receiver',
    ],
    'subscriber' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'subscriber',
        'value' => 'claim:subscriber',
    ],
    'dependent' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'dependent',
        'value' => 'claim:dependent',
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
        'value' => 'claim:claimInformation',
    ],
    'payToAddress' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'pay to address',
        'value' => 'claim:payToAddress',
    ],
    'billing' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'billing',
        'value' => 'claim:billing',
    ],
    'referring' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'referring',
        'value' => 'claim:referring',
    ],
    /*'rendering' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:rendering',
    ],*/
    'attending' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'attending',
        'value' => 'claim:attending',
    ],
];
