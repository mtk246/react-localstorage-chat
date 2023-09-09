<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claim:controlNumber',
    ],
    'tradingPartnerServiceId' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claim:tradingPartnerServiceId',
    ],
    'tradingPartnerName' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claim:tradingPartnerName',
    ],
    'usageIndicator' => [
        'type' => RuleType::SINGLE->value,
        'value' => 'claim:usageIndicator',
    ],
    'submitter' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:submitter',
    ],
    'receiver' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:receiver',
    ],
    'subscriber' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:subscriber',
    ],
    'dependent' => [
        'type' => RuleType::SINGLE_ARRAY->value,
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
        'value' => 'claim:claimInformation',
    ],
    'payToAddress' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:payToAddress',
    ],
    'billing' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:billing',
    ],
    'referring' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:referring',
    ],
    /*'rendering' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:rendering',
    ],*/
    'attending' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:attending',
    ],
];
