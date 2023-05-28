<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PlaceOfService;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PlaceOfServiceFactory extends Factory
{

    protected $model = PlaceOfService::class;

    public function definition()
    {
        return [
            'code' => $this->faker->numberBetween(1, 90),
            'name' => $this->faker->name(),
            'description' => $this->faker->word(),
            'created_at' => $this->faker->date(),
        ];
    }
}
