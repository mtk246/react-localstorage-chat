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
                ['code' => '1', 'name' => 'Inpatient (Including Medicare Part A)'],
                ['code' => '2', 'name' => 'Inpatient (Medicare Part B Only)'],
                ['code' => '3', 'name' => 'Outpatient'],
                ['code' => '4', 'name' => 'Other (for Hospital Referenced Diagnostic Services, or Home Health Not Under Plan of Treatment)'],
                ['code' => '5', 'name' => 'Intermediate Care - Level I'],
                ['code' => '6', 'name' => 'Intermediate Care - Level II'],
                ['code' => '7', 'name' => 'Subacute Inpatient (Revenue Code 019X Required)'],
                ['code' => '8', 'name' => 'Swing Beds '],

                ['code' => '1', 'name' => 'Rural Health'],
                ['code' => '2', 'name' => 'Hospital Based or Independent Renal Dialysis Center'],
                ['code' => '3', 'name' => 'Free-standing'],
                ['code' => '4', 'name' => 'Outpatient Rehabilitation Facility (ORF)'],
                ['code' => '5', 'name' => 'Comprehensive Outpatient Rehabilitation Facilities (CORFS)'],
                ['code' => '6', 'name' => 'Community Mental Health Center (CMHC)'],

                ['code' => '1', 'name' => 'Hospice (Non-Hospital Based)'],
                ['code' => '2', 'name' => 'Hospice (Hospital Based)'],
                ['code' => '3', 'name' => 'Ambulatory Surgery Center'],
                ['code' => '4', 'name' => 'Free Standing Birthing Center'],
                ['code' => '5', 'name' => 'CAH (Critical Access Hospital) / Rural Primary Care Hospital'],
                ['code' => '6', 'name' => 'Residential Facility (not used for Medicare)'],

                ['code' => '9', 'name' => 'Other'],
            ],
        ];

        $facility_type_1 = FacilityType::whereIn('type', array_slice($data['facility_types'], 0, 6))->pluck('id')->toArray();
        $facility_type_2 = FacilityType::where('type', $data['facility_types'][6])->first();
        $facility_type_3 = FacilityType::where('type', $data['facility_types'][7])->first();

        foreach ($data['bill_classifications'] as $key => $value) {
            if ($key <= 7) {
                $bill_classification = BillClassification::updateOrCreate([
                    'code' => $value['code'], 'name' => $value['name'],
                ], $value);
                $bill_classification->facilityTypes()->attach($facility_type_1);
            }

            if ($key >= 8 && $key <= 13) {
                $bill_classification = BillClassification::updateOrCreate([
                    'code' => $value['code'], 'name' => $value['name'],
                ], $value);
                $bill_classification->facilityTypes()->attach($facility_type_2);
            }

            if ($key >= 14 && $key <= 19) {
                $bill_classification = BillClassification::updateOrCreate([
                    'code' => $value['code'], 'name' => $value['name'],
                ], $value);
                $bill_classification->facilityTypes()->attach($facility_type_3);
            }

            if (20 == $key) {
                $bill_classification = BillClassification::updateOrCreate([
                    'code' => $value['code'], 'name' => $value['name'],
                ], $value);
                $bill_classification->facilityTypes()->attach([$facility_type_2->id, $facility_type_3->id]);
            }
        }
    }
}
