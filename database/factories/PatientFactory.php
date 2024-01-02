<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\MaritalStatus;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'code' => $this->faker->unique()->randomNumber(9),
            'driver_license' => null,
            'marital_status_id' => MaritalStatus::factory(),
            'profile_id' => Profile::factory(),
            'main_address_id' => $this->faker->randomNumber(3),
        ];
    }
}
