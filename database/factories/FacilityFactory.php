<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\FacilityType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
final class FacilityFactory extends Factory
{
    protected $model = Facility::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'npi' => $this->faker->uuid(),
            'code' => $this->faker->uuid(),
            'nickname' => $this->faker->userName(),
            'abbreviation' => 'ABBFAC',
        ];
    }

    public function withFacilityType()
    {
        return $this->state(function (array $attributes) {
            return [
                'facility_type_id' => FacilityType::factory()->create(),
            ];
        });
    }

    public function withBillingCompany()
    {
        return $this->state(function (array $attributes) {
            return [
                'billing_company_id' => BillingCompany::factory()->create(),
            ];
        });
    }

    public function withCompany()
    {
        return $this->state(function (array $attributes) {
            return [
                'companies' => [
                    Company::factory()->create()->id,
                ],
            ];
        });
    }

    public function withPlaceService()
    {
        return $this->state(function (array $attributes) {
            return [
                'place_of_services' => [
                    Company::factory()->create()->id,
                ],
            ];
        });
    }
}
