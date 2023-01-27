<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\TypeCatalog;
use App\Models\PrivateNote;

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
                        'description' => '7 Dias'
                    ],
                    [
                        'code' => '15',
                        'description' => '15 Dias'
                    ],
                    [
                        'code' => '30',
                        'description' => '30 Dias'
                    ],
                    [
                        'code' => '45',
                        'description' => '45 Dias'
                    ],
                    [
                        'code' => '60',
                        'description' => '60 Dias'
                    ],
                    [
                        'code' => '90',
                        'description' => '90 Dias'
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
                'description' => 'From',
                'type_catalogs' => [
                    [
                        'code' => 'service_date',
                        'description' => 'Service'
                    ],
                    [
                        'code' => 'claim_date',
                        'description' => 'Claim generation'
                    ]
                ]
            ],
            [
                'description' => 'Billing incomplete reasons',
                'type_catalogs' => [
                    [
                        'code' => '00001',
                        'description' => "Missing patient date of birthday"
                    ],
                    [
                        'code' => '00002',
                        'description' => "Missing hospital admit date"
                    ],
                    [
                        'code' => '00003',
                        'description' => "Missing or deleted diagnosis"
                    ],
                    [
                        'code' => '00004',
                        'description' => "Authorized quantity exceeded"
                    ],
                    [
                        'code' => '00005',
                        'description' => "Missing sex in patient record"
                    ],
                    [
                        'code' => '00006',
                        'description' => "Missing last name in patient"
                    ],
                    [
                        'code' => '00007',
                        'description' => "Missing zip code in patient"
                    ],
                    [
                        'code' => '00008',
                        'description' => "Missing place of service"
                    ],
                    [
                        'code' => '00009',
                        'description' => "Missing type of service"
                    ],
                    [
                        'code' => '00010',
                        'description' => "Authorization required"
                    ],
                    [
                        'code' => '00011',
                        'description' => "Missing accident date on claim"
                    ],
                    [
                        'code' => '00012',
                        'description' => "Missing physician's provider"
                    ],
                    [
                        'code' => '00013',
                        'description' => "Pending insurance information"
                    ],
                    [
                        'code' => '00014',
                        'description' => "Change held by hold flag"
                    ],
                    [
                        'code' => '00015',
                        'description' => "Required application data"
                    ],
                    [
                        'code' => '00016',
                        'description' => "Missing clia number for lab"
                    ],
                    [
                        'code' => '00017',
                        'description' => "Missing patient policy number"
                    ],
                    [
                        'code' => '00018',
                        'description' => "Missing patient insuranace"
                    ],
                    [
                        'code' => '00019',
                        'description' => "Missing place of service"
                    ],
                    [
                        'code' => '00020',
                        'description' => "Missing upin for referring"
                    ],
                    [
                        'code' => '00021',
                        'description' => "Unassigned patient"
                    ],
                    [
                        'code' => '00022',
                        'description' => "Doctor is not contracted"
                    ],
                    [
                        'code' => '00023',
                        'description' => "Missing alpha on patient policy"
                    ],
                    [
                        'code' => '00024',
                        'description' => "Invalid patient policy"
                    ],
                    [
                        'code' => '00025',
                        'description' => "Accident diagnosis code req"
                    ],
                    [
                        'code' => '00026',
                        'description' => "Missing insured address"
                    ],
                    [
                        'code' => '00027',
                        'description' => "Diagnosis sex does not match"
                    ],
                    [
                        'code' => '00028',
                        'description' => "Procedure sex does not match"
                    ],
                    [
                        'code' => '00029',
                        'description' => "Missing referring thysician's"
                    ],
                    [
                        'code' => '00030',
                        'description' => "Missing condition date"
                    ],
                    [
                        'code' => '00031',
                        'description' => "Missing value code/amount"
                    ],
                    [
                        'code' => '00032',
                        'description' => "Missing upin# in sched/oth"
                    ],
                    [
                        'code' => '00033',
                        'description' => "Imput errors"
                    ],
                    [
                        'code' => '00034',
                        'description' => "Procedure code age limitation"
                    ],
                    [
                        'code' => '00035',
                        'description' => "Out of network"
                    ],
                    [
                        'code' => '00036',
                        'description' => "Missing insured dob or sex"
                    ],
                    [
                        'code' => '00037',
                        'description' => "Missing insurance /plan"
                    ],
                    [
                        'code' => '00038',
                        'description' => "Missing service physician or"
                    ],
                    [
                        'code' => '00039',
                        'description' => "Missing licence no for cervice"
                    ],
                    [
                        'code' => '00040',
                        'description' => "Missing documentation for"
                    ],
                    [
                        'code' => '00041',
                        'description' => "Authorization/access restricctions"
                    ],
                    [
                        'code' => '00042',
                        'description' => "Unable to respond at current time"
                    ],
                    [
                        'code' => '00043',
                        'description' => "Invelid/missing provider identification"
                    ],
                    [
                        'code' => '00044',
                        'description' => "Invalid/missing provider name"
                    ],
                    [
                        'code' => '00045',
                        'description' => "Invalid/missing provider specialty"
                    ],
                    [
                        'code' => '00046',
                        'description' => "Invalid/missing provider phone number"
                    ],
                    [
                        'code' => '00047',
                        'description' => "Invalid/missing provider state"
                    ],
                    [
                        'code' => '00048',
                        'description' => "Invalid/missing referring provider identification number"
                    ],
                    [
                        'code' => '00049',
                        'description' => "Provider not primary care physician"
                    ],
                    [
                        'code' => '00050',
                        'description' => "Provider ineligible for inquiries"
                    ],
                    [
                        'code' => '00051',
                        'description' => "Provider not on file"
                    ],
                    [
                        'code' => '00052',
                        'description' => "Service date not within provider plan enrollment"
                    ],
                    [
                        'code' => '00053',
                        'description' => "Inquired benefit inconsistent with provider type"
                    ],
                    [
                        'code' => '00054',
                        'description' => "Inappropriate product/service id qualifier"
                    ],
                    [
                        'code' => '00055',
                        'description' => "Inappropriate product/service id "
                    ],
                    [
                        'code' => '00056',
                        'description' => "Inappropriate date"
                    ],
                    [
                        'code' => '00057',
                        'description' => "Invalid/missing dos"
                    ],
                    [
                        'code' => '00058',
                        'description' => "Invalid/missing date-of-birth (dob)"
                    ],
                    [
                        'code' => '00059',
                        'description' => "Invalid/missing dat of death"
                    ],
                    [
                        'code' => '00060',
                        'description' => "Date of birth follows date(s) of service"
                    ],
                    [
                        'code' => '00061',
                        'description' => "Date of death precedes date(s) of service"
                    ],
                    [
                        'code' => '00062',
                        'description' => "Dos not within allowable inquiry period"
                    ],
                    [
                        'code' => '00063',
                        'description' => "Dos in the future"
                    ],
                    [
                        'code' => '00064',
                        'description' => "Invalid/missing patient id"
                    ],
                    [
                        'code' => '00065',
                        'description' => "Invalid/missing patient name"
                    ],
                    [
                        'code' => '00066',
                        'description' => "Invalid/missing patient gender code"
                    ],
                    [
                        'code' => '00067',
                        'description' => "Patient not found"
                    ],
                    [
                        'code' => '00068',
                        'description' => "Duplicate patient id number"
                    ],
                    [
                        'code' => '00069',
                        'description' => "Inconsistent with patient's age"
                    ],
                    [
                        'code' => '00070',
                        'description' => "Inconsistent with patient's gender"
                    ],
                    [
                        'code' => '00071',
                        'description' => "Patient birth date does not match that for  the patient on the database"
                    ],
                    [
                        'code' => '00072',
                        'description' => "Invalid/missing subscriber/insured id"
                    ],
                    [
                        'code' => '00073',
                        'description' => "Invalid/missing subscriber/insured name"
                    ],
                    [
                        'code' => '00074',
                        'description' => "Invalid/missing subscriber/insured gender code"
                    ],
                    [
                        'code' => '00075',
                        'description' => "Subscriber/insured not found"
                    ],
                    [
                        'code' => '00076',
                        'description' => "Duplicate subscriber/insured id number"
                    ],
                    [
                        'code' => '00077',
                        'description' => "Subscriber found: patient not found"
                    ],
                    [
                        'code' => '00078',
                        'description' => "Subscriber /insured not in group/plan identified"
                    ],
                    [
                        'code' => '00079',
                        'description' => "Invalid participant identification"
                    ],
                    [
                        'code' => '00080',
                        'description' => "No response received - transaction terminated"
                    ],
                    [
                        'code' => 'AF',
                        'description' => "Invalid/missing diagnoses code(s)"
                    ],
                    [
                        'code' => 'AG',
                        'description' => "Invalid/missing procedure code(s)"
                    ],
                    [
                        'code' => 'IA',
                        'description' => "Invalid authorization number format"
                    ],
                    [
                        'code' => 'MA',
                        'description' => "Missing authorization number"
                    ],
                    [
                        'code' => 'T4',
                        'description' => "Payer name or identifier missing"
                    ],
                    [
                        'code' => '00081',
                        'description' => "Missing value code and value"
                    ],
                    [
                        'code' => '00082',
                        'description' => "Missing admission hour"
                    ],
                    [
                        'code' => '00083',
                        'description' => "Referring physician name"
                    ],
                    [
                        'code' => '00084',
                        'description' => "Missing claim scrubber info"
                    ],
                    [
                        'code' => '00085',
                        'description' => "Referring physician pcn"
                    ],
                    [
                        'code' => '00086',
                        'description' => "Missing or incorrect render"
                    ],
                    [
                        'code' => '00087',
                        'description' => "Missing or incorrect payto"
                    ],
                    [
                        'code' => '00088',
                        'description' => "Missing or incorrect referring"
                    ]
                ]
            ],
            [
                'description' => 'Appeal reasons',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Any denial that involves a determination that a treatment is experimental or investigational'
                    ],
                    [
                        'code' => '2',
                        'description' => 'Any denial that involves medical judgment where you or your provider may disagree with the health insurance plan'
                    ],
                    [
                        'code' => '3',
                        'description' => 'The benefit is not offered under your health plan'
                    ],
                    [
                        'code' => '4',
                        'description' => 'Your medical problem began before you joined the plan'
                    ],
                    [
                        'code' => '5',
                        'description' => 'You received health services from a health provider or facility that is not in your plan is approved network'
                    ],
                    [
                        'code' => '6',
                        'description' => 'The requested service or treatment is not medically necessary'
                    ],
                    [
                        'code' => '7',
                        'description' => 'The requested service or treatment is an experimental or investigative treatment'
                    ],
                    [
                        'code' => '8',
                        'description' => 'You are no longer enrolled or eligible to be enrolled in the health plan'
                    ],
                    [
                        'code' => '9',
                        'description' => 'It is revoking or canceling your coverage going back to the date you enrolled because the insurance company claims that you gave false or incomplete information when you applied for coverage'
                    ],
                    [
                        'code' => '10',
                        'description' => 'Any denial that involves medical judgment where you or your provider may disagree with the health insurance plan'
                    ],
                    [
                        'code' => '11',
                        'description' => 'Any denial that involves a determination that a treatment is experimental or investigational'
                    ],
                    [
                        'code' => '12',
                        'description' => 'Cancellation of coverage based on your insurer is claim that you gave false or incomplete information when you applied for coverage'
                    ]
                ]
            ],
            [
                'description' => 'Payer ID',
                'type_catalogs' => [
                    [
                        'code' => '13162',
                        'description' => '1199 National Benefit Fund'
                    ],
                    [
                        'code' => '36273',
                        'description' => 'AARP'
                    ],
                    [
                        'code' => '68069',
                        'description' => 'Absolute Total Care'
                    ],
                    [
                        'code' => '22384',
                        'description' => 'Administrative Concepts'
                    ],
                    [
                        'code' => '68069',
                        'description' => 'Advantage By Buckeye'
                    ],
                    [
                        'code' => '60054',
                        'description' => 'AETNA'
                    ],
                    [
                        'code' => '128CA',
                        'description' => 'Aetna Better Health of California'
                    ],
                    [
                        'code' => '68024',
                        'description' => 'Aetna Better Health of Illinois – Medicaid'
                    ],
                    [
                        'code' => '26337',
                        'description' => 'Aetna Better Health of Illinois – Medicare'
                    ]
                ]
            ],
            [
                'description' => 'Statement rule',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Send to all'
                    ],
                    [
                        'code' => '2',
                        'description' => 'Send to none'
                    ],
                    [
                        'code' => '3',
                        'description' => 'Send if plan is'
                    ],
                    [
                        'code' => '4',
                        'description' => 'Do not send if plan is'
                    ],
                    [
                        'code' => '5',
                        'description' => 'Send on payment'
                    ]
                ]
            ],
            [
                'description' => 'Statement when',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'When registering the payment'
                    ],
                    [
                        'code' => '2',
                        'description' => 'In a defined period'
                    ],
                    [
                        'code' => '3',
                        'description' => 'Specific date'
                    ]
                ]
            ],
            [
                'description' => 'Statement apply to',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'Apply to 1'
                    ],
                    [
                        'code' => '2',
                        'description' => 'Apply to 2'
                    ]
                ]
            ],
            [
                'description' => 'Name suffix',
                'type_catalogs' => [
                    [
                        'code' => 'I',
                        'description' => 'I'
                    ],
                    [
                        'code' => 'II',
                        'description' => 'II'
                    ],
                    [
                        'code' => 'III',
                        'description' => 'III'
                    ],
                    [
                        'code' => 'IV',
                        'description' => 'IV'
                    ],
                    [
                        'code' => 'Jr',
                        'description' => 'Jr'
                    ],
                    [
                        'code' => 'Sr',
                        'description' => 'Sr'
                    ],
                ]
            ],
            [
                'description' => 'Transmission format',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => 'JSON'
                    ],
                    [
                        'code' => '2',
                        'description' => 'ANSI X12'
                    ]
                ]
            ],
            [
                'description' => 'Claim field information',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '14. Date of current illnes, injury or pregnancy (LMP)'
                    ],
                    [
                        'code' => '2',
                        'description' => '15. Other date'
                    ],
                    [
                        'code' => '3',
                        'description' => '16. Dates patient unable to work in current occupation'
                    ],
                    [
                        'code' => '4',
                        'description' => '18. Hospitalization dates related to current services'
                    ],
                    [
                        'code' => '5',
                        'description' => '19. Additional claim information (Designated by NUCC)'
                    ]
                ]
            ],
            [
                'description' => 'Claim field information',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '14. Date of current illnes, injury or pregnancy (LMP)'
                    ],
                    [
                        'code' => '2',
                        'description' => '15. Other date'
                    ],
                    [
                        'code' => '3',
                        'description' => '16. Dates patient unable to work in current occupation'
                    ],
                    [
                        'code' => '4',
                        'description' => '18. Hospitalization dates related to current services'
                    ],
                    [
                        'code' => '5',
                        'description' => '19. Additional claim information (Designated by NUCC)'
                    ]
                ]
            ],
            [
                'description' => '14. Date of current illnes, injury or pregnancy (LMP)',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '14. Date 1'
                    ],
                    [
                        'code' => '2',
                        'description' => '14. Date 2'
                    ]
                ]
            ],
            [
                'description' => '15. Other date',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '15 Date 1'
                    ],
                    [
                        'code' => '2',
                        'description' => '15 Date 2'
                    ]
                ]
            ],
            [
                'description' => '16. Dates patient unable to work in current occupation',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '16 Date 1'
                    ],
                    [
                        'code' => '2',
                        'description' => '16 Date 2'
                    ]
                ]
            ],
            [
                'description' => '18. Hospitalization dates related to current services',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '18. Date 1'
                    ],
                    [
                        'code' => '2',
                        'description' => '18. Date 2'
                    ],
                    [
                        'code' => '5',
                        'description' => '19. Additional claim information (Designated by NUCC)'
                    ]
                ]
            ],
            [
                'description' => '19. Additional claim information (Designated by NUCC)',
                'type_catalogs' => [
                    [
                        'code' => '1',
                        'description' => '19. Additional 1'
                    ],
                    [
                        'code' => '2',
                        'description' => '19. Additional 2'
                    ]
                ]
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
                            'code'        => $typeCatalog['code'],
                            'description' => $typeCatalog['description'],
                            'type_id'     => $typeC->id
                        ],
                        [
                            'code'        => $typeCatalog['code'],
                            'description' => $typeCatalog['description']
                        ]
                    );

                    if ($type['description'] == 'Appeal reasons') {
                        PrivateNote::updateOrCreate([
                            'publishable_type'   => TypeCatalog::class,
                            'publishable_id'     => $catalog->id,
                            "billing_company_id" => null,
                        ], [
                            'note'             => $appealRules,
                        ]);
                    }
                }
            }
        }
    }
}