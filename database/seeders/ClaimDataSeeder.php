<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeForm;
use App\Models\StatusClaim;

class ClaimDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeForms = [
            ['form' => '837P'],
            ['form' => '837I'],
        ];

        foreach ($typeForms as $form) {

            TypeForm::updateOrCreate($form, $form);

        }

        $statusClaims = [
            ['status' => 'Draft'],
            ['status' => 'Verified - Not submitted'],
            ['status' => 'Submitted - In approval'],
            ['status' => 'Accepted - Pending adjudication'],
            ['status' => 'Approved - Finished'],
            ['status' => 'Rejected'],
            ['status' => 'Denied - Under Review'],
            ['status' => 'Denied - Finished']
        ];

        foreach ($statusClaims as $status) {

            StatusClaim::updateOrCreate($status, $status);

        }
    }
}
