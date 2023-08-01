<?php

declare(strict_types=1);

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FormatType;
use App\Enums\Claim\RuleType;

return [
    'preview_837p' => [
        '0a' => [
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
        '0b' => [
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
        '0c' => [
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
                'Medicaid' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 25.5,
                        'y' => 40,
                    ],
                ],
                'Tricare' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 43,
                        'y' => 40,
                    ],
                ],
                'Champva' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 66,
                        'y' => 40,
                    ],
                ],
                'Group' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 83.5,
                        'y' => 40,
                    ],
                ],
                'Feca' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 103.5,
                        'y' => 40,
                    ],
                ],
                'Other' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 118.5,
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
        '3a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 100,
                'y' => 48.5,
            ],
        ],
        '3b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 84,
                'y' => 48.5,
            ],
        ],
        '3c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 92,
                'y' => 48.5,
            ],
        ],
        '3d' => [
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
        '5a' => [
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
        '5b' => [
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
        '5c' => [
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
        '5d' => [
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
        '5e' => [
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
        '5f' => [
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
                        'y' => 57,
                    ],
                ],
            ],
        ],
        '7a' => [
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
        '7b' => [
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
        '7c' => [
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
        '7d' => [
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
        '7e' => [
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
        '7f' => [
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
        // '8' => '',
        '9' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
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
                'fontSize' => '10px',
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
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 10,
                'y' => 115.5,
            ],
        ],
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
        '10ba' => [
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
        '10bb' => [
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
        '11' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 133,
                'y' => 82,
            ],
        ],
        '11aa' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 154,
                'y' => 91,
            ],
        ],
        '11ab' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 139.5,
                'y' => 91,
            ],
        ],
        '11ac' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 146,
                'y' => 91,
            ],
        ],
        '11ad' => [
            'options' => [
                'M' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 10,
                        'x' => 176,
                        'y' => 90.5,
                    ],
                ],
                'F' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 10,
                        'x' => 193.8,
                        'y' => 90.5,
                    ],
                ],
            ],
        ],
        '11c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 135,
                'y' => 107.5,
            ],
        ],
        '11d' => [
            'options' => [
                true => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 136,
                        'y' => 115,
                    ],
                ],
                false => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 5.8,
                        'x' => 148.5,
                        'y' => 115,
                    ],
                ],
            ],
        ],
        '12a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 27,
                'y' => 131.5,
            ],
        ],
        '12b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 100,
                'y' => 131.5,
            ],
        ],
        '13' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 148.5,
                'y' => 131.5,
            ],
        ],
        '14a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 11,
                'y' => 141,
            ],
        ],
        '14b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 19.5,
                'y' => 141,
            ],
        ],
        '14c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 27,
                'y' => 141,
            ],
        ],
        '14d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 46,
                'y' => 141,
            ],
        ],
        '15a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 83,
                'y' => 141,
            ],
        ],
        '15b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 100,
                'y' => 141,
            ],
        ],
        '15c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 106,
                'y' => 141,
            ],
        ],
        '15d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 114,
                'y' => 141,
            ],
        ],
        '16a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 142,
                'y' => 141,
            ],
        ],
        '16b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 148,
                'y' => 141,
            ],
        ],
        '16c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 177,
                'y' => 141,
            ],
        ],
        '16d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 183,
                'y' => 141,
            ],
        ],
        '16e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 156,
                'y' => 141,
            ],
        ],
        '16f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 191,
                'y' => 141,
            ],
        ],
        '170' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 9,
                'y' => 149,
            ],
        ],
        '171' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 15.5,
                'y' => 149,
            ],
        ],
        '17a0' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 81,
                'y' => 145,
            ],
        ],
        '17a1' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 86.5,
                'y' => 145,
            ],
        ],
        '17b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 86.5,
                'y' => 149,
            ],
        ],
        '18a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 142,
                'y' => 149,
            ],
        ],
        '18b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 148,
                'y' => 149,
            ],
        ],
        '18c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 156,
                'y' => 149,
            ],
        ],
        '18d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 177,
                'y' => 149,
            ],
        ],
        '18e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 183,
                'y' => 149,
            ],
        ],
        '18f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 191,
                'y' => 149,
            ],
        ],
        '19' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 9,
                'y' => 157,
            ],
        ],
        '20a' => [
            'options' => [
                true => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 10,
                        'x' => 136,
                        'y' => 157.2,
                    ],
                ],
                false => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '10px',
                        'align' => 'L',
                        'w' => 70,
                        'h' => 10,
                        'x' => 148.8,
                        'y' => 157.2,
                    ],
                ],
            ],
        ],
        '20b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'R',
                'w' => 25,
                'h' => 10,
                'x' => 160,
                'y' => 157.2,
            ],
        ],
        '21' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 8,
                'h' => 10,
                'x' => 111.5,
                'y' => 162,
            ],
        ],
        '21A' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 12.5,
                'y' => 166,
            ],
        ],
        '21B' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 45,
                'y' => 166,
            ],
        ],
        '21C' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 77.9,
                'y' => 166,
            ],
        ],
        '21D' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 110.4,
                'y' => 166.3,
            ],
        ],
        '21E' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 12.5,
                'y' => 170,
            ],
        ],
        '21F' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 45,
                'y' => 170.1,
            ],
        ],
        '21G' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 77.9,
                'y' => 170,
            ],
        ],
        '21H' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 110.4,
                'y' => 170.5,
            ],
        ],
        '21I' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 12.5,
                'y' => 174,
            ],
        ],
        '21J' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 45,
                'y' => 174.2,
            ],
        ],
        '21K' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 77.9,
                'y' => 174.2,
            ],
        ],
        '21L' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 110.4,
                'y' => 174.2,
            ],
        ],
        '22A' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 132,
                'y' => 166.3,
            ],
        ],
        '22B' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 20,
                'h' => 10,
                'x' => 160,
                'y' => 166.3,
            ],
        ],
        '23' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 132,
                'y' => 174.2,
            ],
        ],
        '24' => [
            'from_year_A1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 23,
                    'y' => 191,
                ],
            ],
            'from_month_A1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 9,
                    'y' => 191,
                ],
            ],
            'from_day_A1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 15.5,
                    'y' => 191,
                ],
            ],
            'to_year_A1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 191,
                ],
            ],
            'to_month_A1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 31,
                    'y' => 191,
                ],
            ],
            'to_day_A1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 38,
                    'y' => 191,
                ],
            ],
            'pos_B1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 53,
                    'y' => 191,
                ],
            ],
            'emg_C1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 61,
                    'y' => 191,
                ],
            ],
            'procedure_D1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 191,
                ],
            ],
            'modifier1_D1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 87.5,
                    'y' => 191,
                ],
            ],
            'modifier2_D1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 95.5,
                    'y' => 191,
                ],
            ],
            'modifier3_D1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103.5,
                    'y' => 191,
                ],
            ],
            'modifier4_D1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 111.5,
                    'y' => 191,
                ],
            ],
            'pointer_E1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 191,
                ],
            ],
            'charges_F1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 132,
                    'y' => 191,
                ],
            ],
            'charges_decimal_F1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 147,
                    'y' => 191,
                ],
            ],
            'days_G1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 153,
                    'y' => 191,
                ],
            ],
            'epsdt_H1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 187,
                ],
            ],
            'family_planing_H1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 191,
                ],
            ],
            'qualifier_I1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 169,
                    'y' => 187,
                ],
            ],
            'npi_J1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 191,
                ],
            ],
            'tax_J1' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 187,
                ],
            ],

            'from_year_A2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 23,
                    'y' => 199.3,
                ],
            ],
            'from_month_A2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 9,
                    'y' => 199.3,
                ],
            ],
            'from_day_A2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 15.5,
                    'y' => 199.3,
                ],
            ],
            'to_year_A2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 199.3,
                ],
            ],
            'to_month_A2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 31,
                    'y' => 199.3,
                ],
            ],
            'to_day_A2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 38,
                    'y' => 199.3,
                ],
            ],
            'pos_B2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 53,
                    'y' => 199.3,
                ],
            ],
            'emg_C2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 61,
                    'y' => 199.3,
                ],
            ],
            'procedure_D2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 199.3,
                ],
            ],
            'modifier1_D2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 87.5,
                    'y' => 199.3,
                ],
            ],
            'modifier2_D2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 95.5,
                    'y' => 199.3,
                ],
            ],
            'modifier3_D2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103.5,
                    'y' => 199.3,
                ],
            ],
            'modifier4_D2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 111.5,
                    'y' => 199.3,
                ],
            ],
            'pointer_E2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 199.3,
                ],
            ],
            'charges_F2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 132,
                    'y' => 199.3,
                ],
            ],
            'charges_decimal_F2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 147,
                    'y' => 199.3,
                ],
            ],
            'days_G2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 153,
                    'y' => 199.3,
                ],
            ],
            'epsdt_H2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 195.3,
                ],
            ],
            'family_planing_H2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 199.3,
                ],
            ],
            'qualifier_I2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 169,
                    'y' => 195.3,
                ],
            ],
            'npi_J2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 199.3,
                ],
            ],
            'tax_J2' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 195.3,
                ],
            ],
            'from_year_A3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 23,
                    'y' => 207.6,
                ],
            ],
            'from_month_A3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 9,
                    'y' => 207.6,
                ],
            ],
            'from_day_A3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 15.5,
                    'y' => 207.6,
                ],
            ],
            'to_year_A3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 207.6,
                ],
            ],
            'to_month_A3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 31,
                    'y' => 207.6,
                ],
            ],
            'to_day_A3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 38,
                    'y' => 207.6,
                ],
            ],
            'pos_B3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 53,
                    'y' => 207.6,
                ],
            ],
            'emg_C3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 61,
                    'y' => 207.6,
                ],
            ],
            'procedure_D3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 207.6,
                ],
            ],
            'modifier1_D3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 87.5,
                    'y' => 207.6,
                ],
            ],
            'modifier2_D3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 95.5,
                    'y' => 207.6,
                ],
            ],
            'modifier3_D3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103.5,
                    'y' => 207.6,
                ],
            ],
            'modifier4_D3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 111.5,
                    'y' => 207.6,
                ],
            ],
            'pointer_E3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 207.6,
                ],
            ],
            'charges_F3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 132,
                    'y' => 207.6,
                ],
            ],
            'charges_decimal_F3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 147,
                    'y' => 207.6,
                ],
            ],
            'days_G3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 153,
                    'y' => 207.6,
                ],
            ],
            'epsdt_H3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 203.6,
                ],
            ],
            'family_planing_H3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 207.6,
                ],
            ],
            'qualifier_I3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 169,
                    'y' => 203.6,
                ],
            ],
            'npi_J3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 207.6,
                ],
            ],
            'tax_J3' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 203.6,
                ],
            ],
            'from_year_A4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 23,
                    'y' => 215.9,
                ],
            ],
            'from_month_A4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 9,
                    'y' => 215.9,
                ],
            ],
            'from_day_A4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 15.5,
                    'y' => 215.9,
                ],
            ],
            'to_year_A4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 215.9,
                ],
            ],
            'to_month_A4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 31,
                    'y' => 215.9,
                ],
            ],
            'to_day_A4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 38,
                    'y' => 215.9,
                ],
            ],
            'pos_B4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 53,
                    'y' => 215.9,
                ],
            ],
            'emg_C4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 61,
                    'y' => 215.9,
                ],
            ],
            'procedure_D4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 215.9,
                ],
            ],
            'modifier1_D4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 87.5,
                    'y' => 215.9,
                ],
            ],
            'modifier2_D4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 95.5,
                    'y' => 215.9,
                ],
            ],
            'modifier3_D4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103.5,
                    'y' => 215.9,
                ],
            ],
            'modifier4_D4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 111.5,
                    'y' => 215.9,
                ],
            ],
            'pointer_E4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 215.9,
                ],
            ],
            'charges_F4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 132,
                    'y' => 215.9,
                ],
            ],
            'charges_decimal_F4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 147,
                    'y' => 215.9,
                ],
            ],
            'days_G4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 153,
                    'y' => 215.9,
                ],
            ],
            'epsdt_H4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 211.9,
                ],
            ],
            'family_planing_H4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 215.9,
                ],
            ],
            'qualifier_I4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 169,
                    'y' => 211.9,
                ],
            ],
            'npi_J4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 215.9,
                ],
            ],
            'tax_J4' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 211.9,
                ],
            ],
            'from_year_A5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 23,
                    'y' => 224.2,
                ],
            ],
            'from_month_A5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 9,
                    'y' => 224.2,
                ],
            ],
            'from_day_A5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 15.5,
                    'y' => 224.2,
                ],
            ],
            'to_year_A5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 224.2,
                ],
            ],
            'to_month_A5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 31,
                    'y' => 224.2,
                ],
            ],
            'to_day_A5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 38,
                    'y' => 224.2,
                ],
            ],
            'pos_B5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 53,
                    'y' => 224.2,
                ],
            ],
            'emg_C5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 61,
                    'y' => 224.2,
                ],
            ],
            'procedure_D5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 224.2,
                ],
            ],
            'modifier1_D5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 87.5,
                    'y' => 224.2,
                ],
            ],
            'modifier2_D5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 95.5,
                    'y' => 224.2,
                ],
            ],
            'modifier3_D5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103.5,
                    'y' => 224.2,
                ],
            ],
            'modifier4_D5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 111.5,
                    'y' => 224.2,
                ],
            ],
            'pointer_E5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 224.2,
                ],
            ],
            'charges_F5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 132,
                    'y' => 224.2,
                ],
            ],
            'charges_decimal_F5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 147,
                    'y' => 224.2,
                ],
            ],
            'days_G5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 153,
                    'y' => 224.2,
                ],
            ],
            'epsdt_H5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 220.2,
                ],
            ],
            'family_planing_H5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 224.2,
                ],
            ],
            'qualifier_I5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 169,
                    'y' => 220.2,
                ],
            ],
            'npi_J5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 224.2,
                ],
            ],
            'tax_J5' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 220.2,
                ],
            ],
            'from_year_A6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 23,
                    'y' => 232.5,
                ],
            ],
            'from_month_A6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 9,
                    'y' => 232.5,
                ],
            ],
            'from_day_A6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 15.5,
                    'y' => 232.5,
                ],
            ],
            'to_year_A6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 232.5,
                ],
            ],
            'to_month_A6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 31,
                    'y' => 232.5,
                ],
            ],
            'to_day_A6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 38,
                    'y' => 232.5,
                ],
            ],
            'pos_B6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 53,
                    'y' => 232.5,
                ],
            ],
            'emg_C6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 61,
                    'y' => 232.5,
                ],
            ],
            'procedure_D6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 232.5,
                ],
            ],
            'modifier1_D6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 87.5,
                    'y' => 232.5,
                ],
            ],
            'modifier2_D6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 95.5,
                    'y' => 232.5,
                ],
            ],
            'modifier3_D6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103.5,
                    'y' => 232.5,
                ],
            ],
            'modifier4_D6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 111.5,
                    'y' => 232.5,
                ],
            ],
            'pointer_E6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 232.5,
                ],
            ],
            'charges_F6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 132,
                    'y' => 232.5,
                ],
            ],
            'charges_decimal_F6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 147,
                    'y' => 232.5,
                ],
            ],
            'days_G6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 15,
                    'h' => 10,
                    'x' => 153,
                    'y' => 232.5,
                ],
            ],
            'epsdt_H6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 228.5,
                ],
            ],
            'family_planing_H6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 163,
                    'y' => 232.5,
                ],
            ],
            'qualifier_I6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 169,
                    'y' => 228.5,
                ],
            ],
            'npi_J6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 232.5,
                ],
            ],
            'tax_J6' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 176,
                    'y' => 228.5,
                ],
            ],
        ],
        '25A' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 35,
                'h' => 10,
                'x' => 10,
                'y' => 240.8,
            ],
        ],
        '25B' => [
            'options' => [
                'SSN' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 35,
                        'h' => 10,
                        'x' => 48.5,
                        'y' => 240.8,
                    ],
                ],
                'EIN' => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 35,
                        'h' => 10,
                        'x' => 53.5,
                        'y' => 240.8,
                    ],
                ],
            ],
        ],
        '26' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 35,
                'h' => 10,
                'x' => 65,
                'y' => 240.8,
            ],
        ],
        '27' => [
            'options' => [
                true => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 35,
                        'h' => 10,
                        'x' => 101.2,
                        'y' => 240.8,
                    ],
                ],
                false => [
                    'properties' => [
                        'fontFamily' => 'helvetica',
                        'fontSize' => '9px',
                        'align' => 'L',
                        'w' => 35,
                        'h' => 10,
                        'x' => 113.5,
                        'y' => 240.8,
                    ],
                ],
            ],
        ],
        '28' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 18,
                    'h' => 10,
                    'x' => 134,
                    'y' => 240.8,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 6,
                    'h' => 10,
                    'x' => 152,
                    'y' => 240.8,
                ],
            ],
        ],
        '29' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'R',
                    'w' => 15,
                    'h' => 10,
                    'x' => 162,
                    'y' => 240.8,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 6,
                    'h' => 10,
                    'x' => 177,
                    'y' => 240.8,
                ],
            ],
        ],
        '31A' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 15,
                'y' => 255.5,
            ],
        ],
        '31B' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 15,
                'y' => 260,
            ],
        ],
        '31C' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 45,
                'y' => 260,
            ],
        ],
        '32A0' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 65,
                'y' => 248,
            ],
        ],
        '32A1' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 65,
                'y' => 252,
            ],
        ],
        '32A2' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 65,
                'y' => 256,
            ],
        ],
        '32A' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 65,
                'y' => 262,
            ],
        ],
        '33A0' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 134,
                'y' => 248,
            ],
        ],
        '33A1' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 134,
                'y' => 252,
            ],
        ],
        '33A2' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 134,
                'y' => 256,
            ],
        ],
        '33A3' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 172,
                'y' => 246,
            ],
        ],
        '33A4' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 182,
                'y' => 246,
            ],
        ],
        '33A' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 5.8,
                'x' => 134,
                'y' => 262,
            ],
        ],
    ],
    'preview_837i' => [
        '1a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 60,
                'h' => 10,
                'x' => 10,
                'y' => 4.5,
            ],
        ],
        '1b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 60,
                'h' => 10,
                'x' => 10,
                'y' => 8.5,
            ],
        ],
        '1c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 60,
                'h' => 10,
                'x' => 10,
                'y' => 13,
            ],
        ],
        '1d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 10,
                'y' => 17.5,
            ],
        ],
        '2a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 60,
                'h' => 10,
                'x' => 72,
                'y' => 4.5,
            ],
        ],
        '2b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 60,
                'h' => 10,
                'x' => 72,
                'y' => 8.5,
            ],
        ],
        '2c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 60,
                'h' => 10,
                'x' => 72,
                'y' => 13,
            ],
        ],
        '2d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 72,
                'y' => 17.5,
            ],
        ],
        '3a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 138,
                'y' => 4.5,
            ],
        ],
        '3b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 140,
                'y' => 8.5,
            ],
        ],
        '4' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 200,
                'y' => 8.5,
            ],
        ],
        '5' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 17,
            ],
        ],
        '6a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 155.5,
                'y' => 17,
            ],
        ],
        '6b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 173,
                'y' => 17,
            ],
        ],
        '7' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 195,
                'y' => 17,
            ],
        ],
        '8a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 35,
                'y' => 21.5,
            ],
        ],
        '8b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 10,
                'y' => 25.5,
            ],
        ],
        '9a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 110,
                'y' => 21.5,
            ],
        ],
        '9b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 85,
                'y' => 25.5,
            ],
        ],
        '9c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 167,
                'y' => 25.5,
            ],
        ],
        '9d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 176,
                'y' => 25.5,
            ],
        ],
        '9e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 204,
                'y' => 25.5,
            ],
        ],
        '10' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 7,
                'y' => 34,
            ],
        ],
        '11' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 29,
                'y' => 34,
            ],
        ],
        '12' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 35.5,
                'y' => 34,
            ],
        ],
        '13' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 52,
                'y' => 34,
            ],
        ],
        '14' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 60,
                'y' => 34,
            ],
        ],
        '15' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 67,
                'y' => 34,
            ],
        ],
        '16' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 74,
                'y' => 34,
            ],
        ],
        '17' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 82,
                'y' => 34,
            ],
        ],
        '18' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 90,
                'y' => 34,
            ],
        ],
        '19' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 97,
                'y' => 34,
            ],
        ],
        '20' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 105,
                'y' => 34,
            ],
        ],
        '21' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 112,
                'y' => 34,
            ],
        ],
        '22' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 119.5,
                'y' => 34,
            ],
        ],
        '23' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 127,
                'y' => 34,
            ],
        ],
        '24' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 134,
                'y' => 34,
            ],
        ],
        '25' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 142,
                'y' => 34,
            ],
        ],
        '26' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 150,
                'y' => 34,
            ],
        ],
        '27' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 157,
                'y' => 34,
            ],
        ],
        '28' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 165,
                'y' => 34,
            ],
        ],
        '29' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 173,
                'y' => 34,
            ],
        ],
        // '30' => 'Future Use',
        '31a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 7,
                'y' => 42.5,
            ],
        ],
        '31b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 7,
                'y' => 46.5,
            ],
        ],
        '31c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 17,
                'y' => 42.5,
            ],
        ],
        '31d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 17,
                'y' => 46.5,
            ],
        ],
        '32a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 32,
                'y' => 42.5,
            ],
        ],
        '32b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 32,
                'y' => 46.5,
            ],
        ],
        '32c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 42,
                'y' => 42.5,
            ],
        ],
        '32d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 42,
                'y' => 46.5,
            ],
        ],
        '33a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 56.5,
                'y' => 42.5,
            ],
        ],
        '33b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 56.5,
                'y' => 46.5,
            ],
        ],
        '33c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 66.5,
                'y' => 42.5,
            ],
        ],
        '33d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 66.5,
                'y' => 46.5,
            ],
        ],
        '34a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 81,
                'y' => 42.5,
            ],
        ],
        '34b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 81,
                'y' => 46.5,
            ],
        ],
        '34c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 92,
                'y' => 42.5,
            ],
        ],
        '34d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 92,
                'y' => 46.5,
            ],
        ],
        '35a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 105.5,
                'y' => 42.5,
            ],
        ],
        '35b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 105.5,
                'y' => 46.5,
            ],
        ],
        '35c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 116,
                'y' => 42.5,
            ],
        ],
        '35d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 116,
                'y' => 46.5,
            ],
        ],
        '35e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 42.5,
            ],
        ],
        '35f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 46.5,
            ],
        ],
        '36a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 148,
                'y' => 42.5,
            ],
        ],
        '36b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 148,
                'y' => 46.5,
            ],
        ],
        '36c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 160,
                'y' => 42.5,
            ],
        ],
        '36d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 160,
                'y' => 46.5,
            ],
        ],
        '36e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 175,
                'y' => 42.5,
            ],
        ],
        '36f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 175,
                'y' => 46.5,
            ],
        ],
        // '37' => '',
        '38a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 10,
                'y' => 55.5,
            ],
        ],
        '38b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 10,
                'y' => 59.5,
            ],
        ],
        '38c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 10,
                'y' => 63.5,
            ],
        ],
        '39a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 113,
                'y' => 55.5,
            ],
        ],
        '39b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 55.5,
            ],
        ],
        '39c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 113,
                'y' => 59.5,
            ],
        ],
        '39d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 59.5,
            ],
        ],
        '39e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 113,
                'y' => 63.5,
            ],
        ],
        '39f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 63.5,
            ],
        ],
        '39g' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 113,
                'y' => 67.5,
            ],
        ],
        '39h' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 133,
                'y' => 67.5,
            ],
        ],
        '40a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 145.5,
                'y' => 55.5,
            ],
        ],
        '40b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 165,
                'y' => 55.5,
            ],
        ],
        '40c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 145.5,
                'y' => 59.5,
            ],
        ],
        '40d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 165,
                'y' => 59.5,
            ],
        ],
        '40e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 145.5,
                'y' => 63.5,
            ],
        ],
        '40f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 165,
                'y' => 63.5,
            ],
        ],
        '40g' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 145.5,
                'y' => 67.5,
            ],
        ],
        '40h' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 165,
                'y' => 67.5,
            ],
        ],
        '41a' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 177.5,
                'y' => 55.5,
            ],
        ],
        '41b' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 197,
                'y' => 55.5,
            ],
        ],
        '41c' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 177.5,
                'y' => 59.5,
            ],
        ],
        '41d' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 197,
                'y' => 59.5,
            ],
        ],
        '41e' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 177.5,
                'y' => 63.5,
            ],
        ],
        '41f' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 197,
                'y' => 63.5,
            ],
        ],
        '41g' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 177.5,
                'y' => 67.5,
            ],
        ],
        '41h' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 197,
                'y' => 67.5,
            ],
        ],
        '42' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 166,
                ],
            ],
        ],
        '43' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 60,
                    'h' => 4.5,
                    'x' => 19,
                    'y' => 166,
                ],
            ],
        ],
        '44' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 81,
                    'y' => 166,
                ],
            ],
        ],
        '45' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '9px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 118,
                    'y' => 166,
                ],
            ],
        ],
        '46' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 166,
                ],
            ],
        ],
        '47' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 161,
                    'y' => 166,
                ],
            ],
        ],
        '48' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 180,
                    'y' => 166,
                ],
            ],
        ],
        '49' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 77,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 81,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 85,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 89,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 93.5,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 97.5,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 102,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 106.5,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 110.5,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 115,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 119,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 123.5,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 128,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 132,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 136,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 140,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 145,
                ],
            ],
            17 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 149,
                ],
            ],
            18 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 153,
                ],
            ],
            19 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 157,
                ],
            ],
            20 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 161.5,
                ],
            ],
            21 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 204,
                    'y' => 166,
                ],
            ],
        ],
        '50' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 187,
                ],
            ],
        ],
        '51' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 64,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 64,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 64,
                    'y' => 187,
                ],
            ],
        ],
        '52' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 101.5,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 101.5,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 101.5,
                    'y' => 187,
                ],
            ],
        ],
        '53' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 109,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 109,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 109,
                    'y' => 187,
                ],
            ],
        ],
        '54' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 116,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 116,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 116,
                    'y' => 187,
                ],
            ],
        ],
        '55' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 144,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 144,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'R',
                    'w' => 17,
                    'h' => 10,
                    'x' => 144,
                    'y' => 187,
                ],
            ],
        ],
        '56' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 17,
                'h' => 10,
                'x' => 175,
                'y' => 175,
            ],
        ],
        '57' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 17,
                    'h' => 10,
                    'x' => 175,
                    'y' => 179,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 17,
                    'h' => 10,
                    'x' => 175,
                    'y' => 183,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 17,
                    'h' => 10,
                    'x' => 175,
                    'y' => 187,
                ],
            ],
        ],
        '58' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 196,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 200,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 204,
                ],
            ],
        ],
        '59' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 72.5,
                    'y' => 196,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 72.5,
                    'y' => 200,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 72.5,
                    'y' => 204,
                ],
            ],
        ],
        '60' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 79,
                    'y' => 196,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 79,
                    'y' => 200,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 79,
                    'y' => 204,
                ],
            ],
        ],
        '61' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 129,
                    'y' => 196,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 129,
                    'y' => 200,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 129,
                    'y' => 204,
                ],
            ],
        ],
        '62' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 167,
                    'y' => 196,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 167,
                    'y' => 200,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 167,
                    'y' => 204,
                ],
            ],
        ],
        '63' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 213,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 217,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 221,
                ],
            ],
        ],
        '64' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 84,
                    'y' => 213,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 84,
                    'y' => 217,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 84,
                    'y' => 221,
                ],
            ],
        ],
        '65' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 149,
                    'y' => 213,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 149,
                    'y' => 217,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 149,
                    'y' => 221,
                ],
            ],
        ],
        '66' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 5.5,
                'y' => 229.5,
            ],
        ],
        '67' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 30,
                    'y' => 225,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 50,
                    'y' => 225,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 225,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 90,
                    'y' => 225,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 110,
                    'y' => 225,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 130,
                    'y' => 225,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 150,
                    'y' => 225,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 170,
                    'y' => 225,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 10,
                    'y' => 230,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 30,
                    'y' => 230,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 50,
                    'y' => 230,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 70,
                    'y' => 230,
                ],
            ],
            12 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 90,
                    'y' => 230,
                ],
            ],
            13 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 110,
                    'y' => 230,
                ],
            ],
            14 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 130,
                    'y' => 230,
                ],
            ],
            15 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 150,
                    'y' => 230,
                ],
            ],
            16 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 170,
                    'y' => 230,
                ],
            ],
        ],
        '68' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 190,
                'y' => 225,
            ],
        ],
        '69' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 17.5,
                'y' => 234,
            ],
        ],
        '70' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 47,
                    'y' => 234,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 65,
                    'y' => 234,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 82,
                    'y' => 234,
                ],
            ],
        ],
        '71' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 109,
                'y' => 234,
            ],
        ],
        '72' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 126,
                    'y' => 234,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 146,
                    'y' => 234,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 166,
                    'y' => 234,
                ],
            ],
        ],
        '73' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 188,
                'y' => 234,
            ],
        ],
        '74' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 242,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 28,
                    'y' => 242,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 242,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 65,
                    'y' => 242,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 83,
                    'y' => 242,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103,
                    'y' => 242,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 250,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 28,
                    'y' => 250,
                ],
            ],
            8 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 46,
                    'y' => 250,
                ],
            ],
            9 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 65,
                    'y' => 250,
                ],
            ],
            10 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 83,
                    'y' => 250,
                ],
            ],
            11 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 103,
                    'y' => 250,
                ],
            ],
        ],
        '76' => [
            'NPI' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 151,
                    'y' => 239,
                ],
            ],
            'QUALIFIER' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 187,
                    'y' => 239,
                ],
            ],
            'FIRST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 181,
                    'y' => 242,
                ],
            ],
            'LAST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 242,
                ],
            ],
        ],
        '77' => [
            'NPI' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 152,
                    'y' => 247,
                ],
            ],
            'QUALIFIER' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 188,
                    'y' => 247,
                ],
            ],
            'FIRST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 181,
                    'y' => 251,
                ],
            ],
            'LAST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 251,
                ],
            ],
        ],
        '78' => [
            'NPI' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 152,
                    'y' => 255.5,
                ],
            ],
            'QUALIFIER' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 188,
                    'y' => 255.5,
                ],
            ],
            'FIRST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 181,
                    'y' => 259.5,
                ],
            ],
            'LAST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 259.5,
                ],
            ],
        ],
        '79' => [
            'NPI' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 152,
                    'y' => 264,
                ],
            ],
            'QUALIFIER' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 188,
                    'y' => 264,
                ],
            ],
            'FIRST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 181,
                    'y' => 268,
                ],
            ],
            'LAST' => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 136,
                    'y' => 268,
                ],
            ],
        ],
        '80' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 260,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 264,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 7,
                    'y' => 268,
                ],
            ],
        ],
        '81' => [
            0 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 77,
                    'y' => 255,
                ],
            ],
            1 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 77,
                    'y' => 260,
                ],
            ],
            2 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 77,
                    'y' => 264,
                ],
            ],
            3 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 77,
                    'y' => 268,
                ],
            ],
            4 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 102,
                    'y' => 255,
                ],
            ],
            5 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 102,
                    'y' => 260,
                ],
            ],
            6 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 102,
                    'y' => 264,
                ],
            ],
            7 => [
                'properties' => [
                    'fontFamily' => 'helvetica',
                    'fontSize' => '10px',
                    'align' => 'L',
                    'w' => 70,
                    'h' => 10,
                    'x' => 102,
                    'y' => 268,
                ],
            ],
        ],
        'ta' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 7,
                'y' => 170,
            ],
        ],
        'tb1' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 30,
                'y' => 170,
            ],
        ],
        'tb2' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'L',
                'w' => 70,
                'h' => 10,
                'x' => 44,
                'y' => 170,
            ],
        ],
        'tc' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '9px',
                'align' => 'L',
                'w' => 30,
                'h' => 10,
                'x' => 118,
                'y' => 170,
            ],
        ],
        'td' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'R',
                'w' => 70,
                'h' => 10,
                'x' => 180,
                'y' => 170,
            ],
        ],
        'te' => [
            'properties' => [
                'fontFamily' => 'helvetica',
                'fontSize' => '10px',
                'align' => 'R',
                'w' => 30,
                'h' => 10,
                'x' => 148,
                'y' => 170,
            ],
        ],
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
        ClaimType::INSTITUTIONAL->value => [
            FormatType::FILE->value => [
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
                    'value' => 'demographicInformation.patient.user.profile.date_of_birth|mdY',
                    'values' => [
                        'common' => [
                            'demographicInformation.patient.user.profile.date_of_birth|m/d/y',
                            'demographicInformation.patient.user.profile.date_of_birth|m-d-y',
                            'demographicInformation.patient.user.profile.date_of_birth|mdY',
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
                    'type' => RuleType::SINGLE->value,
                    'length' => 30,
                    'value' => 'medicalAssistanceType',
                    'values' => [
                        'common' => [
                            'medicalAssistanceType',
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
                        '| ',
                        'HigherInsuranceCompany:state',
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
                    'value' => 'claimServices:short_description',
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
                '44' => [
                    'type' => RuleType::SINGLE_ARRAY->value,
                    'value' => 'claimServices:related_group',
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
            ],
            FormatType::X12->value => [
            ],
        ],
        ClaimType::PROFESSIONAL->value => [
            FormatType::FILE->value => [
                '0a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'higherInsuranceCompany:name',
                    ],
                    'values' => [
                        'common' => [
                            'insuranceCompany.name',
                            'insuranceCompany.address',
                        ],
                    ],
                ],
                '0b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'higherInsuranceCompany:address',
                    ],
                    'values' => [
                        'common' => [
                            'higherInsuranceCompany:name',
                            'higherInsuranceCompany:address',
                        ],
                    ],
                ],
                '0c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'glue' => ' ',
                    'value' => [
                        'higherInsuranceCompany:city',
                        'higherInsuranceCompany:state',
                        'higherInsuranceCompany:zip',
                    ],
                ],
                '1' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'insType:code',
                ],
                '1a' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'higherOrderPolicy:policy_number',
                ],
                '2' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'patientProfile:last_name',
                        'patientProfile:name_suffix',
                        'patientProfile:first_name',
                        'patientProfile:middle_name',
                    ],
                ],
                '3a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'patientProfile:year_of_birth',
                    ],
                    'values' => [
                        'common' => [
                            'patientProfile:year_of_birth',
                            'patientProfile:month_of_birth',
                            'patientProfile:day_of_birth',
                            'patientProfile:sex',
                        ],
                    ],
                ],
                '3b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'patientProfile:month_of_birth',
                    ],
                    'values' => [
                        'common' => [
                            'patientProfile:year_of_birth',
                            'patientProfile:month_of_birth',
                            'patientProfile:day_of_birth',
                            'patientProfile:sex',
                        ],
                    ],
                ],
                '3c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'patientProfile:day_of_birth',
                    ],
                    'values' => [
                        'common' => [
                            'patientProfile:year_of_birth',
                            'patientProfile:month_of_birth',
                            'patientProfile:day_of_birth',
                            'patientProfile:sex',
                        ],
                    ],
                ],
                '3d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 1,
                    'value' => [
                        'patientProfile:sex',
                    ],
                    'values' => [
                        'common' => [
                            'patientProfile:year_of_birth',
                            'patientProfile:month_of_birth',
                            'patientProfile:day_of_birth',
                            'patientProfile:sex',
                        ],
                    ],
                ],
                '4' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'subscriber:last_name',
                        'subscriber:name_suffix',
                        'subscriber:first_name',
                        'subscriber:middle_name',
                    ],
                ],
                '5a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'patientAddress:address',
                    ],
                    'values' => [
                        'common' => [
                            'patientAddress:address',
                            'patientAddress:city',
                            'patientAddress:state',
                            'patientAddress:zip',
                            'patientContact:code',
                            'patientContact:number',
                        ],
                    ],
                ],
                '5b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'patientAddress:city',
                    ],
                    'values' => [
                        'common' => [
                            'patientAddress:address',
                            'patientAddress:city',
                            'patientAddress:state',
                            'patientAddress:zip',
                            'patientContact:code',
                            'patientContact:number',
                        ],
                    ],
                ],
                '5c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'patientAddress:state',
                    ],
                    'values' => [
                        'common' => [
                            'patientAddress:address',
                            'patientAddress:city',
                            'patientAddress:state',
                            'patientAddress:zip',
                            'patientContact:code',
                            'patientContact:number',
                        ],
                    ],
                ],
                '5d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 10,
                    'value' => [
                        'patientAddress:zip',
                    ],
                    'values' => [
                        'common' => [
                            'patientAddress:address',
                            'patientAddress:city',
                            'patientAddress:state',
                            'patientAddress:zip',
                            'patientContact:code',
                            'patientContact:number',
                        ],
                    ],
                ],
                '5e' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 3,
                    'value' => [
                        'patientContact:code',
                    ],
                    'values' => [
                        'common' => [
                            'patientAddress:address',
                            'patientAddress:city',
                            'patientAddress:state',
                            'patientAddress:zip',
                            'patientContact:code',
                            'patientContact:number',
                        ],
                    ],
                ],
                '5f' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 11,
                    'value' => [
                        'patientContact:number',
                    ],
                    'values' => [
                        'common' => [
                            'patientAddress:address',
                            'patientAddress:city',
                            'patientAddress:state',
                            'patientAddress:zip',
                            'patientContact:code',
                            'patientContact:number',
                        ],
                    ],
                ],
                '6' => [
                    'type' => RuleType::SINGLE->value,
                    'length' => 6,
                    'value' => 'subscriberRelationship:description',
                ],
                '7a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'subscriberAddress:address',
                    ],
                    'values' => [
                        'common' => [
                            'subscriberAddress:address',
                            'subscriberAddress:city',
                            'subscriberAddress:state',
                            'subscriberAddress:zip',
                            'subscriberContact:code',
                            'subscriberContact:number',
                        ],
                    ],
                ],
                '7b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'subscriberAddress:city',
                    ],
                    'values' => [
                        'common' => [
                            'subscriberAddress:address',
                            'subscriberAddress:city',
                            'subscriberAddress:state',
                            'subscriberAddress:zip',
                            'subscriberContact:code',
                            'subscriberContact:number',
                        ],
                    ],
                ],
                '7c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'subscriberAddress:state',
                    ],
                    'values' => [
                        'common' => [
                            'subscriberAddress:address',
                            'subscriberAddress:city',
                            'subscriberAddress:state',
                            'subscriberAddress:zip',
                            'subscriberContact:code',
                            'subscriberContact:number',
                        ],
                    ],
                ],
                '7d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 10,
                    'value' => [
                        'subscriberAddress:zip',
                    ],
                    'values' => [
                        'common' => [
                            'subscriberAddress:address',
                            'subscriberAddress:city',
                            'subscriberAddress:state',
                            'subscriberAddress:zip',
                            'subscriberContact:code',
                            'subscriberContact:number',
                        ],
                    ],
                ],
                '7e' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 3,
                    'value' => [
                        'subscriberContact:code',
                    ],
                    'values' => [
                        'common' => [
                            'subscriberAddress:address',
                            'subscriberAddress:city',
                            'subscriberAddress:state',
                            'subscriberAddress:zip',
                            'subscriberContact:code',
                            'subscriberContact:number',
                        ],
                    ],
                ],
                '7f' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 10,
                    'value' => [
                        'subscriberContact:number',
                    ],
                    'values' => [
                        'common' => [
                            'subscriberAddress:address',
                            'subscriberAddress:city',
                            'subscriberAddress:state',
                            'subscriberAddress:zip',
                            'subscriberContact:code',
                            'subscriberContact:number',
                        ],
                    ],
                ],
                '9' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 30,
                    'value' => [
                        'lowerSubscriber:last_name',
                        'lowerSubscriber:name_suffix',
                        'lowerSubscriber:first_name',
                        'lowerSubscriber:middle_name',
                    ],
                ],
                '9a' => [
                    'type' => RuleType::SINGLE->value,
                    'length' => 30,
                    'value' => 'lowerOrderPolicy:policy_number',
                ],
                '9d' => [
                    'type' => RuleType::SINGLE->value,
                    'length' => 30,
                    'value' => 'lowerInsurancePlan:name',
                ],
                '10a' => [
                    'type' => RuleType::BOOLEAN->value,
                    'value' => 'demographicInformation:employment_related_condition',
                ],
                '10ba' => [
                    'type' => RuleType::BOOLEAN->value,
                    'value' => 'demographicInformation:auto_accident_related_condition',
                ],
                '10bb' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 10,
                    'value' => [
                        'claimDemographicInformation:auto_accident_place_state',
                    ],
                    'values' => [
                        'common' => [
                            'demographicInformation:auto_accident_related_condition',
                            'demographicInformation:auto_accident_place_state',
                        ],
                    ],
                ],
                '10c' => [
                    'type' => RuleType::BOOLEAN->value,
                    'value' => 'demographicInformation:other_accident_related_condition',
                ],
                '10d' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => '| ',
                ],
                '11' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'higherOrderPolicy:group_number',
                ],
                '11aa' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'subscriber:year_of_birth',
                    ],
                    'values' => [
                        'common' => [
                            'subscriber:year_of_birth',
                            'subscriber:month_of_birth',
                            'subscriber:day_of_birth',
                            'subscriber:sex',
                        ],
                    ],
                ],
                '11ab' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'subscriber:month_of_birth',
                    ],
                    'values' => [
                        'common' => [
                            'subscriber:year_of_birth',
                            'subscriber:month_of_birth',
                            'subscriber:day_of_birth',
                            'subscriber:sex',
                        ],
                    ],
                ],
                '11ac' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'subscriber:day_of_birth',
                    ],
                    'values' => [
                        'common' => [
                            'subscriber:year_of_birth',
                            'subscriber:month_of_birth',
                            'subscriber:day_of_birth',
                            'subscriber:sex',
                        ],
                    ],
                ],
                '11ad' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 1,
                    'value' => [
                        'subscriber:sex',
                    ],
                    'values' => [
                        'common' => [
                            'subscriber:year_of_birth',
                            'subscriber:month_of_birth',
                            'subscriber:day_of_birth',
                            'subscriber:sex',
                        ],
                    ],
                ],
                '11b' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => '| ',
                ],
                '11c' => [
                    'type' => RuleType::SINGLE->value,
                    'length' => 30,
                    'value' => 'higherInsurancePlan:name',
                ],
                '11d' => [
                    'type' => RuleType::BOOLEAN->value,
                    'value' => 'existHigherInsurancePlan',
                ],
                '12a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'patientSignature:patient_signature',
                    ],
                    'values' => [
                        'common' => [
                            'patientSignature:patient_signature',
                        ],
                    ],
                ],
                '12b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 10,
                    'value' => [
                        'firstClaimService:from_service',
                    ],
                    'values' => [
                        'common' => [
                            'patientSignature:patient_signature',
                            'firstClaimService:from_service',
                        ],
                    ],
                ],
                '13' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'patientSignature:insured_signature',
                ],
                '14a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateCurrentInformation:month_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateCurrentInformation:month_of_from_date',
                            'claimDateCurrentInformation:day_of_from_date',
                            'claimDateCurrentInformation:year_of_from_date',
                            'claimDateCurrentInformation:qualifier',
                        ],
                    ],
                ],
                '14b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateCurrentInformation:day_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateCurrentInformation:month_of_from_date',
                            'claimDateCurrentInformation:day_of_from_date',
                            'claimDateCurrentInformation:year_of_from_date',
                            'claimDateCurrentInformation:qualifier',
                        ],
                    ],
                ],
                '14c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateCurrentInformation:year_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateCurrentInformation:month_of_from_date',
                            'claimDateCurrentInformation:day_of_from_date',
                            'claimDateCurrentInformation:year_of_from_date',
                            'claimDateCurrentInformation:qualifier',
                        ],
                    ],
                ],
                '14d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateCurrentInformation:qualifier',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateCurrentInformation:month_of_from_date',
                            'claimDateCurrentInformation:day_of_from_date',
                            'claimDateCurrentInformation:year_of_from_date',
                            'claimDateCurrentInformation:qualifier',
                        ],
                    ],
                ],
                '15a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateOtherInformation:qualifier',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateOtherInformation:qualifier',
                            'claimDateOtherInformation:month_of_from_date',
                            'claimDateOtherInformation:day_of_from_date',
                            'claimDateOtherInformation:year_of_from_date',
                        ],
                    ],
                ],
                '15b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateOtherInformation:month_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateOtherInformation:qualifier',
                            'claimDateOtherInformation:month_of_from_date',
                            'claimDateOtherInformation:day_of_from_date',
                            'claimDateOtherInformation:year_of_from_date',
                        ],
                    ],
                ],
                '15c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateOtherInformation:day_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateOtherInformation:qualifier',
                            'claimDateOtherInformation:month_of_from_date',
                            'claimDateOtherInformation:day_of_from_date',
                            'claimDateOtherInformation:year_of_from_date',
                        ],
                    ],
                ],
                '15d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateOtherInformation:year_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateOtherInformation:qualifier',
                            'claimDateOtherInformation:month_of_from_date',
                            'claimDateOtherInformation:day_of_from_date',
                            'claimDateOtherInformation:year_of_from_date',
                        ],
                    ],
                ],
                '16a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateWorkInformation:month_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateWorkInformation:month_of_from_date',
                            'claimDateWorkInformation:day_of_from_date',
                            'claimDateWorkInformation:year_of_from_date',
                            'claimDateWorkInformation:month_of_to_date',
                            'claimDateWorkInformation:day_of_to_date',
                            'claimDateWorkInformation:year_of_to_date',
                        ],
                    ],
                ],
                '16b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateWorkInformation:day_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateWorkInformation:month_of_from_date',
                            'claimDateWorkInformation:day_of_from_date',
                            'claimDateWorkInformation:year_of_from_date',
                            'claimDateWorkInformation:month_of_to_date',
                            'claimDateWorkInformation:day_of_to_date',
                            'claimDateWorkInformation:year_of_to_date',
                        ],
                    ],
                ],
                '16c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateWorkInformation:year_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateWorkInformation:month_of_from_date',
                            'claimDateWorkInformation:day_of_from_date',
                            'claimDateWorkInformation:year_of_from_date',
                            'claimDateWorkInformation:month_of_to_date',
                            'claimDateWorkInformation:day_of_to_date',
                            'claimDateWorkInformation:year_of_to_date',
                        ],
                    ],
                ],
                '16d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateWorkInformation:month_of_to_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateWorkInformation:month_of_from_date',
                            'claimDateWorkInformation:day_of_from_date',
                            'claimDateWorkInformation:year_of_from_date',
                            'claimDateWorkInformation:month_of_to_date',
                            'claimDateWorkInformation:day_of_to_date',
                            'claimDateWorkInformation:year_of_to_date',
                        ],
                    ],
                ],
                '16e' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateWorkInformation:day_of_to_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateWorkInformation:month_of_from_date',
                            'claimDateWorkInformation:day_of_from_date',
                            'claimDateWorkInformation:year_of_from_date',
                            'claimDateWorkInformation:month_of_to_date',
                            'claimDateWorkInformation:day_of_to_date',
                            'claimDateWorkInformation:year_of_to_date',
                        ],
                    ],
                ],
                '16f' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateWorkInformation:year_of_to_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateWorkInformation:month_of_from_date',
                            'claimDateWorkInformation:day_of_from_date',
                            'claimDateWorkInformation:year_of_from_date',
                            'claimDateWorkInformation:month_of_to_date',
                            'claimDateWorkInformation:day_of_to_date',
                            'claimDateWorkInformation:year_of_to_date',
                        ],
                    ],
                ],
                '170' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'referredProviderRole:code',
                    ],
                    'values' => [
                        'common' => [
                            'referredProviderRole:code',
                            'providerProfile:first_name',
                            'providerProfile:middle_name',
                            'providerProfile:last_name',
                            'providerProfile:name_suffix',
                        ],
                    ],
                ],
                '171' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'glue' => ' ',
                    'value' => [
                        'providerProfile:first_name',
                        'providerProfile:middle_name',
                        'providerProfile:last_name',
                        'providerProfile:name_suffix',
                    ],
                    'values' => [
                        'common' => [
                            'referredProviderRole:code',
                            'providerProfile:first_name',
                            'providerProfile:middle_name',
                            'providerProfile:last_name',
                            'providerProfile:name_suffix',
                        ],
                    ],
                ],
                '17a0' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'providerProfile:qualifier',
                    ],
                    'values' => [
                        'common' => [
                            'providerProfile:qualifier',
                            'providerProfile:qualifierValue',
                            'providerProfile:npi',
                        ],
                    ],
                ],
                '17a1' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 17,
                    'value' => [
                        'providerProfile:qualifierValue',
                    ],
                    'values' => [
                        'common' => [
                            'providerProfile:qualifier',
                            'providerProfile:qualifierValue',
                            'providerProfile:npi',
                        ],
                    ],
                ],
                '17b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 10,
                    'value' => [
                        'providerProfile:npi',
                    ],
                    'values' => [
                        'common' => [
                            'providerProfile:qualifier',
                            'providerProfile:qualifierValue',
                            'providerProfile:npi',
                        ],
                    ],
                ],
                '18a' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateHospitalInformation:month_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateHospitalInformation:month_of_from_date',
                            'claimDateHospitalInformation:day_of_from_date',
                            'claimDateHospitalInformation:year_of_from_date',
                            'claimDateHospitalInformation:month_of_to_date',
                            'claimDateHospitalInformation:day_of_to_date',
                            'claimDateHospitalInformation:year_of_to_date',
                        ],
                    ],
                ],
                '18b' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateHospitalInformation:day_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateHospitalInformation:month_of_from_date',
                            'claimDateHospitalInformation:day_of_from_date',
                            'claimDateHospitalInformation:year_of_from_date',
                            'claimDateHospitalInformation:month_of_to_date',
                            'claimDateHospitalInformation:day_of_to_date',
                            'claimDateHospitalInformation:year_of_to_date',
                        ],
                    ],
                ],
                '18c' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateHospitalInformation:year_of_from_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateHospitalInformation:month_of_from_date',
                            'claimDateHospitalInformation:day_of_from_date',
                            'claimDateHospitalInformation:year_of_from_date',
                            'claimDateHospitalInformation:month_of_to_date',
                            'claimDateHospitalInformation:day_of_to_date',
                            'claimDateHospitalInformation:year_of_to_date',
                        ],
                    ],
                ],
                '18d' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateHospitalInformation:month_of_to_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateHospitalInformation:month_of_from_date',
                            'claimDateHospitalInformation:day_of_from_date',
                            'claimDateHospitalInformation:year_of_from_date',
                            'claimDateHospitalInformation:month_of_to_date',
                            'claimDateHospitalInformation:day_of_to_date',
                            'claimDateHospitalInformation:year_of_to_date',
                        ],
                    ],
                ],
                '18e' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateHospitalInformation:day_of_to_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateHospitalInformation:month_of_from_date',
                            'claimDateHospitalInformation:day_of_from_date',
                            'claimDateHospitalInformation:year_of_from_date',
                            'claimDateHospitalInformation:month_of_to_date',
                            'claimDateHospitalInformation:day_of_to_date',
                            'claimDateHospitalInformation:year_of_to_date',
                        ],
                    ],
                ],
                '18f' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'value' => 'claimDateHospitalInformation:year_of_to_date',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateHospitalInformation:month_of_from_date',
                            'claimDateHospitalInformation:day_of_from_date',
                            'claimDateHospitalInformation:year_of_from_date',
                            'claimDateHospitalInformation:month_of_to_date',
                            'claimDateHospitalInformation:day_of_to_date',
                            'claimDateHospitalInformation:year_of_to_date',
                        ],
                    ],
                ],
                '19' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 2,
                    'value' => [
                        'claimDateAdditionalInformation:month_of_from_date',
                        '|/',
                        'claimDateAdditionalInformation:day_of_from_date',
                        '|/',
                        'claimDateAdditionalInformation:year_of_from_date',
                        '| ',
                        'claimDateAdditionalInformation:month_of_to_date',
                        '|/',
                        'claimDateAdditionalInformation:day_of_to_date',
                        '|/',
                        'claimDateAdditionalInformation:year_of_to_date',
                        '| ',
                        'claimDateAdditionalInformation:description',
                    ],
                    'values' => [
                        'common' => [
                            'claimDateAdditionalInformation:month_of_from_date',
                            'claimDateAdditionalInformation:day_of_from_date',
                            'claimDateAdditionalInformation:year_of_from_date',
                            'claimDateAdditionalInformation:month_of_to_date',
                            'claimDateAdditionalInformation:day_of_to_date',
                            'claimDateAdditionalInformation:year_of_to_date',
                            'claimDateAdditionalInformation:description',
                        ],
                    ],
                ],
                '20a' => [
                    'type' => RuleType::BOOLEAN->value,
                    'value' => 'claimDemographicInformation:outside_lab',
                ],
                '20b' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDemographicInformation:charges',
                ],
                '21' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'demograficInformation:|0',
                ],
                '21A' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:A',
                ],
                '21B' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:B',
                ],
                '21C' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:C',
                ],
                '21D' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:D',
                ],
                '21E' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:E',
                ],
                '21F' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:F',
                ],
                '21G' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:G',
                ],
                '21H' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:H',
                ],
                '21I' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:I',
                ],
                '21J' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:J',
                ],
                '21K' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:K',
                ],
                '21L' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'claimDiagnosesCode:L',
                ],
                '22A' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'demograficInformation:|',
                ],
                '22B' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'demograficInformation:|',
                ],
                '23' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'demographicInformation:prior_authorization_number| ',
                ],
                '24' => [
                    'type' => RuleType::SINGLE_ARRAY->value,
                    'value' => 'claimProfessionalServices:24',
                ],
                '25A' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'company:federal_tax',
                ],
                '25B' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'company:federal_tax_value',
                ],
                '26' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'patientCompany:med_num',
                ],
                '27' => [
                    'type' => RuleType::BOOLEAN->value,
                    'value' => 'claimDemographicInformation:accept_assignment',
                ],
                '28' => [
                    'type' => RuleType::SINGLE_ARRAY->value,
                    'value' => 'claimServicesTotalKey:price',
                ],
                '29' => [
                    'type' => RuleType::SINGLE_ARRAY->value,
                    'value' => 'claimServicesTotalKey:copay',
                ],
                '31A' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'glue' => ' ',
                    'value' => [
                        'billingProviderProfile:first_name',
                        'billingProviderProfile:middle_name',
                        'billingProviderProfile:last_name',
                        'billingProviderProfile:name_suffix',
                    ],
                    'values' => [
                        'common' => [
                            'billingProviderProfile:first_name',
                            'billingProviderProfile:middle_name',
                            'billingProviderProfile:last_name',
                            'billingProviderProfile:name_suffix',
                        ],
                    ],
                ],
                '31B' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => '|Signature on File',
                ],
                '31C' => [
                    'type' => RuleType::SINGLE->value,
                    'value' => 'firstClaimService:from_service',
                ],
                '32A0' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'facility:name',
                    ],
                    'values' => [
                        'common' => [
                            'facility:name',
                            'facilityAddress:address',
                            'facilityAddress:city',
                            'facilityAddress:state',
                            'facilityAddress:zip',
                            'facility:npi',
                        ],
                    ],
                ],
                '32A1' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'facilityAddress:address|0',
                    ],
                    'values' => [
                        'common' => [
                            'facility:name',
                            'facilityAddress:address',
                            'facilityAddress:city',
                            'facilityAddress:state',
                            'facilityAddress:zip',
                            'facility:npi',
                        ],
                    ],
                ],
                '32A2' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'glue' => ' ',
                    'value' => [
                        'facilityAddress:city|0',
                        'facilityAddress:state|0',
                        'facilityAddress:zip|0',
                    ],
                    'values' => [
                        'common' => [
                            'facility:name',
                            'facilityAddress:address',
                            'facilityAddress:city',
                            'facilityAddress:state',
                            'facilityAddress:zip',
                            'facility:npi',
                        ],
                    ],
                ],
                '32A' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'facility:npi',
                    ],
                    'values' => [
                        'common' => [
                            'facility:name',
                            'facilityAddress:address',
                            'facilityAddress:city',
                            'facilityAddress:state',
                            'facilityAddress:zip',
                            'facility:npi',
                        ],
                    ],
                ],
                '33A0' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'company:name',
                    ],
                    'values' => [
                        'common' => [
                            'company:name',
                            'companyAddress:address',
                            'companyAddress:city',
                            'companyAddress:state',
                            'companyAddress:zip',
                            'companyContact:code_area',
                            'companyContact:phone',
                            'company:npi',
                        ],
                    ],
                ],
                '33A1' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'companyAddress:address|0',
                    ],
                    'values' => [
                        'common' => [
                            'company:name',
                            'companyAddress:address',
                            'companyAddress:city',
                            'companyAddress:state',
                            'companyAddress:zip',
                            'companyContact:code_area',
                            'companyContact:phone',
                            'company:npi',
                        ],
                    ],
                ],
                '33A2' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'glue' => ' ',
                    'value' => [
                        'companyAddress:city|0',
                        'companyAddress:state|0',
                        'companyAddress:zip|0',
                    ],
                    'values' => [
                        'common' => [
                            'company:name',
                            'companyAddress:address',
                            'companyAddress:city',
                            'companyAddress:state',
                            'companyAddress:zip',
                            'companyContact:code_area',
                            'companyContact:phone',
                            'company:npi',
                        ],
                    ],
                ],
                '33A3' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'companyContact:code_area|0',
                    ],
                    'values' => [
                        'common' => [
                            'company:name',
                            'companyAddress:address',
                            'companyAddress:city',
                            'companyAddress:state',
                            'companyAddress:zip',
                            'companyContact:code_area',
                            'companyContact:phone',
                            'company:npi',
                        ],
                    ],
                ],
                '33A3' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'companyContact:phone|0',
                    ],
                    'values' => [
                        'common' => [
                            'company:name',
                            'companyAddress:address',
                            'companyAddress:city',
                            'companyAddress:state',
                            'companyAddress:zip',
                            'companyContact:code_area',
                            'companyContact:phone',
                            'company:npi',
                        ],
                    ],
                ],
                '33A' => [
                    'type' => RuleType::MULTIPLE->value,
                    'length' => 20,
                    'value' => [
                        'company:npi',
                    ],
                    'values' => [
                        'common' => [
                            'company:name',
                            'companyAddress:address',
                            'companyAddress:city',
                            'companyAddress:state',
                            'companyAddress:zip',
                            'companyContact:code_area',
                            'companyContact:phone',
                            'company:npi',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'connections' => [
        'url_eligibility' => env('URL_ELIGIBILITY', 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3'),
        'url_validation' => env('URL_VALIDATION', 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/validation'),
        'url_submission' => env('URL_SUBMISSION', 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/submission'),
        'url_token' => env('URL_TOKEN', 'https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token'),
        'client_id' => env('CLIENT_ID', '7ULJqHZb91y2zP3lgD4xQ3A3jACdmPTF'),
        'client_secret' => env('CLIENT_SECRET', 'EBPadsDKoOuEoOWv'),
    ],
];
