<?php

declare(strict_types=1);

namespace Tests\Feature\Procedure;

use App\Models\Procedure;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ProcedureControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItCreateProcedure()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'code' => 'Code procedure 1',
            'short_description' => 'Description procedure 1',
            'description' => 'long and detailed description of procedure 1',
            'insurance_companies' => [1, 2],
            'specific_insurance_company' => true,
            'start_date' => '2022-07-05',
            'end_date' => '2022-07-06',
            'type' => 1,
            'clasifications' => [
                'general' => 1,
                'specific' => 3,
                'sub_specific' => null,
            ],
            'mac_localities' => [
                [
                    'modifier_id' => 1,
                    'mac' => '02102',
                    'locality_number' => '01',
                    'state' => 'ALASKA',
                    'fsa' => 'STATEWIDE',
                    'counties' => 'ALL COUNTIES',
                    'procedure_fees' => [
                        'non_facility_price' => '190.20',
                        'facility_price' => '136.50',
                        'non_facility_limiting_charge' => '60.50',
                        'facility_limiting_charge' => '190.00',
                        'facility_rate' => '200.10',
                        'non_facility_rate' => '55.90',
                    ],
                ],
            ],
            'procedure_considerations' => [
                'gender_id' => 1,
                'age_init' => '2020',
                'age_end' => null,
                'discriminatory_id' => 1,
                'frequent_diagnoses' => [1, 2],
                'frequent_modifiers' => [1, 2],
                'claim_note' => true,
                'supervisor' => 0,
                'authorization' => null,
            ],
            'note' => 'Note procedure 1',
        ];

        $response = $this->actingAs($user)->post(route('procedure.create-procedure'), $data);

        $response->assertSessionHasErrors([
            'mac_localities' => 'Error, cannot register a price without assigning a mac locality',
        ]);

        $response->assertStatus(302);
    }

    public function testItUpdateProcedure()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $procedure = Procedure::factory()->create();

        $data = [
            'code' => 'Code procedure 1',
            'short_description' => 'Description procedure 1',
            'description' => 'long and detailed description of procedure 1',
            'insurance_companies' => [1, 2],
            'specific_insurance_company' => true,
            'start_date' => '2022-07-05',
            'end_date' => '2022-07-06',
            'type' => 1,
            'clasifications' => [
                'general' => 1,
                'specific' => 3,
                'sub_specific' => null,
            ],
            'mac_localities' => [
                [
                    'modifier_id' => 1,
                    'mac' => '02102',
                    'locality_number' => '01',
                    'state' => 'ALASKA',
                    'fsa' => 'STATEWIDE',
                    'counties' => 'ALL COUNTIES',
                    'procedure_fees' => [
                        'non_facility_price' => '190.20',
                        'facility_price' => '136.50',
                        'non_facility_limiting_charge' => '60.50',
                        'facility_limiting_charge' => '190.00',
                        'facility_rate' => '200.10',
                        'non_facility_rate' => '55.90',
                    ],
                ],
            ],
            'procedure_considerations' => [
                'gender_id' => 1,
                'age_init' => '2020',
                'age_end' => null,
                'discriminatory_id' => 1,
                'frequent_diagnoses' => [1, 2],
                'frequent_modifiers' => [1, 2],
                'claim_note' => true,
                'supervisor' => 0,
                'authorization' => null,
            ],
            'note' => 'Note procedure 1',
        ];

        $response = $this->actingAs($user)->putJson('/api/v1/procedure/'.$procedure->id, $data);

        $response->assertJson([
            'message' => 'Error, cannot register a price without assigning a mac locality',
            'errors' => [
                'mac_localities' => [
                    'Error, cannot register a price without assigning a mac locality',
                ],
            ],
        ]);

        $response->assertStatus(422);
    }

    public function testItGetAllProcedures()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/');

        $response->assertStatus(200);
    }

    public function testItGetServerAll()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/get-all-server');

        $response->assertStatus(200);
    }

    public function testItGetMacLocalitiesLists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/get-list-mac-localities');

        $response->assertStatus(200);
    }

    public function testItGetGenderLists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/get-list-genders');

        $response->assertStatus(200);
    }

    public function testItGetDiscriminatoryLists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/get-list-discriminatories');

        $response->assertStatus(200);
    }

    public function testItGetInsuranceLabelFees()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/get-list-insurance-label-fees');

        $response->assertStatus(200);
    }

    public function testItGetType()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/type');

        $response->assertStatus(200);
    }

    public function testItGetInsuranceCompanyLists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->actingAs($user)->getJson('/api/v1/procedure/get-list-insurance-companies');

        $response->assertStatus(200);
    }
}
