<?php

declare(strict_types=1);

use App\Enums\Claim\ClaimType;

return [
    'denial' => [
        'refile' => [
            'store' => [
                'note' => 'Refile Type: :refile_type successfully completed, claim assigned to :status-:sub_status',
            ],
        ],
    ],
    'rules' => [
        ClaimType::INSTITUTIONAL->getName() => [
            'group' => [
                1 => 'Main Company',
                2 => 'Secondary Company',
                3 => 'Claim Information',
                6 => 'Service Date',
                8 => 'Patient',
                9 => 'Admission Address',
                31 => 'Occurrence',
                32 => 'Occurrence',
                33 => 'Occurrence',
                34 => 'Occurrence',
                35 => 'Occurrence Span',
                36 => 'Occurrence Span',
                38 => 'Higher Insurance Company',
                39 => 'Value Codes',
                40 => 'Value Codes',
                41 => 'Value Codes',
                76 => 'Health Professional Attending',
                77 => 'Health Professional Operating',
                78 => 'Health Professional Other',
                79 => 'Health Professional Other',
            ],
        ],
    ],
];
