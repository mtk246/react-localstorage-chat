<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use App\Models\HealthProfessional;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
final class HealthProfessionalFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'npi' => $this->faker->uuid,
            'is_provider' => $this->faker->randomElement([true, false]),
        ];
    }

    private function withProfile(): self
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => Profile::factory(),
        ]);
    }

    private function withCompany(): self
    {
        return $this->state(fn (array $attributes) => [
            'company_id' => Company::factory(),
        ]);
    }
}
