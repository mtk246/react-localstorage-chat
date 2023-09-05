<?php

declare(strict_types=1);

namespace Tests\Feature\Claims;

use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;
use App\Models\InsurancePlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RulesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itReturnsAJsonResponseContainingAllRulesForTheAuthenticatedUser()
    {
        // Arrange
        $user = $this->createUser('superuser');
        $rules1 = Rules::factory()->create(['billing_company_id' => $user->billing_company_id]);
        $rules2 = Rules::factory()->create(['billing_company_id' => $user->billing_company_id]);

        // Act
        $response = $this->actingAs($user)->get(route('rules.index'));

        // Assert
        $response->assertOk();
        $response->assertJsonCount(2);
        $response->assertJsonFragment([
            'id' => $rules1->id,
            'name' => $rules1->name,
            'description' => $rules1->description,
            'insurance_plan' => $rules1->insurancePlan->toArray(),
            'format' => $rules1->format->value,
        ]);
        $response->assertJsonFragment([
            'id' => $rules2->id,
            'name' => $rules2->name,
            'description' => $rules2->description,
            'insurance_plan' => $rules2->insurancePlan->toArray(),
            'format' => $rules2->format->value,
        ]);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingASingleRule()
    {
        // Arrange
        $user = $this->createUser('superuser');
        $rules = Rules::factory()->create(['billing_company_id' => $user->billing_company_id]);
        $ruleResource = new RuleResource($rules);

        // Act
        $response = $this->actingAs($user)->get(route('rules.show', $rules->id));

        // Assert
        $response->assertOk();
        $response->assertJson($ruleResource->response()->getData(true)['data']);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingNewCreatedRule()
    {
        // Arrange
        $user = $this->createUser('superuser');
        $insurancePlan = InsurancePlan::factory()->create();
        $rules = Rules::factory()->create([
            'name' => 'test test test',
            'format' => 'institutional',
            'billing_company_id' => $user->billing_company_id,
        ]);
        $createRulesRequest = [
            'name' => 'test test test',
            'description' => 'test description',
            'format' => $rules->format->value,
            'billing_company_id' => $rules->billing_company_id,
            'insurance_plan_id' => $insurancePlan->id,
            'rules' => [
                'file' => [
                    '1a' => ['demographicInformation.company.name'],
                ],
            ],
        ];

        // Act
        $response = $this->actingAs($user)->post(route('rules.store'), $createRulesRequest);

        $newRules = new RuleResource(Rules::query()->find($response->json()['id']));
        // Assert
        $response->assertOk();
        $response->assertJsonFragment($newRules->response()->getData(true)['data']);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingTheUpdatedRule()
    {
        // Arrange
        $user = $this->createUser('superuser');
        $insurancePlan = InsurancePlan::factory()->create();
        $rules = Rules::factory()->create([
            'name' => 'test test test',
            'format' => 'institutional',
            'billing_company_id' => $user->billing_company_id,
        ]);
        $updateRulesRequest = [
            'name' => 'update test',
            'description' => 'update description',
            'format' => $rules->format->value,
            'billing_company_id' => $rules->billing_company_id,
            'insurance_plan_id' => $insurancePlan->id,
            'rules' => [
                'file' => [
                    '1a' => ['demographicInformation.company.name'],
                ],
            ],
        ];

        // Act
        $response = $this->actingAs($user)->put(route('rules.update', $rules), $updateRulesRequest);

        $updatedRules = new RuleResource(Rules::find($rules->id));
        // Assert
        $response->assertOk();
        $response->assertJsonFragment($updatedRules->response()->getData(true)['data']);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingTheDeletedRule()
    {
        // Arrange
        $user = $this->createUser('superuser');
        $rules = Rules::factory()->create(['billing_company_id' => $user->billing_company_id]);

        // Act
        $response = $this->actingAs($user)->delete(route('rules.destroy', $rules));

        // Assert
        $response->assertOk();
        $this->assertDatabaseMissing('claim_rules', ['id' => $rules->id]);
    }
}
