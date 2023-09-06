<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InsuranceCompany;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InsuranceCompany>
 *
 * @todo: enum
 */
final class InsuranceCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => generateNewCode('IC', 5, date('Y'), InsuranceCompany::class, 'code'),
            'name' => $this->faker->company,
            'naic' => $this->faker->randomNumber(5),
            'payer_id' => $this->faker->randomNumber(2),
            'file_method_id' => TypeCatalog::factory(),
        ];
    }
}
