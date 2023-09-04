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
                        'code' => 'AETNA',
                        'description' => 'Aetna',
                    ],
                    [
                        'code' => 'AUTO',
                        'description' => 'Automobile Insurance',
                    ],
                    [
                        'code' => 'BCBS',
                        'description' => 'Blue Cross an Blue Shield',
                    ],
                    [
                        'code' => 'CA',
                        'description' => 'Capitation',
                    ],
                    [
                        'code' => 'CIGNA',
                        'description' => 'Cigna',
                    ],
                    [
                        'code' => 'COMMERCIAL',
                        'description' => 'Commercial Insurance',
                    ],
                    [
                        'code' => 'MEDICAID',
                        'description' => 'Medicaid',
                    ],
                    [
                        'code' => 'MEDICARE',
                        'description' => 'Medicare',
                    ],
                    [
                        'code' => 'UHC',
                        'description' => 'United Health Care',
                    ],
                    [
                        'code' => 'WORKCOMP',
                        'description' => 'Workers Compensation',
                    ],
                ],
            ],
            [
                'description' => 'Insurance plan type',
                'type_catalogs' => [
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
                        'code' => 'HDHP',
                        'description' => 'High Deductible Health Plan',
                    ],
                    [
                        'code' => 'HSA',
                        'description' => 'Health Savings Accounts',
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
                        'code' => 'AUT',
                        'description' => 'AUT',
                    ],
                    [
                        'code' => 'CAP',
                        'description' => 'CAP',
                    ],
                    [
                        'code' => 'RVU',
                        'description' => 'RVU',
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
                        'description' => 'Secundary',
                    ],
                    [
                        'code' => 'T',
                        'description' => 'Tertiary',
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
