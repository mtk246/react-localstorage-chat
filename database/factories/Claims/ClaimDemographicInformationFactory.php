<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Models\Claims\Claim;
use App\Models\Company;
use App\Models\HealthProfessional;
use App\Models\InsurancePolicy;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Claims\ClaimDemographicInformation>
 */
final class ClaimDemographicInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'charges' => $this->faker->randomNumber(2),
            'accept_assignment' => $this->faker->randomElement([0, 1]),
            'patient_signature' => $this->faker->randomElement([0, 1]),
            'insured_signature' => $this->faker->randomElement([0, 1]),
            'outside_lab' => $this->faker->randomElement([0, 1]),
            'employment_related_condition' => $this->faker->randomElement([0, 1]),
            'auto_accident_related_condition' => $this->faker->randomElement([0, 1]),
            'other_accident_related_condition' => $this->faker->randomElement([0, 1]),
            'validate' => $this->faker->randomElement([0, 1]),
            'automatic_eligibility' => $this->faker->randomElement([0, 1]),
        ];
    }

    private function withClaim(): self
    {
        return $this->state(fn (array $attributes) => [
            'claim_id' => Claim::factory(),
        ]);
    }

    private function withCompany(): self
    {
        return $this->state(fn (array $attributes) => [
            'company_id' => Company::factory(),
        ]);
    }

    private function withPatient(): self
    {
        return $this->state(fn (array $attributes) => [
            'patient_id' => Patient::factory(),
        ]);
    }

    private function withHealthProfessional(): self
    {
        return $this->state(fn (array $attributes) => [
            'health_professional_id' => HealthProfessional::factory(),
        ]);
    }

    private function withInsurancePolicy(): self
    {
        return $this->state(fn (array $attributes) => [
            'insurance_policy_id' => InsurancePolicy::factory(),
        ]);
    }
}
