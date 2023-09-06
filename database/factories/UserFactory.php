<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillingCompany;
use App\Models\Profile;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('helloworld'),
            'status' => 1,
        ];
    }

    public function withProfile(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'profile_id' => Profile::factory()->create()->id,
            ];
        });
    }

    public function whithRole(?Role $role = null): self
    {
        return $this->hasAttached($role ?? Role::factory());
    }

    public function withBillingCompany(?BillingCompany $billingCompany = null): self
    {
        return $this->state(function (array $attributes) use ($billingCompany) {
            return [
                'billing_company_id' => $billingCompany?->id ?? BillingCompany::factory()->create()->id,
            ];
        });
    }
}
