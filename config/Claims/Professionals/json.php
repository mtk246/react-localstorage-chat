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
    'submitter' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:submitter',
    ],
    'receiver' => [
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
    ],
    /*'payToPlan' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:payToPlan',
    ],
    'payerAddress' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:payerAddress',
    ],*/
    'billing' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:billing',
    ],
    'referring' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => null,
        'value' => 'claim:referring',
    ],
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
