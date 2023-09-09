<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InsuranceCompany;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InsurancePlan>
 *
 * @todo: change type catalog to enum
 */
final class InsurancePlanFactory extends Factory
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
            'name' => $this->faker->text(12),
            'payer_id' => $this->faker->randomNumber(4),
            'accept_assign' => $this->faker->boolean,
            'pre_authorization' => $this->faker->boolean,
            'file_zero_changes' => $this->faker->boolean,
            'referral_required' => $this->faker->boolean,
            'accrue_patient_resp' => $this->faker->boolean,
            'require_abn' => $this->faker->boolean,
            'pqrs_eligible' => $this->faker->boolean,
            'allow_attached_files' => $this->faker->boolean,
            'eff_date' => $this->faker->date(),
            'ins_type_id' => TypeCatalog::factory(),
            'plan_type_id' => TypeCatalog::factory(),
            'insurance_company_id' => InsuranceCompany::factory(),
        ];
    }
}
