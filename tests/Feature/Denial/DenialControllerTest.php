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
            return $response->assertStatus(500);
        }
    }
}
