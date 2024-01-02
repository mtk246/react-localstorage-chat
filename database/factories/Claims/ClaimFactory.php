<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Models\BillingCompany;
use App\Models\Claims\Claim;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Claim::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(9),
            'type' => 2,
            'submitter_name' => $this->faker->name,
            'submitter_contact' => $this->faker->phoneNumber,
            'billing_company_id' => BillingCompany::factory(),
            'aditional_information' => json_encode([]),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
