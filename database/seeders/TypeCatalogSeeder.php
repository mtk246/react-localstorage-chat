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
            [
                'description' => 'File method',
                'type_catalogs' => [
                    [
                        'code' => 'P',
                        'description' => 'Paper'
                    ],
                    [
                        'code' => 'E',
                        'description' => 'Electronic'
                    ],
                    [
                        'code' => 'B',
                        'description' => 'Paper & Electronic'
                    ]
                ]
            ],
            [
                'description' => 'File method',
                'type_catalogs' => [
                    [
                        'code' => 'service_date',
                        'description' => 'A partir de la fecha de servicio'
                    ],
                    [
                        'code' => 'claim_date',
                        'description' => 'A partir de la generación del claim'
                    ]
                ]
            ],
            [
                'description' => 'Billing incomplete reasons',
                'type_catalogs' => [
                    [
                        'code' => '00001',
                        'description' => 'MISSING PATIENT DATE OF BIRTHDAY'
                    ],
                    [
                        'code' => '00002',
                        'description' => 'MISSING HOSPITAL ADMIT DATE'
                    ],
                    [
                        'code' => '00003',
                        'description' => 'MISSING OR DELETED DIAGNOSIS'
                    ],
                    [
                        'code' => '00004',
                        'description' => 'AUTHORIZED QUANTITY EXCEEDED'
                    ],
                    [
                        'code' => '00005',
                        'description' => 'MISSING SEX IN PATIENT RECORD'
                    ],
                    [
                        'code' => '00006',
                        'description' => 'MISSING LAST NAME IN PATIENT'
                    ],
                    [
                        'code' => '00007',
                        'description' => 'MISSING ZIP CODE IN PATIENT'
                    ],
                    [
                        'code' => '00008',
                        'description' => 'MISSING PLACE OF SERVICE'
                    ],
                    [
                        'code' => '00009',
                        'description' => 'MISSING TYPE OF SERVICE'
                    ],
                    [
                        'code' => '00010',
                        'description' => 'AUTHORIZATION REQUIRED'
                    ],
                    [
                        'code' => '00011',
                        'description' => 'MISSING ACCIDENT DATE ON CLAIM'
                    ],
                    [
                        'code' => '00012',
                        'description' => 'MISSING PHYSICIAN'S PROVIDER'
                    ],
                    [
                        'code' => '00013',
                        'description' => 'PENDING INSURANCE INFORMATION'
                    ],
                    [
                        'code' => '00014',
                        'description' => 'CHANGE HELD BY HOLD FLAG'
                    ],
                    [
                        'code' => '00015',
                        'description' => 'REQUIRED APPLICATION DATA'
                    ],
                    [
                        'code' => '00016',
                        'description' => 'MISSING CLIA NUMBER FOR LAB'
                    ],
                    [
                        'code' => '00017',
                        'description' => 'MISSING PATIENT POLICY NUMBER'
                    ],
                    [
                        'code' => '00018',
                        'description' => 'MISSING PATIENT INSURANACE'
                    ],
                    [
                        'code' => '00019',
                        'description' => 'MISSING PLACE OF SERVICE'
                    ],
                    [
                        'code' => '00020',
                        'description' => 'MISSING UPIN FOR REFERRING'
                    ],
                    [
                        'code' => '00021',
                        'description' => 'UNASSIGNED PATIENT'
                    ],
                    [
                        'code' => '00022',
                        'description' => 'DOCTOR IS NOT CONTRACTED'
                    ],
                    [
                        'code' => '00023',
                        'description' => 'MISSING ALPHA ON PATIENT POLICY'
                    ],
                    [
                        'code' => '00024',
                        'description' => 'INVALID PATIENT POLICY'
                    ],
                    [
                        'code' => '00025',
                        'description' => 'ACCIDENT DIAGNOSIS CODE REQ'
                    ],
                    [
                        'code' => '00026',
                        'description' => 'MISSING INSURED ADDRESS'
                    ],
                    [
                        'code' => '00027',
                        'description' => 'DIAGNOSIS SEX DOES NOT MATCH'
                    ],
                    [
                        'code' => '00028',
                        'description' => 'PROCEDURE SEX DOES NOT MATCH'
                    ],
                    [
                        'code' => '00029',
                        'description' => 'MISSING REFERRING THYSICIAN'S'
                    ],
                    [
                        'code' => '00030',
                        'description' => 'MISSING CONDITION DATE'
                    ],
                    [
                        'code' => '00031',
                        'description' => 'MISSING VALUE CODE/AMOUNT'
                    ],
                    [
                        'code' => '00032',
                        'description' => 'MISSING UPIN# IN SCHED/OTH'
                    ],
                    [
                        'code' => '00033',
                        'description' => 'IMPUT ERRORS'
                    ],
                    [
                        'code' => '00034',
                        'description' => 'PROCEDURE CODE AGE LIMITATION'
                    ],
                    [
                        'code' => '00035',
                        'description' => 'OUT OF NETWORK'
                    ],
                    [
                        'code' => '00036',
                        'description' => 'MISSING INSURED DOB OR SEX'
                    ],
                    [
                        'code' => '00037',
                        'description' => 'MISSING INSURANCE /PLAN'
                    ],
                    [
                        'code' => '00038',
                        'description' => 'MISSING SERVICE PHYSICIAN OR'
                    ],
                    [
                        'code' => '00039',
                        'description' => 'MISSING LICENCE NO FOR CERVICE'
                    ],
                    [
                        'code' => '00040',
                        'description' => 'MISSING DOCUMENTATION FOR'
                    ],
                    [
                        'code' => '00041',
                        'description' => 'AUTHORIZATION/ACCESS RESTRICCTIONS'
                    ],
                    [
                        'code' => '00042',
                        'description' => 'UNABLE TO RESPOND AT CURRENT TIME'
                    ],
                    [
                        'code' => '00043',
                        'description' => 'INVELID/MISSING PROVIDER IDENTIFICATION'
                    ],
                    [
                        'code' => '00044',
                        'description' => 'INVALID/MISSING PROVIDER NAME'
                    ],
                    [
                        'code' => '00045',
                        'description' => 'INVALID/MISSING PROVIDER SPECIALTY'
                    ],
                    [
                        'code' => '00046',
                        'description' => 'INVALID/MISSING PROVIDER PHONE NUMBER'
                    ],
                    [
                        'code' => '00047',
                        'description' => 'INVALID/MISSING PROVIDER STATE'
                    ],
                    [
                        'code' => '00048',
                        'description' => 'INVALID/MISSING REFERRING PROVIDER IDENTIFICATION NUMBER'
                    ],
                    [
                        'code' => '00049',
                        'description' => 'PROVIDER NOT PRIMARY CARE PHYSICIAN'
                    ],
                    [
                        'code' => '00050',
                        'description' => 'PROVIDER INELIGIBLE FOR INQUIRIES'
                    ],
                    [
                        'code' => '00051',
                        'description' => 'PROVIDER NOT ON FILE'
                    ],
                    [
                        'code' => '00052',
                        'description' => 'SERVICE DATE NOT WITHIN PROVIDER PLAN ENROLLMENT'
                    ],
                    [
                        'code' => '00053',
                        'description' => 'INQUIRED BENEFIT INCONSISTENT WITH PROVIDER TYPE'
                    ],
                    [
                        'code' => '00054',
                        'description' => 'INAPPROPRIATE PRODUCT/SERVICE ID QUALIFIER'
                    ],
                    [
                        'code' => '00055',
                        'description' => 'INAPPROPRIATE PRODUCT/SERVICE ID '
                    ],
                    [
                        'code' => '00056',
                        'description' => 'INAPPROPRIATE DATE'
                    ],
                    [
                        'code' => '00057',
                        'description' => 'INVALID/MISSING DOS'
                    ],
                    [
                        'code' => '00058',
                        'description' => 'INVALID/MISSING DATE-OF-BIRTH (DOB)'
                    ],
                    [
                        'code' => '00059',
                        'description' => 'INVALID/MISSING DAT OF DEATH'
                    ],
                    [
                        'code' => '00060',
                        'description' => 'DATE OF BIRTH FOLLOWS DATE(S) OF SERVICE'
                    ],
                    [
                        'code' => '00061',
                        'description' => 'DATE OF DEATH PRECEDES DATE(S) OF SERVICE'
                    ],
                    [
                        'code' => '00062',
                        'description' => 'DOS NOT WITHIN ALLOWABLE INQUIRY PERIOD'
                    ],
                    [
                        'code' => '00063',
                        'description' => 'DOS IN THE FUTURE'
                    ],
                    [
                        'code' => '00064',
                        'description' => 'INVALID/MISSING PATIENT ID'
                    ],
                    [
                        'code' => '00065',
                        'description' => 'INVALID/MISSING PATIENT NAME'
                    ],
                    [
                        'code' => '00066',
                        'description' => 'INVALID/MISSING PATIENT GENDER CODE'
                    ],
                    [
                        'code' => '00067',
                        'description' => 'PATIENT NOT FOUND'
                    ],
                    [
                        'code' => '00068',
                        'description' => 'DUPLICATE PATIENT ID NUMBER'
                    ],
                    [
                        'code' => '00069',
                        'description' => 'INCONSISTENT WITH PATIENT'S AGE'
                    ],
                    [
                        'code' => '00070',
                        'description' => 'INCONSISTENT WITH PATIENT'S GENDER'
                    ],
                    [
                        'code' => '00071',
                        'description' => 'PATIENT BIRTH DATE DOES NOT MATCH THAT FOR  THE PATIENT ON THE DATABASE'
                    ],
                    [
                        'code' => '00072',
                        'description' => 'INVALID/MISSING SUBSCRIBER/INSURED ID'
                    ],
                    [
                        'code' => '00073',
                        'description' => 'INVALID/MISSING SUBSCRIBER/INSURED NAME'
                    ],
                    [
                        'code' => '00074',
                        'description' => 'INVALID/MISSING SUBSCRIBER/INSURED GENDER CODE'
                    ],
                    [
                        'code' => '00075',
                        'description' => 'SUBSCRIBER/INSURED NOT FOUND'
                    ],
                    [
                        'code' => '00076',
                        'description' => 'DUPLICATE SUBSCRIBER/INSURED ID NUMBER'
                    ],
                    [
                        'code' => '00077',
                        'description' => 'SUBSCRIBER FOUND: PATIENT NOT FOUND'
                    ],
                    [
                        'code' => '00078',
                        'description' => 'SUBSCRIBER /INSURED NOT IN GROUP/PLAN IDENTIFIED'
                    ],
                    [
                        'code' => '00079',
                        'description' => 'INVALID PARTICIPANT IDENTIFICATION'
                    ],
                    [
                        'code' => '00080',
                        'description' => 'NO RESPONSE RECEIVED - TRANSACTION TERMINATED'
                    ],
                    [
                        'code' => 'AF',
                        'description' => 'INVALID/MISSING DIAGNOSES CODE(S)'
                    ],
                    [
                        'code' => 'AG',
                        'description' => 'INVALID/MISSING PROCEDURE CODE(S)'
                    ],
                    [
                        'code' => 'IA',
                        'description' => 'INVALID AUTHORIZATION NUMBER FORMAT'
                    ],
                    [
                        'code' => 'MA',
                        'description' => 'MISSING AUTHORIZATION NUMBER'
                    ],
                    [
                        'code' => 'T4',
                        'description' => 'PAYER NAME OR IDENTIFIER MISSING'
                    ],
                    [
                        'code' => '00081',
                        'description' => 'MISSING VALUE CODE AND VALUE'
                    ],
                    [
                        'code' => '00082',
                        'description' => 'MISSING ADMISSION HOUR'
                    ],
                    [
                        'code' => '00083',
                        'description' => 'REFERRING PHYSICIAN NAME'
                    ],
                    [
                        'code' => '00084',
                        'description' => 'MISSING CLAIM SCRUBBER INFO'
                    ],
                    [
                        'code' => '00085',
                        'description' => 'REFERRING PHYSICIAN PCN'
                    ],
                    [
                        'code' => '00086',
                        'description' => 'MISSING OR INCORRECT RENDER'
                    ],
                    [
                        'code' => '00087',
                        'description' => 'MISSING OR INCORRECT PAYTO'
                    ],
                    [
                        'code' => '00088',
                        'description' => 'MISSING OR INCORRECT REFERRING'
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
