<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

final class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'code' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'npi' => $this->faker->word(),
        ];
    }
}
