<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
final class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'drivers_license' => $this->faker->text,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
            'code' => Str::uuid(),``
        ];
    }

    public function withProfile(): self
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => Profile::factory(),
        ]);
    }
}
