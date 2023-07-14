<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BillClassification;
use App\Models\FacilityType;
use App\Models\Type;
use App\Models\TypeCatalog;
use Illuminate\Database\Seeder;

final class BillClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = Type::updateOrCreate(['description' => 'Bill classification']);
        collect(json_decode(\File::get('database/data/claim/BillClassifications.json')))
            ->chunk(1000)
            ->each(function ($chunk) use ($type) {
                $chunk->each(function ($item) use ($type) {
                    TypeCatalog::updateOrCreate(
                        [
                            'code' => $item->code,
                            'description' => $item->description,
                            'type_id' => $type->id,
                        ],
                        [
                            'code' => $item->code,
                            'description' => $item->description,
                        ]
                    );
                });
            });

        // Estructura para la nueva logica de bill classifications
        $data = [
            'facility_types' => [
                'Hospital',
                'Skilled Nursing',
                'Home Health',
                'Christian Science (Hospital)',
                'Christian Science (Extended Care)',
                'Intermediate Care',
                'Clinic ',
                'Special Facility or Hospital ASC Surgery',
            ],
            'bill_classifications' => [
                ['name' => 'Inpatient (Including Medicare Part A)'],
                ['name' => 'Inpatient (Medicare Part B Only)'],
                ['name' => 'Outpatient'],
                ['name' => 'Other (for Hospital Referenced Diagnostic Services, or Home Health Not Under Plan of Treatment)'],
                ['name' => 'Intermediate Care - Level I'],
                ['name' => 'Intermediate Care - Level II'],
                ['name' => 'Subacute Inpatient (Revenue Code 019X Required)'],
                ['name' => 'Swing Beds '],

                ['name' => 'Rural Health'],
                ['name' => 'Hospital Based or Independent Renal Dialysis Center'],
                ['name' => 'Free-standing'],
                ['name' => 'Outpatient Rehabilitation Facility (ORF)'],
                ['name' => 'Comprehensive Outpatient Rehabilitation Facilities (CORFS)'],
                ['name' => 'Community Mental Health Center (CMHC)'],

                ['name' => 'Hospice (Non-Hospital Based)'],
                ['name' => 'Hospice (Hospital Based)'],
                ['name' => 'Ambulatory Surgery Center'],
                ['name' => 'Free Standing Birthing Center'],
                ['name' => 'CAH (Critical Access Hospital) / Rural Primary Care Hospital'],
                ['name' => 'Residential Facility (not used for Medicare)'],

                ['name' => 'Other'],
            ],
        ];

        $facility_type_1 = FacilityType::whereIn('type', array_slice($data['facility_types'], 0, 6))->pluck('id')->toArray();
        $facility_type_2 = FacilityType::where('type', $data['facility_types'][6])->first();
        $facility_type_3 = FacilityType::where('type', $data['facility_types'][7])->first();

        foreach ($data['bill_classifications'] as $key => $value) {
            if ($key <= 7) {
                $bill_classification = BillClassification::create($value);
                $bill_classification->facility_types()->attach($facility_type_1);
            }

            if ($key >= 8 && $key <= 13) {
                $bill_classification = BillClassification::create($value);
                $bill_classification->facility_types()->attach($facility_type_2);
            }

            if ($key >= 14 && $key <= 19) {
                $bill_classification = BillClassification::create($value);
                $bill_classification->facility_types()->attach($facility_type_3);
            }

            if (20 == $key) {
                $bill_classification = BillClassification::create($value);
                $bill_classification->facility_types()->attach(FacilityType::all());
            }
        }
    }
}
