<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PrivateNote;
use App\Models\Type;
use App\Models\TypeCatalog;
use Illuminate\Database\Seeder;

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
                        'code' => 'CI',
                        'description' => 'Commercial Insurance',
                    ],
                    [
                        'code' => 'BL',
                        'description' => 'Blue Cross/Blue Shield',
                    ],
                    [
                        'code' => 'MED',
                        'description' => 'Medicare',
                    ],
                    [
                        'code' => 'MCE',
                        'description' => 'Medicaid',
                    ],
                    [
                        'code' => 'TR',
                        'description' => 'TRICARE',
                    ],
                    [
                        'code' => 'CH',
                        'description' => 'Champus',
                    ],
                    [
                        'code' => 'GHP',
                        'description' => 'GROUP HEALTH PLAN',
                    ],
                    [
                        'code' => 'FBL',
                        'description' => 'FEDERAL BLACK LUNG',
                    ],
                    [
                        'code' => 'OT',
                        'description' => 'Other',
                    ],
                ],
            ],
            [
                'description' => 'Insurance plan type',
                'type_catalogs' => [
                    [
                        'code' => 'CHIP',
                        'description' => "Children's Health Insurance Program",
                    ],
                    [
                        'code' => 'HMO',
                        'description' => 'Health Maintenance Organization',
                    ],
                    [
                        'code' => 'PPO',
                        'description' => 'Preferred Provider Organization',
                    ],
                    [
                        'code' => 'EPO',
                        'description' => 'Exclusive Provider Organization',
                    ],
                    [
                        'code' => 'POS',
                        'description' => 'Point of service',
                    ],
                    [
                        'code' => 'HDHP',
                        'description' => 'High Deductible Health Plan',
                    ],
                    [
                        'code' => 'HSA',
                        'description' => 'Health Savings Accounts',
                    ],
                    [
                        'code' => 'HRA',
                        'description' => 'Health Reimbursement Arrangement',
                    ],
                    [
                        'code' => 'MEDICAID',
                        'description' => 'Medical Managed Care Plans',
                    ],
                    [
                        'code' => 'MEDICARE',
                        'description' => 'Medicare Advantage Plans',
                    ],
                    [
                        'code' => 'OT',
                        'description' => 'Other',
                    ],
                ],
            ],
            [
                'description' => 'Insurance plan formats',
                'type_catalogs' => [
                    [
                        'code' => 'Standard',
                        'description' => 'Standard',
                    ],
                ],
            ],
            [
                'description' => 'Contract fee type',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Diagnosis Related Group (DRG)',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Per Diem',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Variable Per Diem',
                    ],
                    [
                        'code' => '4',
                        'description' => 'Flat',
                    ],
                    [
                        'code' => '5',
                        'description' => 'Capitated',
                    ],
                    [
                        'code' => '6',
                        'description' => 'Percent',
                    ],
                    [
                        'code' => '9',
                        'description' => 'Other',
                    ],
                ],
            ],
            [
                'description' => 'Time failed',
                'type_catalogs' => [
                    [
                        'code' => '7',
                        'description' => '7 Dias',
                    ],
                    [
                        'code' => '15',
                        'description' => '15 Dias',
                    ],
                    [
                        'code' => '30',
                        'description' => '30 Dias',
                    ],
                    [
                        'code' => '45',
                        'description' => '45 Dias',
                    ],
                    [
                        'code' => '60',
                        'description' => '60 Dias',
                    ],
                    [
                        'code' => '90',
                        'description' => '90 Dias',
                    ],
                ],
            ],
            [
                'description' => 'Insurance policy type',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Health',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Auto',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Work Comp',
                    ],
                    [
                        'code' => 'I',
                        'description' => 'Industrial',
                    ],
                    [
                        'code' => 'L',
                        'description' => 'Liability',
                    ],
                    [
                        'code' => 'O',
                        'description' => 'Other',
                    ],
                ],
            ],
            [
                'description' => 'Patient relationship',
                'type_catalogs' => [
                    [
                        'code' => '01',
                        'description' => 'Spouse',
                    ],
                    [
                        'code' => '19',
                        'description' => 'Child',
                    ],
                    [
                        'code' => '20',
                        'description' => 'Employee',
                    ],
                    [
                        'code' => '21',
                        'description' => 'Unknown',
                    ],
                    [
                        'code' => '39',
                        'description' => 'Organ Donor',
                    ],
                    [
                        'code' => '40',
                        'description' => 'Cadaver Donor',
                    ],
                    [
                        'code' => '53',
                        'description' => 'Life Partner',
                    ],
                    [
                        'code' => 'G8',
                        'description' => 'Other relationship',
                    ],
                ],
            ],
            [
                'description' => 'Responsibility type',
                'type_catalogs' => [
                    [
                        'code' => 'P',
                        'description' => 'Primary',
                    ],
                    [
                        'code' => 'S',
                        'description' => 'Secondary',
                    ],
                    [
                        'code' => 'T',
                        'description' => 'Tertiary',
                    ],
                    [
                        'code' => 'A',
                        'description' => 'Payer Responsibility Four',
                    ],
                    [
                        'code' => 'B',
                        'description' => 'Payer Responsibility Five',
                    ],
                    [
                        'code' => 'C',
                        'description' => 'Payer Responsibility Six',
                    ],
                    [
                        'code' => 'D',
                        'description' => 'Payer Responsibility Seven',
                    ],
                    [
                        'code' => 'E',
                        'description' => 'Payer Responsibility Eight',
                    ],
                    [
                        'code' => 'F',
                        'description' => 'Payer Responsibility Nine',
                    ],
                    [
                        'code' => 'G',
                        'description' => 'Payer Responsibility Ten',
                    ],
                    [
                        'code' => 'H',
                        'description' => 'Payer Responsibility Eleven',
                    ],
                    [
                        'code' => 'U',
                        'description' => 'Unknow',
                    ],
                ],
            ],
            [
                'description' => 'File method',
                'type_catalogs' => [
                    [
                        'code' => 'P',
                        'description' => 'Paper',
                    ],
                    [
                        'code' => 'E',
                        'description' => 'Electronic',
                    ],
                    [
                        'code' => 'B',
                        'description' => 'Paper & Electronic',
                    ],
                ],
            ],
            [
                'description' => 'From',
                'type_catalogs' => [
                    [
                        'code' => 'service_date',
                        'description' => 'Service',
                    ],
                    [
                        'code' => 'claim_date',
                        'description' => 'Claim generation',
                    ],
                ],
            ],
            [
                'description' => 'Billing incomplete reasons',
                'type_catalogs' => [
                    [
                        'code' => '00001',
                        'description' => 'Missing patient date of birthday',
                    ],
                    [
                        'code' => '00002',
                        'description' => 'Missing hospital admit date',
                    ],
                    [
                        'code' => '00003',
                        'description' => 'Missing or deleted diagnosis',
                    ],
                    [
                        'code' => '00004',
                        'description' => 'Authorized quantity exceeded',
                    ],
                    [
                        'code' => '00005',
                        'description' => 'Missing sex in patient record',
                    ],
                    [
                        'code' => '00006',
                        'description' => 'Missing last name in patient',
                    ],
                    [
                        'code' => '00007',
                        'description' => 'Missing zip code in patient',
                    ],
                    [
                        'code' => '00008',
                        'description' => 'Missing place of service',
                    ],
                    [
                        'code' => '00009',
                        'description' => 'Missing type of service',
                    ],
                    [
                        'code' => '00010',
                        'description' => 'Authorization required',
                    ],
                    [
                        'code' => '00011',
                        'description' => 'Missing accident date on claim',
                    ],
                    [
                        'code' => '00012',
                        'description' => "Missing physician's provider",
                    ],
                    [
                        'code' => '00013',
                        'description' => 'Pending insurance information',
                    ],
                    [
                        'code' => '00014',
                        'description' => 'Change held by hold flag',
                    ],
                    [
                        'code' => '00015',
                        'description' => 'Required application data',
                    ],
                    [
                        'code' => '00016',
                        'description' => 'Missing clia number for lab',
                    ],
                    [
                        'code' => '00017',
                        'description' => 'Missing patient policy number',
                    ],
                    [
                        'code' => '00018',
                        'description' => 'Missing patient insuranace',
                    ],
                    [
                        'code' => '00019',
                        'description' => 'Missing place of service',
                    ],
                    [
                        'code' => '00020',
                        'description' => 'Missing upin for referring',
                    ],
                    [
                        'code' => '00021',
                        'description' => 'Unassigned patient',
                    ],
                    [
                        'code' => '00022',
                        'description' => 'Doctor is not contracted',
                    ],
                    [
                        'code' => '00023',
                        'description' => 'Missing alpha on patient policy',
                    ],
                    [
                        'code' => '00024',
                        'description' => 'Invalid patient policy',
                    ],
                    [
                        'code' => '00025',
                        'description' => 'Accident diagnosis code req',
                    ],
                    [
                        'code' => '00026',
                        'description' => 'Missing insured address',
                    ],
                    [
                        'code' => '00027',
                        'description' => 'Diagnosis sex does not match',
                    ],
                    [
                        'code' => '00028',
                        'description' => 'Procedure sex does not match',
                    ],
                    [
                        'code' => '00029',
                        'description' => "Missing referring thysician's",
                    ],
                    [
                        'code' => '00030',
                        'description' => 'Missing condition date',
                    ],
                    [
                        'code' => '00031',
                        'description' => 'Missing value code/amount',
                    ],
                    [
                        'code' => '00032',
                        'description' => 'Missing upin# in sched/oth',
                    ],
                    [
                        'code' => '00033',
                        'description' => 'Imput errors',
                    ],
                    [
                        'code' => '00034',
                        'description' => 'Procedure code age limitation',
                    ],
                    [
                        'code' => '00035',
                        'description' => 'Out of network',
                    ],
                    [
                        'code' => '00036',
                        'description' => 'Missing insured dob or sex',
                    ],
                    [
                        'code' => '00037',
                        'description' => 'Missing insurance /plan',
                    ],
                    [
                        'code' => '00038',
                        'description' => 'Missing service physician or',
                    ],
                    [
                        'code' => '00039',
                        'description' => 'Missing licence no for cervice',
                    ],
                    [
                        'code' => '00040',
                        'description' => 'Missing documentation for',
                    ],
                    [
                        'code' => '00041',
                        'description' => 'Authorization/access restricctions',
                    ],
                    [
                        'code' => '00042',
                        'description' => 'Unable to respond at current time',
                    ],
                    [
                        'code' => '00043',
                        'description' => 'Invelid/missing provider identification',
                    ],
                    [
                        'code' => '00044',
                        'description' => 'Invalid/missing provider name',
                    ],
                    [
                        'code' => '00045',
                        'description' => 'Invalid/missing provider specialty',
                    ],
                    [
                        'code' => '00046',
                        'description' => 'Invalid/missing provider phone number',
                    ],
                    [
                        'code' => '00047',
                        'description' => 'Invalid/missing provider state',
                    ],
                    [
                        'code' => '00048',
                        'description' => 'Invalid/missing referring provider identification number',
                    ],
                    [
                        'code' => '00049',
                        'description' => 'Provider not primary care physician',
                    ],
                    [
                        'code' => '00050',
                        'description' => 'Provider ineligible for inquiries',
                    ],
                    [
                        'code' => '00051',
                        'description' => 'Provider not on file',
                    ],
                    [
                        'code' => '00052',
                        'description' => 'Service date not within provider plan enrollment',
                    ],
                    [
                        'code' => '00053',
                        'description' => 'Inquired benefit inconsistent with provider type',
                    ],
                    [
                        'code' => '00054',
                        'description' => 'Inappropriate product/service id qualifier',
                    ],
                    [
                        'code' => '00055',
                        'description' => 'Inappropriate product/service id ',
                    ],
                    [
                        'code' => '00056',
                        'description' => 'Inappropriate date',
                    ],
                    [
                        'code' => '00057',
                        'description' => 'Invalid/missing dos',
                    ],
                    [
                        'code' => '00058',
                        'description' => 'Invalid/missing date-of-birth (dob)',
                    ],
                    [
                        'code' => '00059',
                        'description' => 'Invalid/missing dat of death',
                    ],
                    [
                        'code' => '00060',
                        'description' => 'Date of birth follows date(s) of service',
                    ],
                    [
                        'code' => '00061',
                        'description' => 'Date of death precedes date(s) of service',
                    ],
                    [
                        'code' => '00062',
                        'description' => 'Dos not within allowable inquiry period',
                    ],
                    [
                        'code' => '00063',
                        'description' => 'Dos in the future',
                    ],
                    [
                        'code' => '00064',
                        'description' => 'Invalid/missing patient id',
                    ],
                    [
                        'code' => '00065',
                        'description' => 'Invalid/missing patient name',
                    ],
                    [
                        'code' => '00066',
                        'description' => 'Invalid/missing patient gender code',
                    ],
                    [
                        'code' => '00067',
                        'description' => 'Patient not found',
                    ],
                    [
                        'code' => '00068',
                        'description' => 'Duplicate patient id number',
                    ],
                    [
                        'code' => '00069',
                        'description' => "Inconsistent with patient's age",
                    ],
                    [
                        'code' => '00070',
                        'description' => "Inconsistent with patient's gender",
                    ],
                    [
                        'code' => '00071',
                        'description' => 'Patient birth date does not match that for  the patient on the database',
                    ],
                    [
                        'code' => '00072',
                        'description' => 'Invalid/missing subscriber/insured id',
                    ],
                    [
                        'code' => '00073',
                        'description' => 'Invalid/missing subscriber/insured name',
                    ],
                    [
                        'code' => '00074',
                        'description' => 'Invalid/missing subscriber/insured gender code',
                    ],
                    [
                        'code' => '00075',
                        'description' => 'Subscriber/insured not found',
                    ],
                    [
                        'code' => '00076',
                        'description' => 'Duplicate subscriber/insured id number',
                    ],
                    [
                        'code' => '00077',
                        'description' => 'Subscriber found: patient not found',
                    ],
                    [
                        'code' => '00078',
                        'description' => 'Subscriber /insured not in group/plan identified',
                    ],
                    [
                        'code' => '00079',
                        'description' => 'Invalid participant identification',
                    ],
                    [
                        'code' => '00080',
                        'description' => 'No response received - transaction terminated',
                    ],
                    [
                        'code' => 'AF',
                        'description' => 'Invalid/missing diagnoses code(s)',
                    ],
                    [
                        'code' => 'AG',
                        'description' => 'Invalid/missing procedure code(s)',
                    ],
                    [
                        'code' => 'IA',
                        'description' => 'Invalid authorization number format',
                    ],
                    [
                        'code' => 'MA',
                        'description' => 'Missing authorization number',
                    ],
                    [
                        'code' => 'T4',
                        'description' => 'Payer name or identifier missing',
                    ],
                    [
                        'code' => '00081',
                        'description' => 'Missing value code and value',
                    ],
                    [
                        'code' => '00082',
                        'description' => 'Missing admission hour',
                    ],
                    [
                        'code' => '00083',
                        'description' => 'Referring physician name',
                    ],
                    [
                        'code' => '00084',
                        'description' => 'Missing claim scrubber info',
                    ],
                    [
                        'code' => '00085',
                        'description' => 'Referring physician pcn',
                    ],
                    [
                        'code' => '00086',
                        'description' => 'Missing or incorrect render',
                    ],
                    [
                        'code' => '00087',
                        'description' => 'Missing or incorrect payto',
                    ],
                    [
                        'code' => '00088',
                        'description' => 'Missing or incorrect referring',
                    ],
                ],
            ],
            [
                'description' => 'Appeal reasons',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Any denial that involves a determination that a treatment is experimental or investigational',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Any denial that involves medical judgment where you or your provider may disagree with the health insurance plan',
                    ],
                    [
                        'code' => '3',
                        'description' => 'The benefit is not offered under your health plan',
                    ],
                    [
                        'code' => '4',
                        'description' => 'Your medical problem began before you joined the plan',
                    ],
                    [
                        'code' => '5',
                        'description' => 'You received health services from a health provider or facility that is not in your plan is approved network',
                    ],
                    [
                        'code' => '6',
                        'description' => 'The requested service or treatment is not medically necessary',
                    ],
                    [
                        'code' => '7',
                        'description' => 'The requested service or treatment is an experimental or investigative treatment',
                    ],
                    [
                        'code' => '8',
                        'description' => 'You are no longer enrolled or eligible to be enrolled in the health plan',
                    ],
                    [
                        'code' => '9',
                        'description' => 'It is revoking or canceling your coverage going back to the date you enrolled because the insurance company claims that you gave false or incomplete information when you applied for coverage',
                    ],
                    [
                        'code' => '10',
                        'description' => 'Any denial that involves medical judgment where you or your provider may disagree with the health insurance plan',
                    ],
                    [
                        'code' => '11',
                        'description' => 'Any denial that involves a determination that a treatment is experimental or investigational',
                    ],
                    [
                        'code' => '12',
                        'description' => 'Cancellation of coverage based on your insurer is claim that you gave false or incomplete information when you applied for coverage',
                    ],
                ],
            ],
            [
                'description' => 'Payer ID',
                'type_catalogs' => [
                    [
                        'code' => '13162',
                        'description' => '1199 National Benefit Fund',
                    ],
                    [
                        'code' => '36273',
                        'description' => 'AARP',
                    ],
                    [
                        'code' => '68069',
                        'description' => 'Absolute Total Care',
                    ],
                    [
                        'code' => '22384',
                        'description' => 'Administrative Concepts',
                    ],
                    [
                        'code' => '68069',
                        'description' => 'Advantage By Buckeye',
                    ],
                    [
                        'code' => '60054',
                        'description' => 'AETNA',
                    ],
                    [
                        'code' => '128CA',
                        'description' => 'Aetna Better Health of California',
                    ],
                    [
                        'code' => '68024',
                        'description' => 'Aetna Better Health of Illinois – Medicaid',
                    ],
                    [
                        'code' => '26337',
                        'description' => 'Aetna Better Health of Illinois – Medicare',
                    ],
                ],
            ],
            [
                'description' => 'Statement rule',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Send to all',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Send to none',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Send if plan is',
                    ],
                    [
                        'code' => '4',
                        'description' => 'Do not send if plan is',
                    ],
                    [
                        'code' => '5',
                        'description' => 'Send on payment',
                    ],
                ],
            ],
            [
                'description' => 'Statement when',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'When registering the payment',
                    ],
                    [
                        'code' => '2',
                        'description' => 'In a defined period',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Specific date',
                    ],
                ],
            ],
            [
                'description' => 'Statement apply to',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Apply to 1',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Apply to 2',
                    ],
                ],
            ],
            [
                'description' => 'Name suffix',
                'type_catalogs' => [
                    [
                        'code' => 'I',
                        'description' => 'I',
                    ],
                    [
                        'code' => 'II',
                        'description' => 'II',
                    ],
                    [
                        'code' => 'III',
                        'description' => 'III',
                    ],
                    [
                        'code' => 'IV',
                        'description' => 'IV',
                    ],
                    [
                        'code' => 'Jr',
                        'description' => 'Jr',
                    ],
                    [
                        'code' => 'Sr',
                        'description' => 'Sr',
                    ],
                ],
            ],
            [
                'description' => 'Transmission format',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'JSON',
                    ],
                    [
                        'code' => '2',
                        'description' => 'ANSI X12',
                    ],
                ],
            ],
            [
                'description' => 'EPSDT',
                'type_catalogs' => [
                    [
                        'code' => 'S2',
                        'description' => 'S2',
                    ],
                    [
                        'code' => 'ST',
                        'description' => 'ST',
                    ],
                    [
                        'code' => 'NU',
                        'description' => 'NU',
                    ],
                ],
            ],
            [
                'description' => 'Family planning',
                'type_catalogs' => [
                    [
                        'code' => 'Y',
                        'description' => 'Yes',
                    ],
                    [
                        'code' => '',
                        'description' => 'No',
                    ],
                ],
            ],
            [
                'description' => 'Claim field information',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '14. Date of current illnes, injury or pregnancy (LMP)',
                    ],
                    [
                        'code' => '2',
                        'description' => '15. Other date',
                    ],
                    [
                        'code' => '3',
                        'description' => '16. Dates patient unable to work in current occupation',
                    ],
                    [
                        'code' => '4',
                        'description' => '18. Hospitalization dates related to current services',
                    ],
                    [
                        'code' => '5',
                        'description' => '19. Additional claim information (Designated by NUCC)',
                    ],
                ],
            ],
            [
                'description' => 'Claim field information',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '14. Date of current illnes, injury or pregnancy (LMP)',
                    ],
                    [
                        'code' => '2',
                        'description' => '15. Other date',
                    ],
                    [
                        'code' => '3',
                        'description' => '16. Dates patient unable to work in current occupation',
                    ],
                    [
                        'code' => '4',
                        'description' => '18. Hospitalization dates related to current services',
                    ],
                    [
                        'code' => '5',
                        'description' => '19. Additional claim information (Designated by NUCC)',
                    ],
                ],
            ],
            [
                'description' => '14. Date of current illnes, injury or pregnancy (LMP)',
                'type_catalogs' => [
                    [
                        'code' => '431',
                        'description' => 'Onset of current symptoms or illness',
                    ],
                    [
                        'code' => '439',
                        'description' => 'Accident',
                    ],
                    [
                        'code' => '454',
                        'description' => 'Initial treatment',
                    ],
                ],
            ],
            [
                'description' => '15. Other date',
                'type_catalogs' => [
                    [
                        'code' => '454',
                        'description' => 'Initial treatment',
                    ],
                    [
                        'code' => '304',
                        'description' => 'Latest visit or consultation',
                    ],
                    [
                        'code' => '453',
                        'description' => 'Acute manifestation of a chronic condition',
                    ],
                    [
                        'code' => '439',
                        'description' => 'Accident',
                    ],
                    [
                        'code' => '455',
                        'description' => 'Last x-ray',
                    ],
                    [
                        'code' => '471',
                        'description' => 'Prescription',
                    ],
                    [
                        'code' => '090',
                        'description' => 'Report start (assumed care date)',
                    ],
                    [
                        'code' => '091',
                        'description' => 'Report end (relinquished care date)',
                    ],
                    [
                        'code' => '444',
                        'description' => 'First visit or consultation',
                    ],
                ],
            ],
            [
                'description' => '16. Dates patient unable to work in current occupation',
                'type_catalogs' => [
                    [
                        'code' => '360',
                        'description' => 'Initial disability period start',
                    ],
                    [
                        'code' => '361',
                        'description' => 'Initial disability period end',
                    ],
                ],
            ],
            [
                'description' => '18. Hospitalization dates related to current services',
                'type_catalogs' => [
                    [
                        'code' => '096',
                        'description' => 'Discharge',
                    ],
                    [
                        'code' => '435',
                        'description' => 'Admission',
                    ],
                ],
            ],
            [
                'description' => '19. Additional claim information (Designated by NUCC)',
                'type_catalogs' => [
                    [
                        'code' => '090',
                        'description' => 'Report start',
                    ],
                    [
                        'code' => '091',
                        'description' => 'Report end',
                    ],
                    [
                        'code' => '304',
                        'description' => 'Latest visit or consultation',
                    ],
                    [
                        'code' => '455',
                        'description' => 'Last X-Ray',
                    ],
                    [
                        'code' => 'DQ',
                        'description' => 'Supervising physician',
                    ],
                    [
                        'code' => 'QB',
                        'description' => 'Purchase service provider',
                    ],
                    [
                        'code' => 'IH',
                        'description' => 'Insurance history or other coverage',
                    ],
                    [
                        'code' => 'P4',
                        'description' => 'Project code',
                    ],
                ],
            ],
            [
                'description' => 'Admission type code',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Emergency',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Urgent',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Elective',
                    ],
                    [
                        'code' => '4',
                        'description' => 'Newborn',
                    ],
                    [
                        'code' => '5',
                        'description' => 'Trauma Center',
                    ],
                    [
                        'code' => '9',
                        'description' => 'Information Unavailable',
                    ],
                ],
            ],
            [
                'description' => 'Admission source code',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Non-Health Facility Point of Origin',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Clinic',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Reserved for assignment by the NUBC',
                    ],
                    [
                        'code' => '4',
                        'description' => 'Transfer From a Hospital (Different Facility)',
                    ],
                    [
                        'code' => '5',
                        'description' => 'Transfer From a Skilled Nursing Facility (SNF) or Intermediate Care Facility (ICF)',
                    ],
                    [
                        'code' => '6',
                        'description' => 'Transfer From Another Health Care Facility',
                    ],
                    [
                        'code' => '7',
                        'description' => 'Emergency Room',
                    ],
                    [
                        'code' => '8',
                        'description' => 'Court/Law Enforcement',
                    ],
                    [
                        'code' => '9',
                        'description' => 'Information Not Available',
                    ],
                    [
                        'code' => 'D',
                        'description' => 'Transfer from One Distinct Unit of the Hospital to another Distinct Unit of the Same Hospital Resulting in a Separate Claim to the Payer',
                    ],
                    [
                        'code' => 'E',
                        'description' => 'Transfer from Ambulatory Surgery Center (Effective 10/1/2007)',
                    ],
                    [
                        'code' => 'F',
                        'description' => 'Transfer from Hospice and is Under a Hospice Plan of Care or Enrolled in a Hospice Program (Effective 10/1/2007)',
                    ],
                ],
            ],
            [
                'description' => 'Patient status code',
                'type_catalogs' => [
                    [
                        'code' => '01',
                        'description' => 'Discharged to home or self-care (routine discharge)',
                    ],
                    [
                        'code' => '02',
                        'description' => 'Discharged/transferred to a short-term general hospital for inpatient care',
                    ],
                    [
                        'code' => '03',
                        'description' => 'Discharged/transferred to skilled nursing facility (SNF) with Medicare certification in anticipation of covered skilled care ',
                    ],
                    [
                        'code' => '04',
                        'description' => 'Discharged/transferred to a facility that provides custodial or supportive care',
                    ],
                    [
                        'code' => '05',
                        'description' => "Discharged/transferred to a designated cancer center or children's hospital",
                    ],
                    [
                        'code' => '06',
                        'description' => 'Discharged/transferred to home under care of organized home health service organization in anticipation of covered skilled care',
                    ],
                    [
                        'code' => '07',
                        'description' => 'Left against medical advice or discontinued care',
                    ],
                    [
                        'code' => '09',
                        'description' => 'Admitted as an inpatient to this hospital',
                    ],
                    [
                        'code' => '20',
                        'description' => 'Expired',
                    ],
                    [
                        'code' => '21',
                        'description' => 'Discharged/transferred to court/law enforcement',
                    ],
                    [
                        'code' => '30',
                        'description' => 'Still patient or expected to return for outpatient services',
                    ],
                    [
                        'code' => '40',
                        'description' => 'Expired at home',
                    ],
                    [
                        'code' => '41',
                        'description' => 'Expired in a medical facility (e.g., hospital, SNF, ICF, or free-standing hospice)',
                    ],
                    [
                        'code' => '42',
                        'description' => 'Expired - place unknown',
                    ],
                    [
                        'code' => '43',
                        'description' => 'Discharged/transferred to a federal health care facility',
                    ],
                    [
                        'code' => '50',
                        'description' => 'Discharged/transferred to Hospice - home',
                    ],
                    [
                        'code' => '51',
                        'description' => 'Discharged/transferred to Hospice - medical facility',
                    ],
                    [
                        'code' => '61',
                        'description' => 'Discharged/transferred to a hospital-based Medicare approved swing bed',
                    ],
                    [
                        'code' => '62',
                        'description' => 'Discharged/transferred to an inpatient rehabilitation facility (IRF) including rehabilitation distinct part units of a hospital',
                    ],
                    [
                        'code' => '63',
                        'description' => 'Discharged/transferred to a Medicare certified long term care hospital (LTCH)',
                    ],
                    [
                        'code' => '64',
                        'description' => 'Discharged/transferred to a nursing facility certified under Medicaid but not certified under Medicare',
                    ],
                    [
                        'code' => '65',
                        'description' => 'Discharged/transferred to a psychiatric hospital or psychiatric distinct part unit of a hospital',
                    ],
                    [
                        'code' => '66',
                        'description' => 'Discharged/transferred to a critical access hospital (CAH)',
                    ],
                    [
                        'code' => '69',
                        'description' => 'Discharged/transferred to a designated disaster alternate care site',
                    ],
                    [
                        'code' => '70',
                        'description' => 'Discharged/transferred to another type of health care institution not defined elsewhere in this code list',
                    ],
                    [
                        'code' => '81',
                        'description' => 'Discharged to home or self-care with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '82',
                        'description' => 'Discharged/transferred to a short-term general hospital for inpatient care with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '83',
                        'description' => 'Discharged/transferred to a skilled nursing facility (SNF) with Medicare certification with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '84',
                        'description' => 'Discharged/transferred to a facility that provides custodial or supportive care with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '85',
                        'description' => "Discharged/transferred to a designated cancer center or children's hospital with a planned acute care hospital inpatient readmission ",
                    ],
                    [
                        'code' => '86',
                        'description' => 'Discharged/transferred to home under care of organized home health service organization in anticipation of covered skilled care with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '87',
                        'description' => 'Discharged/transferred to court/law enforcement with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '88',
                        'description' => 'Discharged/transferred to a federal health care facility with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '89',
                        'description' => 'Discharged/transferred to a hospital-based Medicare approved swing bed with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '90',
                        'description' => 'Discharged/transferred to an inpatient rehabilitation facility (IRF) including rehabilitation distinct part units of a hospital with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '91',
                        'description' => 'Discharged/transferred to a Medicare certified long term care hospital (LTCH) with a planned acute care hospital inpatient readmission',
                    ],
                    [
                        'code' => '92',
                        'description' => 'Discharged/transferred to a nursing facility certified under Medicaid but not certified under Medicare with a planned acute care hospital inpatient readmission',
                    ],
                    [
                        'code' => '93',
                        'description' => 'Discharged/transferred to a psychiatric hospital or psychiatric distinct part unit of a hospital with a planned acute care hospital inpatient readmission ',
                    ],
                    [
                        'code' => '94',
                        'description' => 'Discharged/transferred to a critical access hospital (CAH) with a planned acute care hospital inpatient readmissio',
                    ],
                    [
                        'code' => '95',
                        'description' => 'Discharged/transferred to another type of health care institution not defined elsewhere in this code list with a planned acute care hospital inpatient readmission ',
                    ],
                ],
            ],
            [
                'description' => 'Occurrence code and date',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Accident/Medical Coverage',
                    ],
                    [
                        'code' => '2',
                        'description' => 'No Fault Insurance Involved - Including Auto Accident/Other',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Accident/Tort Liability',
                    ],
                    [
                        'code' => '4',
                        'description' => 'Accident/Employment Related',
                    ],
                    [
                        'code' => '5',
                        'description' => 'Accident/No Medical or Liability Coverage.',
                    ],
                    [
                        'code' => '6',
                        'description' => 'Crime Victim',
                    ],
                    [
                        'code' => '9',
                        'description' => 'Start of Infertility Treatment Cycle',
                    ],
                    [
                        'code' => '10',
                        'description' => 'Last Menstrual Period',
                    ],
                    [
                        'code' => '11',
                        'description' => 'Onset of Symptoms/Illness',
                    ],
                    [
                        'code' => '16',
                        'description' => 'Date of last Therapy',
                    ],
                    [
                        'code' => '17',
                        'description' => 'Date Outpatient Occupational Therapy Plan Established or Last Reviewed',
                    ],
                    [
                        'code' => '18',
                        'description' => 'Date of Retirement Patient/ Beneficiary',
                    ],
                    [
                        'code' => '19',
                        'description' => 'Date of Retirement Spouse',
                    ],
                    [
                        'code' => '20',
                        'description' => 'Date Guarantee of Payment Began',
                    ],
                    [
                        'code' => '21',
                        'description' => 'Date UR Notice Received',
                    ],
                    [
                        'code' => '22',
                        'description' => 'Date Active Care Ended',
                    ],
                    [
                        'code' => '24',
                        'description' => 'Date Insurance Denied',
                    ],
                    [
                        'code' => '25',
                        'description' => 'Date Benefits Terminated by Primary Payer',
                    ],
                    [
                        'code' => '26',
                        'description' => 'Date SNF Bed Became Available',
                    ],
                    [
                        'code' => '28',
                        'description' => 'Date Comprehensive Outpatient Rehabilitation Plan Established or Last Reviewed',
                    ],
                    [
                        'code' => '29',
                        'description' => 'Date Outpatient Physical Therapy Plan Established or Last Reviewed',
                    ],
                    [
                        'code' => '30',
                        'description' => 'Date Outpatient Speech Pathology Plan Established or Last Reviewed',
                    ],
                    [
                        'code' => '31',
                        'description' => 'Date Beneficiary Notified of Intent to Bill (Accommodations)',
                    ],
                    [
                        'code' => '32',
                        'description' => 'Date Beneficiary Notified of Intent to Bill (Procedures or Treatments)',
                    ],
                    [
                        'code' => '33',
                        'description' => 'First Day of the Coordination Period for ESRD Beneficiaries Covered by EGHP',
                    ],
                    [
                        'code' => '34',
                        'description' => 'Date of Election of Extended Care Facilities',
                    ],
                    [
                        'code' => '35',
                        'description' => 'Date Treatment Started for Physical Therapy',
                    ],
                    [
                        'code' => '36',
                        'description' => 'Date of Inpatient Hospital Discharge for Covered Transplant Patients',
                    ],
                    [
                        'code' => '37',
                        'description' => 'Date of Inpatient Hospital Discharge for Non-covered Transplant Patient',
                    ],
                    [
                        'code' => '38',
                        'description' => 'Date Treatment Started for Home IV Therapy',
                    ],
                    [
                        'code' => '39',
                        'description' => 'Date Discharged on a Continuous Course of IV Therapy',
                    ],
                    [
                        'code' => '40',
                        'description' => 'Scheduled Date of Admission',
                    ],
                    [
                        'code' => '41',
                        'description' => 'Date of First Test Pre-Admission Testing',
                    ],
                    [
                        'code' => '42',
                        'description' => 'Date of Discharge',
                    ],
                    [
                        'code' => '43',
                        'description' => 'Scheduled Date of Canceled Surgery',
                    ],
                    [
                        'code' => '44',
                        'description' => 'Date Treatment Started for Occupational Therapy',
                    ],
                    [
                        'code' => '45',
                        'description' => 'Date Treatment Started for Speech Therapy',
                    ],
                    [
                        'code' => '46',
                        'description' => 'Date Treatment Started for Cardiac Rehabilitation',
                    ],
                    [
                        'code' => '47',
                        'description' => 'Date Cost Outlier Status Begins',
                    ],
                    [
                        'code' => 'A1',
                        'description' => 'Birth Date - Insured A',
                    ],
                    [
                        'code' => 'A2',
                        'description' => 'Effective Date - Insured A Policy',
                    ],
                    [
                        'code' => 'A3',
                        'description' => 'Benefits Exhausted - Payer ALTC Hospitals ONLY (i.e. Chronic)',
                    ],
                    [
                        'code' => 'A4',
                        'description' => 'Split Bill Date',
                    ],
                    [
                        'code' => 'B1',
                        'description' => 'Birth Date - Insured B',
                    ],
                    [
                        'code' => 'B2',
                        'description' => 'Effective Date - Insured B Policy',
                    ],
                    [
                        'code' => 'B3',
                        'description' => 'Benefits Exhausted - Payer B',
                    ],
                    [
                        'code' => 'C1',
                        'description' => 'Birth Date - Insured C',
                    ],
                    [
                        'code' => 'C2',
                        'description' => 'Effective Date - Insured C Policy',
                    ],
                    [
                        'code' => 'C3',
                        'description' => 'Benefits Exhausted - Payer C',
                    ],
                ],
            ],
            [
                'description' => 'Occurrence span code and date',
                'type_catalogs' => [
                    [
                        'code' => '70',
                        'description' => 'Qualifying Stay Dates For SNF Use ONLY',
                    ],
                    [
                        'code' => '71',
                        'description' => 'Prior Stay Dates',
                    ],
                    [
                        'code' => '72',
                        'description' => 'First/Last Visit Dates',
                    ],
                    [
                        'code' => '73',
                        'description' => 'Benefit Eligibility Period',
                    ],
                    [
                        'code' => '74',
                        'description' => 'Non-Covered Level of Care/Leave of Absence Dates',
                    ],
                    [
                        'code' => '75',
                        'description' => 'SNF Level of Care Dates',
                    ],
                    [
                        'code' => '76',
                        'description' => 'Patient Liability (Spend-down Amount Dates) Replaces Code 80 as of 7/31/07"',
                    ],
                    [
                        'code' => '77',
                        'description' => 'Provider Liability Period',
                    ],
                    [
                        'code' => '78',
                        'description' => 'SNF Prior Stay Dates',
                    ],
                    [
                        'code' => 'M0',
                        'description' => 'QIO/UR Approved Stay Dates',
                    ],
                    [
                        'code' => 'M1',
                        'description' => 'Provider Liability- No Utilization',
                    ],
                    [
                        'code' => 'M2',
                        'description' => 'Inpatient Respite Dates',
                    ],
                    [
                        'code' => 'M3',
                        'description' => 'ICF Level of Care',
                    ],
                    [
                        'code' => 'M4',
                        'description' => 'Residential Level of Care',
                    ],
                    [
                        'code' => 'MR',
                        'description' => 'Reserved - Disaster Related',
                    ],
                ],
            ],
            [
                'description' => 'Health care institutional qualifier reference',
                'type_catalogs' => [
                    [
                        'code' => '0B',
                        'description' => 'State License Number',
                    ],
                    [
                        'code' => '1G',
                        'description' => 'Provider UPIN Number',
                    ],
                    [
                        'code' => 'G2',
                        'description' => 'Provider Commercial Number',
                    ],
                    [
                        'code' => 'LU',
                        'description' => 'Location Number',
                    ],
                ],
            ],
            [
                'description' => 'Report form claim',
                'type_catalogs' => [
                    [
                        'code' => 'HCFA',
                        'description' => 'HCFA',
                    ],
                    [
                        'code' => 'UB92',
                        'description' => 'UB92',
                    ],
                    [
                        'code' => 'MASS5',
                        'description' => 'MASS5',
                    ],
                    [
                        'code' => 'IGENERIC',
                        'description' => 'IGENERIC',
                    ],
                    [
                        'code' => 'ILTRHEAD',
                        'description' => 'ILTRHEAD',
                    ],
                    [
                        'code' => 'IPGPERPT',
                        'description' => 'IPGPERPT',
                    ],
                    [
                        'code' => 'WCOMP',
                        'description' => 'WCOMP',
                    ],
                    [
                        'code' => 'IL333',
                        'description' => 'IL333',
                    ],
                ],
            ],
            [
                'description' => 'Referred or ordered provider roles',
                'type_catalogs' => [
                    [
                        'code' => 'DN',
                        'description' => 'Referring provider',
                    ],
                    [
                        'code' => 'DK',
                        'description' => 'Ordering provider',
                    ],
                    [
                        'code' => 'DQ',
                        'description' => 'Supervising provider',
                    ],
                ],
            ],
            [
                'description' => 'Gender',
                'type_catalogs' => [
                    [
                        'code' => 'F',
                        'description' => 'Female',
                    ],
                    [
                        'code' => 'M',
                        'description' => 'Male',
                    ],
                    [
                        'code' => 'O',
                        'description' => 'Other',
                    ],
                ],
            ],
            [
                'description' => 'Medicare secondary policy',
                'type_catalogs' => [
                    [
                        'code' => '12',
                        'description' => 'Working Aged Beneficiary or Spouse with employer group health plan',
                    ],
                    [
                        'code' => '13',
                        'description' => 'End-Stage Renal Disease Beneficiary in the mandated coordination period with an employer\'s group health plan',
                    ],
                    [
                        'code' => '14',
                        'description' => 'No-fault insurance, including auto, is primary',
                    ],
                    [
                        'code' => '15',
                        'description' => 'Worker\'s Compensation',
                    ],
                    [
                        'code' => '16',
                        'description' => 'Public Health Service (PHS) or Other Federal Agency',
                    ],
                    [
                        'code' => '41',
                        'description' => 'Black Lung',
                    ],
                    [
                        'code' => '42',
                        'description' => 'Veteran\'s Administration',
                    ],
                    [
                        'code' => '43',
                        'description' => 'Disabled Beneficiary Under Age 65 with a large group health plan (LGHP)',
                    ],
                    [
                        'code' => '47',
                        'description' => 'Other liability insurance is primary',
                    ],
                ],
            ],
            [
                'description' => 'Claim adjustment reason code',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Deductible Amount',
                    ],
                    [
                        'code' => '2',
                        'description' => 'Coinsurance Amount',
                    ],
                    [
                        'code' => '3',
                        'description' => 'Co-payment Amount',
                    ],
                    [
                        'code' => '4',
                        'description' => 'The procedure code is inconsistent with the modifier used.',
                    ],
                    [
                        'code' => '5',
                        'description' => 'The procedure code/type of bill is inconsistent with the place of service.',
                    ],
                    [
                        'code' => '6',
                        'description' => 'The procedure/revenue code is inconsistent with the patient\'s age.',
                    ],
                    [
                        'code' => '7',
                        'description' => 'The procedure/revenue code is inconsistent with the patient\'s gender.',
                    ],
                    [
                        'code' => '8',
                        'description' => 'The procedure code is inconsistent with the provider type/specialty (taxonomy).',
                    ],
                    [
                        'code' => '9',
                        'description' => 'The diagnosis is inconsistent with the patient\'s age.',
                    ],
                    [
                        'code' => '10',
                        'description' => 'The diagnosis is inconsistent with the patient\'s gender.',
                    ],
                    [
                        'code' => '11',
                        'description' => 'The diagnosis is inconsistent with the procedure.',
                    ],
                    [
                        'code' => '12',
                        'description' => 'The diagnosis is inconsistent with the provider type.',
                    ],
                    [
                        'code' => '13',
                        'description' => 'The date of death precedes the date of service.',
                    ],
                    [
                        'code' => '14',
                        'description' => ' The date of birth follows the date of service.',
                    ],
                    [
                        'code' => '16',
                        'description' => 'Claim/service lacks information or has submission/billing error(s).',
                    ],
                    [
                        'code' => '18',
                        'description' => 'Exact duplicate claim/service.',
                    ],
                    [
                        'code' => '19',
                        'description' => 'This is a work-related injury/illness and thus the liability of the Worker\'s Compensation Carrier.',
                    ],
                    [
                        'code' => '20',
                        'description' => 'This injury/illness is covered by the liability carrier.',
                    ],
                    [
                        'code' => '21',
                        'description' => 'This injury/illness is the liability of the no-fault carrier.',
                    ],
                    [
                        'code' => '22',
                        'description' => 'This care may be covered by another payer per coordination of benefits.',
                    ],
                    [
                        'code' => '23',
                        'description' => 'The impact of prior payer(s) adjudication including payments and/or adjustments.',
                    ],
                    [
                        'code' => '24',
                        'description' => 'Charges are covered under a capitation agreement/managed care plan.',
                    ],
                    [
                        'code' => '26',
                        'description' => 'Expenses incurred prior to coverage.',
                    ],
                    [
                        'code' => '27',
                        'description' => 'Expenses incurred after coverage terminated.',
                    ],
                    [
                        'code' => '29',
                        'description' => 'The time limit for filing has expired.',
                    ],
                    [
                        'code' => '31',
                        'description' => 'Patient cannot be identified as our insured.',
                    ],
                    [
                        'code' => '32',
                        'description' => 'Our records indicate the patient is not an eligible dependent.',
                    ],
                    [
                        'code' => '33',
                        'description' => 'Insured has no dependent coverage.',
                    ],
                    [
                        'code' => '34',
                        'description' => 'Insured has no coverage for newborns.',
                    ],
                    [
                        'code' => '35',
                        'description' => 'Lifetime benefit maximum has been reached.',
                    ],
                    [
                        'code' => '39',
                        'description' => 'Services denied at the time authorization/pre-certification was requested.',
                    ],
                    [
                        'code' => '40',
                        'description' => 'Charges do not meet qualifications for emergent/urgent care.',
                    ],
                    [
                        'code' => '44',
                        'description' => 'Prompt-pay discount (aunque es un descuento, si no se aplica correctamente, podría resultar en una denegación de pago).',
                    ],
                    [
                        'code' => '45',
                        'description' => 'Charge exceeds fee schedule/maximum allowable or contracted/legislated fee arrangement.',
                    ],
                    [
                        'code' => '49',
                        'description' => 'This is a non-covered service because it is a routine/preventive exam or a diagnostic/screening procedure done in conjunction with a routine/preventive exam.',
                    ],
                    [
                        'code' => '50',
                        'description' => 'These are non-covered services because this is not deemed a \'medical necessity\' by the payer.',
                    ],
                    [
                        'code' => '51',
                        'description' => 'These are non-covered services because this is a pre-existing condition.',
                    ],
                    [
                        'code' => '53',
                        'description' => 'Services by an immediate relative or a member of the same household are not covered.',
                    ],
                    [
                        'code' => '54',
                        'description' => 'Multiple physicians/assistants are not covered in this case.',
                    ],
                    [
                        'code' => '55',
                        'description' => 'Procedure/treatment/drug is deemed experimental/investigational by the payer.',
                    ],
                    [
                        'code' => '56',
                        'description' => 'Procedure/treatment has not been deemed \'proven to be effective\' by the payer.',
                    ],
                    [
                        'code' => '58',
                        'description' => 'Treatment was deemed by the payer to have been rendered in an inappropriate or invalid place of service.',
                    ],
                    [
                        'code' => '59',
                        'description' => 'Processed based on multiple or concurrent procedure rules.',
                    ],
                    [
                        'code' => '60',
                        'description' => 'for outpatient services are not covered when performed within a period of time prior to or after inpatient services.',
                    ],
                    [
                        'code' => '61',
                        'description' => 'Adjusted for failure to obtain second surgical opinion.',
                    ],
                    [
                        'code' => '66',
                        'description' => 'Blood Deductible.',
                    ],
                    [
                        'code' => '69',
                        'description' => 'Day outlier amount.',
                    ],
                    [
                        'code' => '70',
                        'description' => 'Cost outlier - Adjustment to compensate for additional costs.',
                    ],
                    [
                        'code' => '74',
                        'description' => 'Indirect Medical Education Adjustment.',
                    ],
                    [
                        'code' => '75',
                        'description' => 'Direct Medical Education Adjustment.',
                    ],
                    [
                        'code' => '76',
                        'description' => 'Disproportionate Share Adjustment.',
                    ],
                    [
                        'code' => '78',
                        'description' => 'Non-Covered days/Room charge adjustment.',
                    ],
                    [
                        'code' => '85',
                        'description' => 'Patient Interest Adjustment',
                    ],
                    [
                        'code' => '89',
                        'description' => 'Professional fees removed from charges.',
                    ],
                    [
                        'code' => '90',
                        'description' => 'Ingredient cost adjustment. (Se usa solo para farmacéuticos).',
                    ],
                    [
                        'code' => '91',
                        'description' => 'Dispensing fee adjustment.',
                    ],
                    [
                        'code' => '94',
                        'description' => 'Processed in Excess of charges.',
                    ],
                    [
                        'code' => '95',
                        'description' => 'Plan procedures not followed.',
                    ],
                    [
                        'code' => '96',
                        'description' => 'Non-covered charge(s).',
                    ],
                    [
                        'code' => '97',
                        'description' => 'The benefit for this service is included in the payment/allowance for another service/procedure that has already been adjudicated.',
                    ],
                    [
                        'code' => '100',
                        'description' => 'Payment made to patient/insured/responsible party.',
                    ],
                    [
                        'code' => '102',
                        'description' => 'Major Medical Adjustment.',
                    ],
                    [
                        'code' => '103',
                        'description' => 'Provider promotional discount (e.g., Senior citizen discount).',
                    ],
                    [
                        'code' => '104',
                        'description' => 'Managed care withholding.',
                    ],
                    [
                        'code' => '105',
                        'description' => 'Tax withholding.',
                    ],
                    [
                        'code' => '106',
                        'description' => 'Patient payment option/election not in effect.',
                    ],
                    [
                        'code' => '107',
                        'description' => 'The related or qualifying claim/service was not identified on this claim.',
                    ],
                    [
                        'code' => '108',
                        'description' => 'Rent/purchase guidelines were not met.',
                    ],
                    [
                        'code' => '109',
                        'description' => 'Claim/service not covered by this payer/contractor.',
                    ],
                    [
                        'code' => '110',
                        'description' => 'Billing date predates service date.',
                    ],
                    [
                        'code' => '111',
                        'description' => 'Not covered unless the provider accepts assignment.',
                    ],
                    [
                        'code' => '112',
                        'description' => 'Service not furnished directly to the patient and/or not documented.',
                    ],
                    [
                        'code' => '114',
                        'description' => 'Procedure/product not approved by the Food and Drug Administration.',
                    ],
                    [
                        'code' => '115',
                        'description' => 'Procedure postponed, canceled, or delayed.',
                    ],
                    [
                        'code' => '116',
                        'description' => 'The advance indemnification notice signed by the patient did not comply with requirements.',
                    ],
                    [
                        'code' => '117',
                        'description' => 'Transportation is only covered to the closest facility that can provide the necessary care.',
                    ],
                    [
                        'code' => '118',
                        'description' => 'ESRD network support adjustment.',
                    ],
                    [
                        'code' => '119',
                        'description' => 'Benefit maximum for this time period or occurrence has been reached.',
                    ],
                    [
                        'code' => '121',
                        'description' => 'Indemnification adjustment - compensation for outstanding member responsibility.',
                    ],
                    [
                        'code' => '122',
                        'description' => 'Psychiatric reduction.',
                    ],
                    [
                        'code' => '128',
                        'description' => 'Newborn\'s services are covered in the mother\'s Allowance.',
                    ],
                    [
                        'code' => '129',
                        'description' => 'Prior processing information appears incorrect.',
                    ],
                    [
                        'code' => '130',
                        'description' => 'Claim submission fee.',
                    ],
                    [
                        'code' => '131',
                        'description' => 'Claim specific negotiated discount.',
                    ],
                    [
                        'code' => '132',
                        'description' => 'Prearranged demonstration project adjustment.',
                    ],
                    [
                        'code' => '133',
                        'description' => 'The disposition of this service line is pending further review.',
                    ],
                    [
                        'code' => '134',
                        'description' => 'Technical fees removed from charges.',
                    ],
                    [
                        'code' => '135',
                        'description' => 'Interim bills cannot be processed.',
                    ],
                    [
                        'code' => '136',
                        'description' => 'Failure to follow prior payer\'s coverage rules.',
                    ],
                    [
                        'code' => '137',
                        'description' => 'Regulatory Surcharges, Assessments, Allowances or Health Related Taxes.',
                    ],
                    [
                        'code' => '139',
                        'description' => 'Contracted funding agreement - Subscriber is employed by the provider of services.',
                    ],
                    [
                        'code' => '140',
                        'description' => 'Patient/Insured health identification number and name do not match.',
                    ],
                    [
                        'code' => '142',
                        'description' => 'Monthly Medicaid patient liability amount.',
                    ],
                    [
                        'code' => '143',
                        'description' => 'Portion of payment deferred.',
                    ],
                    [
                        'code' => '144',
                        'description' => 'Incentive adjustment, e.g., preferred product/service.',
                    ],
                    [
                        'code' => '146',
                        'description' => 'Diagnosis was invalid for the date(s) of service reported.',
                    ],
                    [
                        'code' => '147',
                        'description' => 'Provider contracted/negotiated rate expired or not on file.',
                    ],
                    [
                        'code' => '148',
                        'description' => 'Information from another provider was not provided or was insufficient/incomplete.',
                    ],
                    [
                        'code' => '149',
                        'description' => 'Lifetime benefit maximum has been reached for this service/benefit category.',
                    ],
                    [
                        'code' => '150',
                        'description' => 'Payer deems the information submitted does not support this level of service.',
                    ],
                    [
                        'code' => '151',
                        'description' => 'Payment adjusted because the payer deems the information submitted does not support this many/frequency of services.',
                    ],
                    [
                        'code' => '152',
                        'description' => 'Payer deems the information submitted does not support this length of service.',
                    ],
                    [
                        'code' => '153',
                        'description' => 'Payer deems the information submitted does not support this dosage.',
                    ],
                    [
                        'code' => '154',
                        'description' => 'Payer deems the information submitted does not support this day\'s supply.',
                    ],
                    [
                        'code' => '155',
                        'description' => 'Patient refused the service/procedure.',
                    ],
                    [
                        'code' => '157',
                        'description' => 'Service/procedure was provided as a result of an act of war.',
                    ],
                    [
                        'code' => '158',
                        'description' => 'Service/procedure was provided outside of the United States.',
                    ],
                    [
                        'code' => '159',
                        'description' => 'Service/procedure was provided as a result of terrorism.',
                    ],
                    [
                        'code' => '160',
                        'description' => 'Injury/illness was the result of an activity that is a benefit exclusion.',
                    ],
                    [
                        'code' => '161',
                        'description' => 'Provider performance bonus',
                    ],
                    [
                        'code' => '163',
                        'description' => 'Attachment/other documentation referenced on the claim was not received.',
                    ],
                    [
                        'code' => '164',
                        'description' => 'Attachment/other documentation referenced on the claim was not received in a timely fashion.',
                    ],
                    [
                        'code' => '166',
                        'description' => 'These services were submitted after this payers responsibility for processing claims under this plan ended.',
                    ],
                    [
                        'code' => '167',
                        'description' => 'This (these) diagnosis(es) is (are) not covered.',
                    ],
                    [
                        'code' => '169',
                        'description' => 'Alternate benefit has been provided.',
                    ],
                    [
                        'code' => '170',
                        'description' => 'Payment is denied when performed/billed by this type of provider.',
                    ],
                    [
                        'code' => '171',
                        'description' => 'Payment is denied when performed/billed by this type of provider in this type of facility.',
                    ],
                    [
                        'code' => '172',
                        'description' => 'Payment is adjusted when performed/billed by a provider of this specialty.',
                    ],
                    [
                        'code' => '173',
                        'description' => 'Service/equipment was not prescribed by a physician.',
                    ],
                    [
                        'code' => '174',
                        'description' => 'Service was not prescribed prior to delivery.',
                    ],
                    [
                        'code' => '175',
                        'description' => 'Prescription is incomplete.',
                    ],
                    [
                        'code' => '176',
                        'description' => 'Prescription is not current.',
                    ],
                    [
                        'code' => '177',
                        'description' => 'Patient has not met the required eligibility requirements.',
                    ],
                    [
                        'code' => '178',
                        'description' => 'Patient has not met the required spend down requirements.',
                    ],
                    [
                        'code' => '179',
                        'description' => 'Patient has not met the required waiting requirements.',
                    ],
                    [
                        'code' => '180',
                        'description' => 'Patient has not met the required residency requirements.',
                    ],
                    [
                        'code' => '181',
                        'description' => 'Procedure code was invalid on the date of service.',
                    ],
                    [
                        'code' => '182',
                        'description' => 'Procedure modifier was invalid on the date of service.',
                    ],
                    [
                        'code' => '183',
                        'description' => 'The referring provider is not eligible to refer the service billed.',
                    ],
                    [
                        'code' => '184',
                        'description' => 'The prescribing/ordering provider is not eligible to prescribe/order the service billed.',
                    ],
                    [
                        'code' => '185',
                        'description' => 'The rendering provider is not eligible to perform the service billed.',
                    ],
                    [
                        'code' => '186',
                        'description' => 'Level of care change adjustment.',
                    ],
                    [
                        'code' => '187',
                        'description' => 'Consumer Spending Account payments (includes but is not limited to Flexible Spending Account, Health Savings Account, Health Reimbursement Account, etc.).',
                    ],
                    [
                        'code' => '188',
                        'description' => 'This product/procedure is only covered when used according to FDA recommendations.',
                    ],
                    [
                        'code' => '189',
                        'description' => 'Not otherwise classified\' or \'unlisted\' procedure code was billed when there is a specific procedure code for this procedure/service.',
                    ],
                    [
                        'code' => '190',
                        'description' => 'Payment is included in the allowance for a Skilled Nursing Facility (SNF) qualified stay.',
                    ],
                    [
                        'code' => '192',
                        'description' => 'Non standard adjustment code from paper remittance.',
                    ],
                    [
                        'code' => '193',
                        'description' => 'Original payment decision is being maintained. Upon review, it was determined that this claim was processed properly.',
                    ],
                    [
                        'code' => '194',
                        'description' => 'Anesthesia performed by the operating physician, the assistant surgeon or the attending physician.',
                    ],
                    [
                        'code' => '195',
                        'description' => 'Refund issued to an erroneous priority payer for this claim/service.',
                    ],
                    [
                        'code' => '196',
                        'description' => 'Claim/service denied based on prior payer\'s coverage determination.',
                    ],
                    [
                        'code' => '197',
                        'description' => 'Precertification/authorization/notification/pre-treatment absent.',
                    ],
                    [
                        'code' => '198',
                        'description' => 'Precertification/notification/authorization/pre-treatment exceeded.',
                    ],
                    [
                        'code' => '199',
                        'description' => 'Revenue code and Procedure code do not match.',
                    ],
                    [
                        'code' => '200',
                        'description' => 'Expenses incurred during lapse in coverage',
                    ],
                    [
                        'code' => '201',
                        'description' => 'Patient is responsible for amount of this claim/service through \'set aside arrangement\' or other agreement. (Use only with Group Code PR) At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)',
                    ],
                    [
                        'code' => '202',
                        'description' => 'Non-covered personal comfort or convenience services.',
                    ],
                    [
                        'code' => '203',
                        'description' => 'Discontinued or reduced service.',
                    ],
                    [
                        'code' => '204',
                        'description' => 'This service/equipment/drug is not covered under the patient\'s current benefit plan',
                    ],
                    [
                        'code' => '205',
                        'description' => 'Pharmacy discount card processing fee',
                    ],
                    [
                        'code' => '206',
                        'description' => 'National Provider Identifier - missing.',
                    ],
                    [
                        'code' => '207',
                        'description' => 'National Provider identifier - Invalid format',
                    ],
                    [
                        'code' => '208',
                        'description' => 'National Provider Identifier - Not matched.',
                    ],
                    [
                        'code' => '209',
                        'description' => 'Per regulatory or other agreement. The provider cannot collect this amount from the patient. However, this amount may be billed to subsequent payer. Refund to patient if collected. (Use only with Group code OA)',
                    ],
                    [
                        'code' => '210',
                        'description' => 'Payment adjusted because pre-certification/authorization not received in a timely fashion',
                    ],
                    [
                        'code' => '211',
                        'description' => 'National Drug Codes (NDC) not eligible for rebate, are not covered.',
                    ],
                    [
                        'code' => '212',
                        'description' => 'Administrative surcharges are not covered',
                    ],
                    [
                        'code' => '213',
                        'description' => 'Non-compliance with the physician self referral prohibition legislation or payer policy.',
                    ],
                    [
                        'code' => '215',
                        'description' => 'Based on subrogation of a third party settlement',
                    ],
                    [
                        'code' => '216',
                        'description' => 'Based on the findings of a review organization',
                    ],
                    [
                        'code' => '219',
                        'description' => 'Based on extent of injury. Usage: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier \'IG\') for the jurisdictional regulation. If adjustment is at the Line Level, the payer must send and the provider should refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment information REF).',
                    ],
                    [
                        'code' => '222',
                        'description' => 'Exceeds the contracted maximum number of hours/days/units by this provider for this period. This is not patient specific. Usage: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.',
                    ],
                    [
                        'code' => '223',
                        'description' => 'Adjustment code for mandated federal, state or local law/regulation that is not already covered by another code and is mandated before a new code can be created.',
                    ],
                    [
                        'code' => '224',
                        'description' => 'Patient identification compromised by identity theft. Identity verification required for processing this and future claims.',
                    ],
                    [
                        'code' => '225',
                        'description' => 'Penalty or Interest Payment by Payer (Only used for plan to plan encounter reporting within the 837)',
                    ],
                    [
                        'code' => '226',
                        'description' => 'Information requested from the Billing/Rendering Provider was not provided or not provided timely or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)',
                    ],
                    [
                        'code' => '227',
                        'description' => 'Information requested from the patient/insured/responsible party was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)',
                    ],
                    [
                        'code' => '228',
                        'description' => 'Denied for failure of this provider, another provider or the subscriber to supply requested information to a previous payer for their adjudication',
                    ],
                    [
                        'code' => '229',
                        'description' => 'Partial charge amount not considered by Medicare due to the initial claim Type of Bill being 12X. Usage: This code can only be used in the 837 transaction to convey Coordination of Benefits information when the secondary payer\'s cost avoidance policy allows providers to bypass claim submission to a prior payer. (Use only with Group Code PR)',
                    ],
                    [
                        'code' => '231',
                        'description' => 'Mutually exclusive procedures cannot be done in the same day/setting. Usage: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.',
                    ],
                    [
                        'code' => '232',
                        'description' => 'Institutional Transfer Amount. Usage: Applies to institutional claims only and explains the DRG amount difference when the patient care crosses multiple institutions.',
                    ],
                    [
                        'code' => '233',
                        'description' => 'Services/charges related to the treatment of a hospital-acquired condition or preventable medical error.',
                    ],
                    [
                        'code' => '234',
                        'description' => 'This procedure is not paid separately. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)',
                    ],
                    [
                        'code' => '235',
                        'description' => 'Sales Tax',
                    ],
                    [
                        'code' => '236',
                        'description' => 'This procedure or procedure/modifier combination is not compatible with another procedure or procedure/modifier combination provided on the same day according to the National Correct Coding Initiative or workers compensation state regulations/ fee schedule requirements.',
                    ],
                    [
                        'code' => '237',
                        'description' => 'Legislated/Regulatory Penalty. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)',
                    ],
                    [
                        'code' => '238',
                        'description' => 'Claim spans eligible and ineligible periods of coverage, this is the reduction for the ineligible period. (Use only with Group Code PR)',
                    ],
                    [
                        'code' => '239',
                        'description' => 'Claim spans eligible and ineligible periods of coverage. Rebill separate claims.',
                    ],
                    [
                        'code' => '240',
                        'description' => 'The diagnosis is inconsistent with the patient\'s birth weight. Usage: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.',
                    ],
                    [
                        'code' => '241',
                        'description' => 'Low Income Subsidy (LIS) Co-payment Amount',
                    ],
                    [
                        'code' => '242',
                        'description' => 'Services not provided by network/primary care providers.',
                    ],
                    [
                        'code' => '243',
                        'description' => 'Services not authorized by network/primary care providers.',
                    ],
                    [
                        'code' => '245',
                        'description' => 'Provider performance program withhold.',
                    ],
                    [
                        'code' => '246',
                        'description' => 'This non-payable code is for required reporting only.',
                    ],
                    [
                        'code' => '247',
                        'description' => 'Deductible for Professional service rendered in an Institutional setting and billed on an Institutional claim.',
                    ],
                    [
                        'code' => '248',
                        'description' => 'Coinsurance for Professional service rendered in an Institutional setting and billed on an Institutional claim.',
                    ],
                    [
                        'code' => '249',
                        'description' => 'This claim has been identified as a readmission. (Use only with Group Code CO)',
                    ],
                    [
                        'code' => '250',
                        'description' => 'The attachment/other documentation that was received was the incorrect attachment/document. The expected attachment/document is still missing. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT).',
                    ],
                    [
                        'code' => '251',
                        'description' => 'The attachment/other documentation that was received was incomplete or deficient. The necessary information is still needed to process the claim. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT).',
                    ],
                    [
                        'code' => '252',
                        'description' => 'An attachment/other documentation is required to adjudicate this claim/service. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT).',
                    ],
                    [
                        'code' => '253',
                        'description' => 'Sequestration - reduction in federal payment',
                    ],
                    [
                        'code' => '254',
                        'description' => 'Claim received by the dental plan, but benefits not available under this plan. Submit these services to the patient\'s medical plan for further consideration.',
                    ],
                    [
                        'code' => '256',
                        'description' => 'Service not payable per managed care contract.',
                    ],
                    [
                        'code' => '257',
                        'description' => 'The disposition of the claim/service is undetermined during the premium payment grace period, per Health Insurance Exchange requirements. This claim/service will be reversed and corrected when the grace period ends (due to premium payment or lack of premium payment). (Use only with Group Code OA)',
                    ],
                    [
                        'code' => '258',
                        'description' => 'Claim/service not covered when patient is in custody/incarcerated. Applicable federal, state or local authority may cover the claim/service.',
                    ],
                    [
                        'code' => '259',
                        'description' => 'Additional payment for Dental/Vision service utilization.',
                    ],
                    [
                        'code' => '260',
                        'description' => 'Processed under Medicaid ACA Enhanced Fee Schedule',
                    ],
                    [
                        'code' => '261',
                        'description' => 'The procedure or service is inconsistent with the patient\'s history.',
                    ],
                    [
                        'code' => '262',
                        'description' => 'Adjustment for delivery cost. Usage: To be used for pharmaceuticals only.',
                    ],
                    [
                        'code' => '263',
                        'description' => 'Adjustment for shipping cost. Usage: To be used for pharmaceuticals only.',
                    ],
                    [
                        'code' => '264',
                        'description' => 'Adjustment for postage cost. Usage: To be used for pharmaceuticals only.',
                    ],
                    [
                        'code' => '265',
                        'description' => 'Adjustment for administrative cost. Usage: To be used for pharmaceuticals only.',
                    ],
                    [
                        'code' => '266',
                        'description' => 'Adjustment for compound preparation cost. Usage: To be used for pharmaceuticals only.',
                    ],
                    [
                        'code' => '267',
                        'description' => 'Claim/service spans multiple months. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)',
                    ],
                    [
                        'code' => '268',
                        'description' => 'The Claim spans two calendar years. Please resubmit one claim per calendar year.',
                    ],
                    [
                        'code' => '269',
                        'description' => 'Anesthesia not covered for this service/procedure. Usage: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.',
                    ],
                    [
                        'code' => '270',
                        'description' => 'Claim received by the medical plan, but benefits not available under this plan. Submit these services to the patient\'s dental plan for further consideration.',
                    ],
                    [
                        'code' => '271',
                        'description' => 'Prior contractual reductions related to a current periodic payment as part of a contractual payment schedule when deferred amounts have been previously reported. (Use only with Group Code OA)',
                    ],
                    [
                        'code' => '272',
                        'description' => 'Coverage/program guidelines were not met.',
                    ],
                    [
                        'code' => '273',
                        'description' => 'Coverage/program guidelines were exceeded.',
                    ],
                    [
                        'code' => '274',
                        'description' => 'Fee/Service not payable per patient Care Coordination arrangement.',
                    ],
                ],
            ],
        ];

        $appealRules = "5 things to know when filing an appeal
1. If you decide to file an appeal, ask your doctor, health care provider, or supplier for any information that may help your case.
2. If you think your health could be seriously harmed by waiting for a decision about a service, ask the plan for a fast decision. If the plan or doctor agrees, the plan must make a decision within 72 hours.
3. The plan must tell you, in writing, how to appeal. After you file an appeal, the plan will review its decision. Then, if your plan doesn't decide in your favor, the appeal is reviewed by an independent organization that works for Medicare, not for the plan.
4. If you believe you're being discharged from a hospital too soon, you have a right to immediate review by your Beneficiary And Family Centered Care Quality Improvement Organization (Bfcc-Qio). You'll be able to stay in the hospital at no charge while they review your case. The hospital can't force you to leave before the BFCC-QIO reaches a decision.
5. You'll have the right to a fast-track appeals process when you disagree with a decision that you no longer need services you're getting from a skilled nursing facility, home health agency, or a comprehensive outpatient rehabilitation facility.";

        foreach ($types as $type) {
            $typeC = Type::updateOrCreate(
                ['description' => $type['description']],
                ['description' => $type['description']]
            );

            if (isset($type['type_catalogs'])) {
                foreach ($type['type_catalogs'] as $typeCatalog) {
                    $catalog = TypeCatalog::updateOrCreate(
                        [
                            'code' => $typeCatalog['code'],
                            'description' => $typeCatalog['description'],
                            'type_id' => $typeC->id,
                        ],
                        [
                            'code' => $typeCatalog['code'],
                            'description' => $typeCatalog['description'],
                        ]
                    );

                    if ('Appeal reasons' == $type['description']) {
                        PrivateNote::updateOrCreate([
                            'publishable_type' => TypeCatalog::class,
                            'publishable_id' => $catalog->id,
                            'billing_company_id' => null,
                        ], [
                            'note' => $appealRules,
                        ]);
                    }
                }
            }
        }
    }
}
