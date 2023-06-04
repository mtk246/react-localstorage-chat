<?php

declare(strict_types=1);

use App\Enums\Claim\RuleFormatType;
use App\Enums\Claim\RuleType;

return [
    'preview_837p' => [
        'insurance_company' => [
            'name' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 107,
                    'y' => 16,
                ],
            ],
            'address1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 107,
                    'y' => 20,
                ],
            ],
            'address2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 107,
                    'y' => 24,
                ],
            ],
            'address3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 107,
                    'y' => 28,
                ],
            ],
        ],
        '1' => [
            'options' => [
                'Medicare' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 8.5,
                        'y' => 40,
                    ],
                ],
            ],
        ],
        '1a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 135,
                'y' => 40,
            ],
        ],
        '2' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 10,
                'y' => 48,
            ],
        ],
        '3' => [
            'year' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 100,
                    'y' => 48.5,
                ],
            ],
            'month' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 84,
                    'y' => 48.5,
                ],
            ],
            'day' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 92,
                    'y' => 48.5,
                ],
            ],
            'sex' => [
                'options' => [
                    'M' => [
                        'properties' => [
                            'fontFamily' => 'helvetica',
                            'fontSize' => '10px',
                            'align' => 'L',
                            'w' => 70,
                            'h' => 10,
                            'x' => 111,
                            'y' => 48.5,
                        ],
                    ],
                    'F' => [
                        'properties' => [
                            'fontFamily' => 'helvetica',
                            'fontSize' => '10px',
                            'align' => 'L',
                            'w' => 70,
                            'h' => 10,
                            'x' => 123.5,
                            'y' => 48.5,
                        ],
                    ],
                ],
            ],
        ],
        '4' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 135,
                'y' => 48,
            ],
        ],
        '5' => [
            'address' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 10,
                    'y' => 56.5,
                ],
            ],
            'city' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 10,
                    'y' => 64.5,
                ],
            ],
            'state' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 72.5,
                    'y' => 64.5,
                ],
            ],
            'zip' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 10,
                    'y' => 74,
                ],
            ],
            'code_area' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 44.5,
                    'y' => 74,
                ],
            ],
            'phone' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 53,
                    'y' => 74,
                ],
            ],
        ],
        '6' => [
            'options' => [
                'self' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 88.5,
                        'y' => 57,
                    ],
                ],
                'spouse' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 101,
                        'y' => 57,
                    ],
                ],
                'child' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 111,
                        'y' => 57,
                    ],
                ],
                'other' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 123.5,
                        'y' => 74,
                    ],
                ],
            ],
        ],
        '7' => [
            'address' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 135,
                    'y' => 56.5,
                ],
            ],
            'city' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 135,
                    'y' => 64.5,
                ],
            ],
            'state' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 191.5,
                    'y' => 64.5,
                ],
            ],
            'zip' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 135,
                    'y' => 74,
                ],
            ],
            'code_area' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 170,
                    'y' => 74,
                ],
            ],
            'phone' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 178.5,
                    'y' => 74,
                ],
            ],
        ],
        // '8' => '',
        '9' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 10,
                'y' => 81.5,
            ],
        ],
        '9a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 10,
                'y' => 90,
            ],
        ],
        // '9b' => ''
        // '9c' => '',
        '9d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 10,
                'y' => 115.5,
            ],
        ],
        // '10' => '',
        '10a' => [
            'options' => [
                true => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 93.5,
                        'y' => 90.8,
                    ],
                ],
                false => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 108.5,
                        'y' => 90.8,
                    ],
                ],
            ],
        ],
        '10b' => [
            'place_state' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 5.8,
                    'x' => 120,
                    'y' => 99,
                ],
            ],
            'options' => [
                true => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 93.5,
                        'y' => 99,
                    ],
                ],
                false => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 108.5,
                        'y' => 99,
                    ],
                ],
            ],
        ],
        '10c' => [
            'options' => [
                true => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 93.5,
                        'y' => 107.2,
                    ],
                ],
                false => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 108.5,
                        'y' => 107.2,
                    ],
                ],
            ],
        ],
        // '10d' => '',
    ],
    'preview_837i' => [
    ],

    /*
    |--------------------------------------------------------------------------
    | claims rules
    |--------------------------------------------------------------------------
    |
    | congig and formats for claims rules
    |
    */

    'formats' => [
        RuleFormatType::INSTITUTIONAL->value => [
            'file' => [
                '1a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'value' => [
                        'model' => 'value',
                        'company' => 'id',
                    ],
                    'values' => [
                        'common' => [
                        ],
                        'company' => [
                        ],
                        'billing_company' => [
                        ],
                    ],
                ],
                '2a' => [
                    'type' => RuleType::BOOLEAN,
                    'value' => false,
                ],
                '2b' => [
                    'type' => RuleType::BOOLEAN,
                    'value' => false,
                    'values' => [
                        'common' => [
                        ],
                        'company' => [
                        ],
                        'billing_company' => [
                        ],
                    ],
                ],
            ],
            'digital' => [
            ],
        ],
    ],
];
