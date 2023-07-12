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

        FacilityType::where('type', $type->id)->delete();

        // Estructura para la nueva logica de bill classifications
        $bill_classification = [
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
        ];

        BillClassification::insert($bill_classification);

        $facility_type = FacilityType::all();

        foreach ($facility_type as $type) {
            if ($type->id <= 6) {
                $type->bill_classifications()->attach([1, 2, 3, 4, 5, 6, 7, 8, 21]);
            }

            if (7 == $type->id) {
                $type->bill_classifications()->attach([9, 10, 11, 12, 13, 14, 21]);
            }

            if (8 == $type->id) {
                $type->bill_classifications()->attach([15, 16, 17, 18, 19, 20, 21]);
            }
        }

        dd($facility_type[0]->bill_classifications);
    }
}
