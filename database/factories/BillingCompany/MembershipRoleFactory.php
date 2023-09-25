<?php

declare(strict_types=1);

namespace Database\Factories\BillingCompany;

use App\Models\BillingCompany\MembershipRole;
use App\Models\Permissions\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillingCompany\MembershipRole>
 */
final class MembershipRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
        ];
    }

    public function withBillingCompany(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'billing_company_id' => \App\Models\BillingCompany::factory(),
            ];
        });
    }

    public function withPermissions(): self
    {
        return $this->afterCreating(function (MembershipRole $role) {
            Permission::factory(3, ['billing_company_id' => $role->billing_company_id])
                ->forRole($role)
                ->create();
        });
    }
}
