<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
final class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
            'country' => $this->faker->country,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
            'apt_suite' => $this->faker->text,
        ];
    }

    public function withAddressType(): self
    {
        return $this->state(fn (array $attributes) => [
            'address_type_id' => AddressType::tryFrom($this->faker->randomElement([1, 2, 3]))->value,
        ]);
    }
}
