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
        ClaimType::PROFESSIONAL->getName() => [
            'file' => [
                'group' => [
                    0 => ['title' => 'Higher insurance company'],
                    1 => ['title' => 'Insurance company'],
                    3 => ['title' => 'Patient information'],
                    5 => ['title' => 'Patient address'],
                    7 => ['title' => 'Insured Information'],
                    9 => ['title' => 'Secondary policy Information'],
                    10 => ['title' => 'Phatient condition related to'],
                    11 => ['title' => 'Insured policy group'],
                    12 => ['title' => 'Patient signature on file'],
                    13 => ['title' => 'Insured signature on file'],
                    14 => ['title' => 'Date of current illness'],
                    15 => ['title' => 'Other date'],
                    16 => ['title' => 'Dates patien unable to work'],
                    17 => ['title' => 'Name of referrin provider'],
                    18 => ['title' => 'Hospitalization dates related to'],
                    19 => ['title' => 'Additional claim information'],
                    20 => ['title' => 'Outside lab'],
                    21 => ['title' => 'Diagnosis or nature of illness'],
                    22 => ['title' => 'Resubmission'],
                    23 => ['title' => 'Prior authorization'],
                    24 => ['title' => 'Line item control number'],
                    25 => ['title' => 'Federal tax ID number'],
                    31 => ['title' => 'Signature of provider'],
                    32 => ['title' => 'Service facility location'],
                    33 => ['title' => 'Billing provider information'],
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
    ],
];
