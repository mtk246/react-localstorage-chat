<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsuranceType;
use App\Models\InsuranceLabelFee;
use App\Models\Discriminatory;
use App\Models\Gender;

class ProcedureDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedureInsuranceTypes = [
            [
                'description' => 'Medicare',
                'insuranceLabelFees' => [
                    ['description' => 'Non facility price'],
                    ['description' => 'Facility price'],
                    ['description' => 'Non facility limiting charge'],
                    ['description' => 'Facility limiting charge']
                ]
            ],
            [
                'description' => 'Medicaid',
                'insuranceLabelFees' => [
                    ['description' => 'Facility rate'],
                    ['description' => 'Non facility rate']
                ]
            ],
        ];

        foreach ($procedureInsuranceTypes as $insuranceType) {
            $procedureInsuranceType = InsuranceType::firstOrCreate([
                'description' => $insuranceType['description']
            ], [
                'description' => $insuranceType['description']
            ]);

            foreach ($insuranceType['insuranceLabelFees'] as $insuranceLabelFee) {
                InsuranceLabelFee::firstOrCreate([
                    'description'       => $insuranceLabelFee['description'],
                    'insurance_type_id' => $procedureInsuranceType->id
                ], [
                    'description'       => $insuranceLabelFee['description'],
                    'insurance_type_id' => $procedureInsuranceType->id
                ]);
            }
        }

        $discriminatories = [
            ['description' => 'Greater or equal'],
            ['description' => 'Smaller or equal'],
            ['description' => 'Range']
        ];

        foreach ($discriminatories as $discriminatory) {
            Discriminatory::firstOrCreate($discriminatory);
        }

        $genders = [
            ['description' => 'Female'],
            ['description' => 'Male'],
            ['description' => 'Both']
        ];

        foreach ($genders as $gender) {
            Gender::firstOrCreate($gender);
        }
    }
}
