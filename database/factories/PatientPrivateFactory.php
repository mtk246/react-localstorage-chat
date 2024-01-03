<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillingCompany;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientPrivate>
 */
final class PatientPrivateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reference_num' => $this->faker->randomDigit(),
            'patient_num' => $this->faker->randomDigit(),
            'med_num' => $this->faker->randomDigit(),
            'billing_company_id' => BillingCompany::factory(),
        ];
    }

    private function withPatient(): self
    {
        return $this->state(fn (array $attributes) => [
            'patient_id' => Patient::factory(),
        ]);
    }
}
