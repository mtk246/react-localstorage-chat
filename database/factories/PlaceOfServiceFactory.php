<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PlaceOfService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaceOfService>
 */
final class PlaceOfServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlaceOfService::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->numberBetween(1,90),
            'name' => $this->faker->name(),
            'description' => $this->faker->word(),
            'created_at' => $this->faker->date()
        ];
    }
}
