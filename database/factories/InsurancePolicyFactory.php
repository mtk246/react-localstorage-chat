<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InsurancePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InsurancePolicy>
 */
final class InsurancePolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'policy_number' => $this->faker->uuid,
            'release_info' => $this->faker->randomElement([true, false]),
            'assign_benefits' => $this->faker->randomElement([true, false]),
            'status' => $this->faker->randomElement([true, false]),
            'own' => $this->faker->randomElement([true, false]),
            'dual_plan' => $this->faker->randomElement([true, false]),
        ];
    }

    private function withInsurancePlan(): self
    {
        return $this->state(fn (array $attributes) => [
            'insurance_plan_id' => InsurancePlan::factory(),
        ]);
    }
}
