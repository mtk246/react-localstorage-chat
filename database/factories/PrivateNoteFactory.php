<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrivateNote>
 */
final class PrivateNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'note' => $this->faker->sentence(),
            'billing_company_id' => null,
            'publishable_type' => 'App\Models\Patient',
            'publishable_id' => $this->faker->randomNumber(3),
        ];
    }
}
