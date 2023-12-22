<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Models\BillingCompany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Claims\Claim>
 */
final class ClaimFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->uuid(),
            'type' => $this->faker->randomElement([1, 2]),
            'submitter_name' => $this->faker->name,
            'submitter_contact' => $this->faker->name,
            'submitter_phone' => $this->faker->phoneNumber,
            'aditional_information' => $this->faker->text,
        ];
    }

    private function withBillingCompany(): self
    {
        return $this->state(fn (array $attributes) => [
            'billing_company_id' => BillingCompany::factory(),
        ]);
    }
}
