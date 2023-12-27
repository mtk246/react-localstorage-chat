<?php

declare(strict_types=1);

return [
    'denial' => [
        'refile' => [
            'store' => [
                'note' => 'Refile Type: :refile_type successfully completed, claim assigned to :status-:sub_status',
            ],
        ],
    ],
    'rules' => [
        'file' => [
            'group' => [
                1 => [
                    'title' => 'Main Company',
                    'a' => 'Company Name',
                ],
                2 => [
                    'title' => 'Secondary Company',
                ],
                3 => [
                    'title' => 'Claim Information',
                ],
                6 => [
                    'title' => 'Service Date',
                ],
                8 => [
                    'title' => 'Patient',
                ],
                9 => [
                    'title' => 'Admission Address',
                ],
                20 => [
                    'title' => 'Demographic Information',
                ],
                31 => [
                    'title' => 'Occurrence',
                ],
                32 => [
                    'title' => 'Occurrence',
                ],
                33 => [
                    'title' => 'Occurrence',
                ],
                34 => [
                    'title' => 'Occurrence',
                ],
                35 => [
                    'title' => 'Occurrence Span',
                ],
                36 => [
                    'title' => 'Occurrence Span',
                ],
                38 => [
                    'title' => 'Higher Insurance Company',
                ],
                39 => [
                    'title' => 'Value Codes',
                ],
                40 => [
                    'title' => 'Value Codes',
                ],
                41 => [
                    'title' => 'Value Codes',
                ],
                57 => [
                    'title' => 'Company',
                ],
                76 => [
                    'title' => 'Health Professional Attending',
                ],
                77 => [
                    'title' => 'Health Professional Operating',
                ],
                78 => [
                    'title' => 'Health Professional Other',
                ],
                79 => [
                    'title' => 'Health Professional Other',
                ],
                't' => [
                    'title' => 'Totals',
                    'group' => [
                        'b' => ['title' => 'page'],
                    ],
                ],
            ],
        ],
        'json' => [
            'group' => [
                'submitter' => [
                    'title' => 'Submitter',
                    'group' => [
                        'contactInformation' => ['title' => 'Contact Information'],
                    ],
                ],
                'receiver' => [
                    'title' => 'Receiver organization',
                ],
                'subscriber' => [
                    'title' => 'Subscriber',
                    'group' => [
                        'contactInformation' => ['title' => 'Contact Information'],
                        'address' => ['title' => 'Addresses'],
                    ],
                ],
                'dependent' => [
                    'title' => 'Dependent',
                    'group' => [
                        'contactInformation' => ['title' => 'Contact Information'],
                        'address' => ['title' => 'Addresses'],
                    ],
                ],
                'claimInformation' => [
                    'title' => 'Claim Information',
                    'group' => [
                        'claimInformation' => ['title' => 'Claim Information'],
                        'claimDates' => ['title' => 'Claim Dates'],
                        'claimAmounts' => ['title' => 'Claim Amounts'],
                        'claimSupplementalInformation' => ['title' => 'Claim Supplemental Information'],
                    ],
                ],
                'payToAddress' => [
                    'title' => 'Pay To Address',
                ],
            ],
        ],
    ],
];
