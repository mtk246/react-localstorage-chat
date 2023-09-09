<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Enums\Claim\RuleFormatType;
use App\Models\BillingCompany;
use App\Models\InsurancePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Claims\Rules>
 */
final class RulesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(12),
            'format' => $this->faker->randomElement(RuleFormatType::cases()),
            'description' => $this->faker->text(64),
            'billing_company_id' => BillingCompany::factory(),
            'insurance_plan_id' => InsurancePlan::factory(),
            'rules' => '[]',
            'parameters' => '',
        ];
    }
}
