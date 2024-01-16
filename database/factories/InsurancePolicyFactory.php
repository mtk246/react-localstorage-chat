<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillingCompany;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
use App\Models\Patient;
use App\Models\PayerResponsibility;
use Illuminate\Database\Eloquent\Factories\Factory;

class InsurancePolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InsurancePolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'own' => boolval(rand(0, 1)),
            'status' => boolval(rand(0, 1)),
            'eff_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'release_info' => boolval(rand(0, 1)),
            'assign_benefits' => boolval(rand(0, 1)),
            'policy_number' => $this->faker->unique()->randomNumber(9),
            'group_number' => $this->faker->unique()->randomNumber(9),
            'insurance_plan_id' => InsurancePlan::factory(),
            'payer_responsibility_id' => PayerResponsibility::factory(),
            'payment_responsibility_level_code' => null,
            'patient_id' => Patient::factory(),
            'billing_company_id' => BillingCompany::factory(),
            'complementary_policy_id' => null,
            'dual_plan' => boolval(rand(0, 1)),
        ];
    }
}
