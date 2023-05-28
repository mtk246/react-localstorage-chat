<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FacilityType;
use Illuminate\Database\Eloquent\Factories\Factory;

final class FacilityTypeFactory extends Factory
{

    protected $model = FacilityType::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['01 - Clinics', '02 - Hospitals', '03 - Labs']),
        ];
    }
}
