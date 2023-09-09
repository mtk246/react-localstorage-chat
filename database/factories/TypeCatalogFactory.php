<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeCatalog>
 */
final class TypeCatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text(12),
            'description' => $this->faker->text(64),
            'status' => $this->faker->boolean,
            'type_id' => Type::factory(),
        ];
    }
}
