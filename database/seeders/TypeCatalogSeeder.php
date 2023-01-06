<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\TypeCatalog;

class TypeCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'description' => 'Ins type',
                'type_catalogs' => [
                    [
                        'code' => 'AETNA',
                        'description' => 'Aetna'
                    ],
                    [
                        'code' => 'AUTO',
                        'description' => 'Automobile Insurance'
                    ],
                    [
                        'code' => 'BCBS',
                        'description' => 'Blue Cross an Blue Shield'
                    ],
                    [
                        'code' => 'CA',
                        'description' => 'Capitation'
                    ],
                    [
                        'code' => 'CIGNA',
                        'description' => 'Cigna'
                    ],
                    [
                        'code' => 'COMMERCIAL',
                        'description' => 'Commercial Insurance'
                    ],
                    [
                        'code' => 'MEDICAID',
                        'description' => 'Medicaid'
                    ],
                    [
                        'code' => 'MEDICARE',
                        'description' => 'Medicare'
                    ],
                    [
                        'code' => 'UHC',
                        'description' => 'United Health Care'
                    ],
                    [
                        'code' => 'WORKCOMP',
                        'description' => 'Workers Compensation'
                    ]
                ]
            ],
            [
                'description' => 'Insurance plan type',
                'type_catalogs' => [
                    [
                        'code' => 'HMO',
                        'description' => 'Health Maintenance Organization'
                    ],
                    [
                        'code' => 'PPO',
                        'description' => 'Preferred Provider Organization'
                    ],
                    [
                        'code' => 'EPO',
                        'description' => 'Exclusive Provider Organization'
                    ],
                    [
                        'code' => 'HDHP',
                        'description' => 'High Deductible Health Plan'
                    ],
                    [
                        'code' => 'HSA',
                        'description' => 'Health Savings Accounts'
                    ],
                ]
            ],
            [
                'description' => 'Time failed',
                'type_catalogs' => [
                    [
                        'code' => '7',
                        'description' => '7 DIAS'
                    ],
                    [
                        'code' => '15',
                        'description' => '15 DIAS'
                    ],
                    [
                        'code' => '30',
                        'description' => '30 DIAS'
                    ],
                    [
                        'code' => '45',
                        'description' => '45 DIAS'
                    ],
                    [
                        'code' => '60',
                        'description' => '60 DIAS'
                    ],
                    [
                        'code' => '90',
                        'description' => '90 DIAS'
                    ],
                ]
            ],
            [
                'description' => 'Insurance policy type',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Health'
                    ],
                    [
                        'code' => '2',
                        'description' => 'Auto'
                    ],
                    [
                        'code' => '3',
                        'description' => 'Work Comp'
                    ],
                    [
                        'code' => 'I',
                        'description' => 'Industrial'
                    ],
                    [
                        'code' => 'L',
                        'description' => 'Liability'
                    ],
                    [
                        'code' => 'O',
                        'description' => 'Other'
                    ],
                ]

            ],
            [
                'description' => 'Patient relationship',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Self/Patient is Insured'
                    ],
                    [
                        'code' => '2',
                        'description' => 'Spouse'
                    ],
                    [
                        'code' => '3',
                        'description' => 'Natural Child/Insured Financial Resp.'
                    ],
                    [
                        'code' => '4',
                        'description' => 'Natural Child/Insured no Financial Resp.'
                    ],
                    [
                        'code' => '5',
                        'description' => 'Step Child'
                    ],
                    [
                        'code' => '6',
                        'description' => 'Foster Child'
                    ],
                    [
                        'code' => '7',
                        'description' => 'Ward of the Court'
                    ],
                    [
                        'code' => '8',
                        'description' => 'Employee'
                    ],
                    [
                        'code' => '9',
                        'description' => 'Other'
                    ],
                    [
                        'code' => '10',
                        'description' => 'Handicapped Dependent'
                    ],
                    [
                        'code' => '11',
                        'description' => 'Organ Donor'
                    ],
                    [
                        'code' => '12',
                        'description' => 'Cadaver Donor'
                    ],
                    [
                        'code' => '13',
                        'description' => 'Grandchild'
                    ],
                    [
                        'code' => '14',
                        'description' => 'Nice/Nephew'
                    ],
                    [
                        'code' => '15',
                        'description' => 'Injured Plaintiff'
                    ],
                    [
                        'code' => '16',
                        'description' => 'Sponsored Dependent'
                    ],
                    [
                        'code' => '17',
                        'description' => 'Minor Dependent of a Minor Dependent'
                    ],
                    [
                        'code' => '18',
                        'description' => 'Parent'
                    ],
                    [
                        'code' => '19',
                        'description' => 'Granparent'
                    ],
                ]
            ],
            [
                'description' => 'Responsibility type',
                'type_catalogs' => [
                    [
                        'code' => 'R1',
                        'description' => 'Responsibility type 1'
                    ],
                    [
                        'code' => 'R2',
                        'description' => 'Responsibility type 2'
                    ]
                ]
            ],
        ];

        foreach ($types as $type) {
            $typeC = Type::updateOrCreate(
                ['description' => $type['description']],
                ['description' => $type['description']]
            );

            if (isset($type['type_catalogs'])) {
                foreach ($type['type_catalogs'] as $typeCatalog) {
                    TypeCatalog::updateOrCreate(
                        [
                            'code'        => $typeCatalog['code'],
                            'description' => $typeCatalog['description'],
                            'type_id'     => $typeC->id
                        ],
                        [
                            'code'        => $typeCatalog['code'],
                            'description' => $typeCatalog['description']
                        ]
                    );
                }
            }
        }
    }
}
