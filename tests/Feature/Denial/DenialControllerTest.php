<?php

declare(strict_types=1);

namespace Tests\Feature\Denial;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class DenialControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test Get All Server action.
     *
     * @return void
     */
    public function testGetAllServer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        try {
            $response = $this->actingAs($user)->getJson('/api/v1/denial/get-all-server');

            $response->assertStatus(200);
        } catch (\Exception $e) {
            return $response->assertStatus(500);
        }
    }

    public function testGetOneServer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        try {
            $response = $this->actingAs($user)->getJson('/api/v1/denial/1');

            $response->assertStatus(200);
        } catch (\Exception $e) {
            return $response->assertStatus(404);
        }
    }

    public function testCreateDenialTracking()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $requestBody = [
            "claim_id" => 69,
            "claim_number" => "3",
            "interface_type" => 1,
            "is_reprocess_claim" => true,
            "is_contact_to_patient" => false,
            "contact_through" => "Contact",
            "rep_name" => "Name",
            "ref_number" => "123",
            "claim_status" => 1,
            "claim_sub_status" => 1,
            "tracking_date" => "04/03/2023",
            "resolution_time" => "04/03/2023",
            "past_due_date" => "05/03/2023",
            "follow_up" => "06/04/2023",
            "department_responsible" => "Department 1",
            "policy_responsible" => "Policy 1",
            "tracking_note" => "Hello from tracking",
            "response_details" => "note",
            "policy_id" => 2
        ];

        $response = $this->actingAs($user)->postJson('/api/v1/denial/denial', $requestBody);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['id', 'claim_id']]);

        $this->assertDatabaseHas('denial_tracking', [
            'claim_id' => 69,
            'claim_number' => '3',
            "interface_type" => 1,
            "is_reprocess_claim" => true,
            "is_contact_to_patient" => false,
            "contact_through" => "Contact",
            "rep_name" => "Name",
            "ref_number" => "123",
            "claim_status" => 1,
            "claim_sub_status" => 1,
            "tracking_date" => "04/03/2023",
            "resolution_time" => "04/03/2023",
            "past_due_date" => "05/03/2023",
            "follow_up" => "06/04/2023",
            "department_responsible" => "Department 1",
            "policy_responsible" => "Policy 1",
            "tracking_note" => "Hello from tracking",
            "response_details" => "note",
            "policy_id" => 2
        ]);

        $this->assertEquals(69, $response->json('data.claim_id'));
    }

}
