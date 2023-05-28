<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillingCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

final class BillingCompanyFactory extends Factory
{

    protected $model = BillingCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->boolean(),
        ];
    }
}
