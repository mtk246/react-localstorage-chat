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
        $bill_classifications = collect([
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
        ]);

        $bill_ids = $bill_classifications->map(fn ($item) => [
            BillClassification::create(['name' => $item['name']])->id,
        ]);

        $ids = [];

        foreach ($bill_ids as $value) {
            array_push($ids, $value[0]);
        }

        $facility_type = FacilityType::all();

        foreach ($facility_type as $type) {
            if ($type->id <= 6) {
                $current_ids = array_slice($ids, 0, 8, true);
                $type->bill_classifications()->attach($current_ids);
                $type->bill_classifications()->attach(end($ids));
            }

            if (7 == $type->id) {
                $current_ids = array_slice($ids, 8, 6, true);
                $type->bill_classifications()->attach($current_ids);
                $type->bill_classifications()->attach(end($ids));
            }

            if (8 == $type->id) {
                $current_ids = array_slice($ids, 14, 7, true);
                $type->bill_classifications()->attach($current_ids);
            }
        }
    }
}
